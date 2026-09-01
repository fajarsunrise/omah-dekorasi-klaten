<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;


class Addon extends Model
{
    protected $fillable = [

    'nama_barang',

    'harga',

    'status'

];

public function bookings()
{
    return $this->belongsToMany(Booking::class, 'booking_addons');
}

}
