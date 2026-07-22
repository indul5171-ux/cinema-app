<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Jadwal;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 film terbaru untuk ditampilkan di hero
        $filmUtama = Film::latest()->first();

        // Ambil semua film
        $films = Film::latest()->get();

        // Ambil jadwal hari ini dan besok
        $jadwals = Jadwal::with(['film', 'studio'])
                    ->whereDate('tanggal', '>=', now()->format('Y-m-d'))
                    ->orderBy('tanggal')
                    ->orderBy('jam')
                    ->take(6)
                    ->get();

        return view('home', compact('filmUtama', 'films', 'jadwals'));
    }
}