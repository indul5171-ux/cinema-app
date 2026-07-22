<?php
namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Film;
use App\Models\Studio;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['film', 'studio'])->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $films   = Film::all();
        $studios = Studio::all();
        return view('jadwal.create', compact('films', 'studios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id'   => 'required|exists:films,id',
            'studio_id' => 'required|exists:studios,id',
            'tanggal'   => 'required|date|after_or_equal:today',
            'jam'       => 'required',
            'harga'     => 'required|integer|min:1000',
        ]);

        Jadwal::create($request->all());

        return redirect('/jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect('/jadwal')->with('success', 'Jadwal berhasil dihapus!');
    }
}
