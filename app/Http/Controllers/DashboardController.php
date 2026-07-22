<?php
namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Jadwal;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFilm      = Film::count();
        $totalUser      = User::count();
        $totalPemesanan = Pemesanan::count();
        $totalPendapatan= Pemesanan::sum('total_harga');

        // Data grafik - pemesanan per bulan (6 bulan terakhir)
        $bulanLabel = [];
        $bulanData  = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $bulanLabel[] = $bulan->format('M Y');
            $bulanData[]  = Pemesanan::whereYear('created_at', $bulan->year)
                                      ->whereMonth('created_at', $bulan->month)
                                      ->count();
        }

        return view('dashboard.index', compact(
            'totalFilm', 'totalUser', 'totalPemesanan', 'totalPendapatan',
            'bulanLabel', 'bulanData'
        ));
    }
}
