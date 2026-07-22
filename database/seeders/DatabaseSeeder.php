<?php
namespace Database\Seeders;

use App\Models\Film;
use App\Models\Studio;
use App\Models\Seat;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        User::create([
            'name'     => 'Admin Bioskop',
            'email'    => 'admin@bioskop.com',
            'password' => Hash::make('password'),
        ]);

        
        $films = [
            ['judul' => 'Avengers: Endgame',   'genre' => 'Action',    'durasi' => 181, 'deskripsi' => 'Film superhero epik dari Marvel Studios.'],
            ['judul' => 'The Dark Knight',      'genre' => 'Action',    'durasi' => 152, 'deskripsi' => 'Batman melawan Joker dalam pertarungan epik di Gotham.'],
            ['judul' => 'Interstellar',         'genre' => 'Sci-Fi',    'durasi' => 169, 'deskripsi' => 'Perjalanan astronot menembus lubang cacing di luar angkasa.'],
            ['judul' => 'Laskar Pelangi',       'genre' => 'Drama',     'durasi' => 125, 'deskripsi' => 'Kisah inspiratif anak-anak Belitung berjuang menggapai mimpi.'],
            ['judul' => 'KKN di Desa Penari',  'genre' => 'Horror',    'durasi' => 120, 'deskripsi' => 'Kisah horor mahasiswa KKN yang mengalami kejadian misterius.'],
        ];
        foreach ($films as $f) Film::create($f);

        
        $studios = [
            ['nama' => 'Studio 1', 'kapasitas' => 30],
            ['nama' => 'Studio 2', 'kapasitas' => 20],
        ];
        foreach ($studios as $s) {
            $studio = Studio::create($s);
            $rows   = range('A', 'Z');
            $count  = 0;
            foreach ($rows as $row) {
                for ($col = 1; $col <= 10; $col++) {
                    if ($count >= $s['kapasitas']) break 2;
                    Seat::create([
                        'studio_id'  => $studio->id,
                        'kode_kursi' => $row . $col,
                        'status'     => 'available',
                    ]);
                    $count++;
                }
            }
        }

        
        $jadwals = [
            ['film_id' => 1, 'studio_id' => 1, 'tanggal' => now()->addDays(1)->format('Y-m-d'), 'jam' => '13:00', 'harga' => 50000],
            ['film_id' => 2, 'studio_id' => 2, 'tanggal' => now()->addDays(1)->format('Y-m-d'), 'jam' => '15:30', 'harga' => 55000],
            ['film_id' => 3, 'studio_id' => 1, 'tanggal' => now()->addDays(2)->format('Y-m-d'), 'jam' => '18:00', 'harga' => 60000],
        ];
        foreach ($jadwals as $j) Jadwal::create($j);
    }
}
