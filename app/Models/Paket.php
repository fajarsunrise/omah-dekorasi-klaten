<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriPaket;
use App\Models\Booking;
use App\Models\PaketFullBooking;

class Paket extends Model
{
    protected $table = 'pakets';

    protected $fillable = [
        'kategori_id',
        'nama_paket',
        'harga',
        'ukuran_dekorasi',
        'include',
        'foto',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPaket::class, 'kategori_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Daftar tanggal paket dinyatakan full booking
     */
    public function fullBookings()
    {
        return $this->hasMany(PaketFullBooking::class);
    }
}
