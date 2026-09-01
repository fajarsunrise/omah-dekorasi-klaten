<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\RekapPemesanan;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Otomatis menyelesaikan booking H+3
        |--------------------------------------------------------------------------
        */

        $tanggalSelesai = now()
            ->subDays(3)
            ->toDateString();

        $bookingsOtomatis = Booking::where('status', 'Diterima')
            ->whereDate('tanggal_acara', '<=', $tanggalSelesai)
            ->with('paket')
            ->get();

        foreach ($bookingsOtomatis as $booking) {

            // Ubah status booking menjadi Selesai
            $booking->update([
                'status' => 'Selesai'
            ]);

            // Masukkan ke rekap pemesanan
            $this->buatRekapPemesanan($booking);
        }


        /*
        |--------------------------------------------------------------------------
        | Menampilkan seluruh booking
        |--------------------------------------------------------------------------
        */

        $bookings = Booking::with('paket')
        ->latest()
        ->paginate(10);

        return view(
            'admin.booking.index',
            compact('bookings')
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load([
            'paket',
            'addons'
        ]);

        return view(
            'admin.booking.show',
            compact('booking')
        );
    }


    /**
     * Menerima booking.
     */
    public function terima(Booking $booking)
    {
        $booking->update([
            'status' => 'Diterima'
        ]);

        return redirect()
            ->route('admin.booking.show', $booking)
            ->with(
                'success',
                'Booking berhasil diterima.'
            );
    }


    /**
     * Menolak booking.
     */
    public function tolak(Booking $booking)
    {
        $booking->update([
            'status' => 'Ditolak'
        ]);

        return redirect()
            ->route('admin.booking.show', $booking)
            ->with(
                'success',
                'Booking berhasil ditolak.'
            );
    }


    /**
     * Menandai booking sebagai selesai secara manual.
     */
    public function selesai(Booking $booking)
    {
        // Hanya booking yang sudah diterima
        // yang dapat ditandai sebagai selesai
        if ($booking->status != 'Diterima') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Booking belum berstatus Diterima.'
                );
        }


        // Pastikan relasi paket tersedia
        $booking->load('paket');


        // Ubah status booking
        $booking->update([
            'status' => 'Selesai'
        ]);


        // Masukkan ke rekap pemesanan
        $this->buatRekapPemesanan($booking);


        return redirect()
            ->back()
            ->with(
                'success',
                'Booking berhasil ditandai sebagai selesai dan masuk ke rekap pemesanan.'
            );
    }


    /**
     * Membuat rekap pemesanan dari booking.
     *
     * firstOrCreate digunakan agar satu booking
     * tidak masuk ke rekap lebih dari satu kali.
     */
    private function buatRekapPemesanan(Booking $booking)
    {
        RekapPemesanan::firstOrCreate(
            [
                'booking_id' => $booking->id
            ],
            [
                'nama_pemesan' => $booking->nama_pemesan,

                'nama_pengantin' => $booking->nama_pengantin,

                'paket' => $booking->paket->nama_paket,

                'tanggal_acara' => $booking->tanggal_acara,

                'lokasi_acara' => $booking->lokasi_acara,

                'total_harga' => $booking->total_harga ?? 0,

                'nominal_dp' => $booking->nominal_dp ?? 0,

                'nominal_pelunasan' => 0,

                'status' => 'Selesai',
            ]
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
