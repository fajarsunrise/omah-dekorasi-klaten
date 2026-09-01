<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapPemesanan extends Model
{
    protected $table = 'rekap_pemesanan';

    protected $fillable = [
        'booking_id',
        'nama_pemesan',
        'nama_pengantin',
        'paket',
        'tanggal_acara',
        'lokasi_acara',
        'total_harga',
        'nominal_dp',
        'nominal_pelunasan',
        'status',
    ];

    protected $casts = [
        'tanggal_acara' => 'date',
        'total_harga' => 'decimal:2',
        'nominal_dp' => 'decimal:2',
        'nominal_pelunasan' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
