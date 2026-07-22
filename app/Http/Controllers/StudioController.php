<?php
namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Seat;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        return view('studio.index', compact('studios'));
    }

    public function create()
    {
        return view('studio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $studio = Studio::create([
            'nama'      => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        // Generate kursi otomatis
        $rows    = range('A', 'Z');
        $jumlah  = (int) $request->kapasitas;
        $perRow  = 10;
        $count   = 0;

        foreach ($rows as $row) {
            for ($col = 1; $col <= $perRow; $col++) {
                if ($count >= $jumlah) break 2;
                Seat::create([
                    'studio_id'  => $studio->id,
                    'kode_kursi' => $row . $col,
                    'status'     => 'available',
                ]);
                $count++;
            }
        }

        return redirect('/studio')->with('success', 'Studio berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Studio::findOrFail($id)->delete();
        return redirect('/studio')->with('success', 'Studio berhasil dihapus!');
    }
}
