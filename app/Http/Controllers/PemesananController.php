<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Jadwal;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with(['user', 'jadwal.film', 'jadwal.studio'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create(Request $request)
    {
        $jadwal_id = $request->jadwal_id;
        $jadwal    = Jadwal::with(['film', 'studio'])->findOrFail($jadwal_id);
        $seats     = Seat::where('studio_id', $jadwal->studio_id)
                        ->orderBy('kode_kursi')
                        ->get();

        return view('pemesanan.create', compact('jadwal', 'seats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id'   => 'required|exists:jadwals,id',
            'seat_ids'    => 'required|array|min:1',
            'seat_ids.*'  => 'exists:seats,id',
        ]);

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        $sudahDipesan = Seat::whereIn('id', $request->seat_ids)
                           ->where('status', 'booked')
                           ->count();

        if ($sudahDipesan > 0) {
            return back()->with('error', 'Beberapa kursi sudah dipesan, silakan pilih kursi lain.');
        }

        $jumlah      = count($request->seat_ids);
        $total       = $jumlah * $jadwal->harga;
        $kodeBooking = strtoupper(Str::random(8));

        $pemesanan = Pemesanan::create([
            'user_id'      => auth()->id(),
            'jadwal_id'    => $request->jadwal_id,
            'seat_ids'     => $request->seat_ids,
            'kode_booking' => $kodeBooking,
            'jumlah_tiket' => $jumlah,
            'total_harga'  => $total,
        ]);

        Seat::whereIn('id', $request->seat_ids)
            ->update(['status' => 'booked']);

        return redirect()->route('pemesanan.show', $pemesanan->id)
               ->with('success', 'Pemesanan berhasil! Kode booking: ' . $kodeBooking);
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'jadwal.film', 'jadwal.studio'])
                        ->findOrFail($id);

        return view('pemesanan.show', compact('pemesanan'));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        if ($pemesanan->seat_ids) {
            Seat::whereIn('id', $pemesanan->seat_ids)
                ->update(['status' => 'available']);
        }

        $pemesanan->delete();

        return redirect('/pemesanan')->with('success', 'Tiket berhasil dibatalkan, kursi tersedia kembali!');
    }
}