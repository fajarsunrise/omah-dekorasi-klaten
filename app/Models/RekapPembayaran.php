<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapPembayaran extends Model
{
    protected $table = 'rekap_pembayaran';

    protected $fillable = [

        'booking_id',

        'nominal_dp',

        'nominal_pelunasan',

        'tanggal_pelunasan',

        'status_pelunasan',

    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
