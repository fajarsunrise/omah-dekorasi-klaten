<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketFullBooking extends Model
{
    use HasFactory;

    protected $table = 'paket_full_bookings';

    protected $fillable = [
        'paket_id',
        'tanggal_full',
    ];

    protected $casts = [
        'tanggal_full' => 'date',
    ];

    /**
     * Relasi ke paket
     */
    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
