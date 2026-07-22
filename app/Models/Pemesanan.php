<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'user_id', 'jadwal_id', 'seat_ids', 'kode_booking', 'jumlah_tiket', 'total_harga'
    ];

    protected $casts = [
        'seat_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}