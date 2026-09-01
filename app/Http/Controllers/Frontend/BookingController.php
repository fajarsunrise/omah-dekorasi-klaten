<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Booking;
use App\Models\Addon;
use App\Models\PaketFullBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking
     */
    public function create($id)
    {
        $paket = Paket::with('kategori')->findOrFail($id);

        $addons = Addon::orderBy('nama_barang')->get();

        // Ambil semua tanggal yang sudah ditandai full
        $tanggalFull = PaketFullBooking::where('paket_id', $paket->id)
            ->orderBy('tanggal_full')
            ->pluck('tanggal_full')
            ->map(function ($tanggal) {
                return \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
            })
            ->values();

        return view(
            'frontend.booking.create',
            compact(
                'paket',
                'addons',
                'tanggalFull'
            )
        );
    }


    /**
     * Menyimpan booking
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',

            'nama_pemesan' =>
                'required',

            'nama_pengantin' =>
                'required',

            'no_wa' =>
                'required',

            'tanggal_acara' =>
                'required|date|after_or_equal:today',

            'lokasi_acara' =>
                'required',

            'catatan' =>
                'nullable',

            'username_instagram' =>
                'nullable',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK TANGGAL FULL BOOKING
        |--------------------------------------------------------------------------
        */

        $tanggalFull = PaketFullBooking::where(
            'paket_id',
            $request->paket_id
        )
        ->where(
            'tanggal_full',
            $request->tanggal_acara
        )
        ->exists();


        /*
        |--------------------------------------------------------------------------
        | JIKA TANGGAL SUDAH FULL
        |--------------------------------------------------------------------------
        */

        if ($tanggalFull) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Paket yang dipilih sudah full booking pada tanggal tersebut. Silakan pilih tanggal lain.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN BOOKING
        |--------------------------------------------------------------------------
        */

        Booking::create([

            'paket_id' =>
                $request->paket_id,

            'kode_booking' =>
                'BK-' . time(),

            'nama_pemesan' =>
                $request->nama_pemesan,

            'nama_pengantin' =>
                $request->nama_pengantin,

            'no_wa' =>
                $request->no_wa,

            'tanggal_acara' =>
                $request->tanggal_acara,

            'lokasi_acara' =>
                $request->lokasi_acara,

            'catatan' =>
                $request->catatan,

            'username_instagram' =>
                $request->username_instagram,

            'status' =>
                'Menunggu Verifikasi',
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Booking berhasil dibuat.'
            );
    }
}
