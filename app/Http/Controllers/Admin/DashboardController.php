<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CARD DASHBOARD
        |--------------------------------------------------------------------------
        */

        // Total paket
        $totalPaket = Paket::count();

        // Total seluruh booking
        $totalBooking = Booking::count();

        // Booking yang masih menunggu verifikasi
        $bookingPending = Booking::where(
            'status',
            'Menunggu Verifikasi'
        )->count();

        // Booking yang sudah selesai
        $bookingSelesai = Booking::where(
            'status',
            'Selesai'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | BOOKING MENUNGGU VERIFIKASI
        |--------------------------------------------------------------------------
        */

        $bookingMenunggu = Booking::with('paket')
            ->where('status', 'Menunggu Verifikasi')
            ->orderBy('tanggal_acara', 'asc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BOOKING TERDEKAT
        |--------------------------------------------------------------------------
        |
        | Hanya booking dengan status Diterima
        | dan tanggal acara hari ini atau setelah hari ini.
        |
        */

        $bookingTerdekat = Booking::with('paket')
            ->where('status', 'Diterima')
            ->whereDate('tanggal_acara', '>=', Carbon::today())
            ->orderBy('tanggal_acara', 'asc')
            ->paginate(5, ['*'], 'booking_page');


        return view('admin.dashboard.index', compact(
            'totalPaket',
            'totalBooking',
            'bookingPending',
            'bookingSelesai',
            'bookingMenunggu',
            'bookingTerdekat'
        ));
    }
}
