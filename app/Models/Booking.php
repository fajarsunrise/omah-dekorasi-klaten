<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Addon;
use App\Models\Paket;


class Booking extends Model
{
    protected $fillable = [

        'paket_id',

        'kode_booking',

        'nama_pemesan',

        'nama_pengantin',

        'no_wa',

        'tanggal_acara',

        'lokasi_acara',

        'catatan',

        'username_instagram',

        'bukti_dp',

        'status',

        'total_paket',

        'total_addon',

        'total_harga',

        'nominal_dp'

    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function addons()
    {
        return $this->belongsToMany(Addon::class, 'booking_addons')
        ->withPivot('jumlah', 'subtotal')
        ->withTimestamps();
    }

    public function rekap()
    {
        return $this->hasOne(RekapPembayaran::class);
    }


}
