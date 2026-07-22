<?php
namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::latest()->get();
        return view('film.index', compact('films'));
    }

    public function create()
    {
        return view('film.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:200',
            'genre'    => 'required|string|max:100',
            'durasi'   => 'required|integer|min:1',
            'deskripsi'=> 'required|string',
        ]);

        $data = $request->only(['judul', 'genre', 'durasi', 'deskripsi']);

        if ($request->hasFile('poster')) {
            $file   = $request->file('poster');
            $nama   = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('posters'), $nama);
            $data['poster'] = $nama;
        }

        Film::create($data);

        return redirect('/film')->with('success', 'Film berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        return view('film.edit', compact('film'));
    }

    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);
        $request->validate([
            'judul'     => 'required|string|max:200',
            'genre'     => 'required|string|max:100',
            'durasi'    => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        $data = $request->only(['judul', 'genre', 'durasi', 'deskripsi']);

        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $nama = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('posters'), $nama);
            $data['poster'] = $nama;
        }

        $film->update($data);
        return redirect('/film')->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Film::findOrFail($id)->delete();
        return redirect('/film')->with('success', 'Film berhasil dihapus!');
    }
}
