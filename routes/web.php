<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use JeroenNoten\LaravelAdminLte\AdminLte;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriPaketController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Admin\RekapPemesananController;

// Route::get('/tes', function () {
//     return 'Frontend OK';
// });
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');


Route::get('/paket-dekorasi', [FrontendController::class, 'paket'])
    ->name('frontend.paket');

Route::get('/paket-dekorasi/{id}',
    [FrontendController::class,'showPaket'])
    ->name('frontend.paket.show');

Route::get('/booking/{id}', [BookingController::class, 'create'])
    ->name('frontend.booking.create');

Route::get('/pembayaran/{booking}', [FrontendController::class, 'pembayaran'])
    ->name('frontend.pembayaran');

Route::post('/pembayaran/{booking}/upload', [FrontendController::class, 'uploadDP'])
    ->name('frontend.upload.dp');

Route::post('/booking/store', [FrontendController::class, 'storeBooking'])
    ->name('frontend.booking.store');


Route::get('/cek-booking', [FrontendController::class, 'cekBooking'])
    ->name('frontend.cek.booking');

Route::post('/cek-booking', [FrontendController::class, 'hasilCekBooking'])
    ->name('frontend.cek.booking.hasil');

Route::get(
        '/booking/{booking}/cetak',
        [FrontendController::class, 'cetakBooking']
    )->name('frontend.booking.cetak');

Route::get('/galeri', [FrontendController::class, 'galeri'])
    ->name('frontend.galeri');

// saw
Route::get('/rekomendasi', [FrontendController::class, 'rekomendasi'])
    ->name('frontend.rekomendasi');

Route::post('/rekomendasi', [FrontendController::class, 'prosesRekomendasi'])
    ->name('frontend.rekomendasi.proses');







Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('kategori', KategoriPaketController::class);

        Route::resource('paket', PaketController::class);

        Route::post(
    'paket/{paket}/tanggal-full',
    [
        App\Http\Controllers\Admin\PaketController::class,
        'tambahTanggalFull'
    ]
)->name('paket.tanggal-full.store');


Route::delete(
    'paket/{paket}/tanggal-full/{fullBooking}',
    [
        App\Http\Controllers\Admin\PaketController::class,
        'hapusTanggalFull'
    ]
)->name('paket.tanggal-full.destroy');

        Route::resource('addon', App\Http\Controllers\Admin\AddonController::class);

        Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');

            Route::patch(
                'booking/{booking}/terima',
                [App\Http\Controllers\Admin\BookingController::class, 'terima']
            )->name('booking.terima');

            Route::patch(
                'booking/{booking}/tolak',
                [App\Http\Controllers\Admin\BookingController::class, 'tolak']
            )->name('booking.tolak');

            Route::patch(
                'booking/{booking}/selesai',
                [App\Http\Controllers\Admin\BookingController::class, 'selesai']
            )->name('booking.selesai');

            Route::get(
                '/rekap-pemesanan',
                [RekapPemesananController::class, 'index']
            )->name('rekap.index');

            Route::get(
                '/rekap-pemesanan/tambah',
                [RekapPemesananController::class, 'create']
            )->name('rekap.create');

            Route::post(
                '/rekap-pemesanan',
                [RekapPemesananController::class, 'store']
            )->name('rekap.store');

            Route::get(
                '/rekap-pemesanan/{rekap}/edit',
                [RekapPemesananController::class, 'edit']
            )->name('rekap.edit');

            Route::put(
                '/rekap-pemesanan/{rekap}',
                [RekapPemesananController::class, 'update']
            )->name('rekap.update');

            Route::delete(
                '/rekap-pemesanan/{rekap}',
                [RekapPemesananController::class, 'destroy']
            )->name('rekap.destroy');

            Route::get(
                '/rekap-pemesanan/export-pdf',
                [RekapPemesananController::class, 'exportPdf']
            )->name('rekap.export.pdf');
            //

            Route::resource(
                'galeri',
                App\Http\Controllers\Admin\GaleriController::class
            );

    });

Route::get('/adminlte-test', function () {
    return view('adminlte::page');
});

require __DIR__.'/auth.php';


// ==============================
// use Illuminate\Support\Facades\Http;

// Route::get('/test-fonnte', function () {

//     $response = Http::withHeaders([
//         'Authorization' => env('FONNTE_TOKEN'),
//     ])->post('https://api.fonnte.com/send', [
//         'target' => env('FONNTE_ADMIN'),
//         'message' => '✅ TEST FONNTE

// Koneksi Fonnte dari website Omah Dekorasi Klaten berhasil.',
//     ]);

//     return response()->json([
//         'status' => $response->status(),
//         'response' => $response->json(),
//     ]);
// });
