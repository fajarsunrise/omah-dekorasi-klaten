<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Addon;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Galeri;

class FrontendController extends Controller
{
    public function home()
    {
        $pakets = Paket::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        $galeris = Galeri::latest()
            ->take(6)
            ->get();

        return view('frontend.home.index', compact(
            'pakets',
            'galeris'
        ));
    }

    public function paket()
{
    $pakets = Paket::with('kategori')
                    ->where('status', 'Aktif')
                    ->orderBy('id', 'desc')
                    ->get();

    return view('frontend.paket.index', compact('pakets'));
}

public function showPaket($id)
{
    $paket = Paket::with('kategori')->findOrFail($id);

    $addons = Addon::where('status', 'Ready')
                    ->orderBy('nama_barang')
                    ->get();

    return view('frontend.paket.show', compact('paket', 'addons'));
}

public function storeBooking(Request $request)
{
    $request->validate([
        'paket_id' => 'required',
        'nama_pemesan' => 'required',
        'nama_pengantin' => 'required',
        'no_wa' => 'required',
        'tanggal_acara' => 'required',
        'lokasi_acara' => 'required',
    ]);

    // Ambil data paket
    $paket = Paket::findOrFail($request->paket_id);

    $totalAddon = 0;
    $pivotData = [];

    // Hitung addon
    if ($request->has('addons')) {

        foreach ($request->addons as $addonId => $jumlah) {

            if ($jumlah > 0) {

                $addon = Addon::find($addonId);

                if ($addon) {

                    $subtotal = $addon->harga * $jumlah;

                    $totalAddon += $subtotal;

                    $pivotData[$addonId] = [
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }
    }

    $totalPaket = $paket->harga;

    $totalHarga = $totalPaket + $totalAddon;

    $nominalDP = $totalHarga * 0.10;

    // Simpan booking
    $booking = Booking::create([

        'paket_id' => $paket->id,

        'kode_booking' => 'BK-' . time(),

        'nama_pemesan' => $request->nama_pemesan,

        'nama_pengantin' => $request->nama_pengantin,

        'no_wa' => $request->no_wa,

        'tanggal_acara' => $request->tanggal_acara,

        'lokasi_acara' => $request->lokasi_acara,

        'catatan' => $request->catatan,

        'username_instagram' => $request->username_instagram,

        'status' => 'Menunggu Verifikasi',

        'total_paket' => $totalPaket,

        'total_addon' => $totalAddon,

        'total_harga' => $totalHarga,

        'nominal_dp' => $nominalDP,

    ]);

    // Simpan addon
    if (!empty($pivotData)) {
        $booking->addons()->sync($pivotData);
    }

    return redirect()->route('frontend.pembayaran', $booking);
}

public function pembayaran($id)
{
    $booking = Booking::with('paket')->findOrFail($id);

    return view('frontend.booking.pembayaran', compact('booking'));
}

public function uploadDP(Request $request, Booking $booking)
{
    $request->validate([
        'bukti_dp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $namaFile = time().'.'.$request->file('bukti_dp')->extension();

    $request->file('bukti_dp')->move(
        public_path('bukti_dp'),
        $namaFile
    );

    $booking->update([
        'bukti_dp' => $namaFile,
        'status' => 'Menunggu Verifikasi',
    ]);

    return redirect()
        ->back()
        ->with('success','Bukti pembayaran berhasil dikirim. Silakan menunggu verifikasi admin.');
}

public function cekBooking()
{
    return view('frontend.booking.cek');
}

public function hasilCekBooking(Request $request)
{
    $request->validate([
        'kode_booking' => 'required'
    ]);

    $booking = Booking::with(['paket','addons'])
        ->where('kode_booking', $request->kode_booking)
        ->first();

    if (!$booking) {

        return back()->with(
            'error',
            'Kode booking tidak ditemukan.'
        );

    }

    return view(
        'frontend.booking.cek',
        compact('booking')
    );
}

public function cetakBooking(Booking $booking)
{
    $booking->load([
        'paket',
        'addons'
    ]);

    $pdf = Pdf::loadView(
        'frontend.booking.cetak',
        compact('booking')
    );

    return $pdf->download(
        'Booking-'.$booking->kode_booking.'.pdf'
    );
}

public function galeri()
{
    $galeris = Galeri::latest()->get();

    return view('frontend.galeri.index', compact('galeris'));
}

public function rekomendasi()
{
    return view('frontend.rekomendasi');
}

public function prosesRekomendasi(Request $request)
{
    // Hilangkan titik pemisah ribuan dari budget
    $request->merge([
        'budget' => str_replace('.', '', $request->budget),
    ]);

    $request->validate([
        'jenis_acara' => 'nullable',
        'budget' => 'required|numeric|min:1',
        'ukuran_lokasi' => 'nullable|numeric|min:1',
    ]);


    /*
    |--------------------------------------------------------------------------
    | 1. Menentukan kategori paket
    |--------------------------------------------------------------------------
    */

$kategori = null;

if ($request->filled('jenis_acara')) {

    if ($request->jenis_acara == 'Lamaran') {
        $kategori = 'Engagement';
    } else {
        $kategori = 'Wedding';
    }

}


    /*
    |--------------------------------------------------------------------------
    | 2. Mengambil paket yang memenuhi syarat dasar
    |--------------------------------------------------------------------------
    */

$pakets = Paket::where('status', 'Aktif')
    ->where('harga', '<=', $request->budget);

if ($kategori) {
    $pakets->whereHas('kategori', function ($query) use ($kategori) {
        $query->where('nama_kategori', $kategori);
    });
}

$pakets = $pakets->get();


    /*
    |--------------------------------------------------------------------------
    | 3. Filter ukuran lokasi
    |--------------------------------------------------------------------------
    */

    if ($request->filled('ukuran_lokasi')) {

        $pakets = $pakets->filter(function ($paket) use ($request) {

            return $paket->ukuran_dekorasi <= $request->ukuran_lokasi;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | 4. Jika tidak ada paket
    |--------------------------------------------------------------------------
    */

    if ($pakets->isEmpty()) {

        return view('frontend.rekomendasi-hasil', [

            'pakets' => collect(),

            'jenis_acara' => $request->jenis_acara,

            'budget' => $request->budget,

            'ukuran_lokasi' => $request->ukuran_lokasi,

        ]);

    }


    /*
    |--------------------------------------------------------------------------
    | 5. Menghitung jumlah fasilitas
    |--------------------------------------------------------------------------
    */

    foreach ($pakets as $paket) {

        $fasilitas = count(
            array_filter(
                preg_split(
                    '/\r\n|\r|\n/',
                    $paket->include
                )
            )
        );

        $paket->jumlah_fasilitas = $fasilitas;

    }


    /*
    |--------------------------------------------------------------------------
    | 6. Menentukan fasilitas maksimum
    |--------------------------------------------------------------------------
    */

    $maxFasilitas = $pakets->max('jumlah_fasilitas');


    /*
    |--------------------------------------------------------------------------
    | 7. Perhitungan SAW
    |--------------------------------------------------------------------------
    */

    foreach ($pakets as $paket) {


        /*
        | C1 - Kesesuaian Budget
        */

        $c1 = $paket->harga / $request->budget;


        /*
        | C2 - Kesesuaian Ukuran
        */

        if ($request->filled('ukuran_lokasi')) {

            $c2 = $paket->ukuran_dekorasi
                 / $request->ukuran_lokasi;

        } else {

            $c2 = null;

        }


        /*
        | C3 - Fasilitas
        */

        if ($maxFasilitas > 0) {

            $c3 = $paket->jumlah_fasilitas
                 / $maxFasilitas;

        } else {

            $c3 = 0;

        }


        /*
        |--------------------------------------------------------------------------
        | Jika ukuran diketahui
        |--------------------------------------------------------------------------
        */

        if ($request->filled('ukuran_lokasi')) {

            $nilaiSaw =
                ($c1 * 0.50) +
                ($c2 * 0.30) +
                ($c3 * 0.20);

        }


        /*
        |--------------------------------------------------------------------------
        | Jika ukuran tidak diketahui
        |--------------------------------------------------------------------------
        |
        | Bobot:
        | Budget = 50 / 70 = 0.7143
        | Fasilitas = 20 / 70 = 0.2857
        |
        */

        else {

            $nilaiSaw =
                ($c1 * 0.7143) +
                ($c3 * 0.2857);

        }


        /*
        | Simpan nilai sementara
        */

        $paket->nilai_saw = $nilaiSaw;

        $paket->nilai_c1 = $c1;

        $paket->nilai_c2 = $c2;

        $paket->nilai_c3 = $c3;

    }


    /*
    |--------------------------------------------------------------------------
    | 8. Urutkan berdasarkan nilai SAW
    |--------------------------------------------------------------------------
    */

    $pakets = $pakets
                ->sortByDesc('nilai_saw')
                ->values();


    /*
    |--------------------------------------------------------------------------
    | 9. Kirim ke halaman hasil
    |--------------------------------------------------------------------------
    */

    return view('frontend.rekomendasi-hasil', [

        'pakets' => $pakets,

        'jenis_acara' => $request->jenis_acara,

        'budget' => $request->budget,

        'ukuran_lokasi' => $request->ukuran_lokasi,

    ]);
}

}
