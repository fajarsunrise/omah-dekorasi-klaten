<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\KategoriPaket;
use App\Models\PaketFullBooking;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    /**
     * Menampilkan daftar paket
     */
    public function index()
    {
        $pakets = Paket::with([
            'kategori',
            'fullBookings'
        ])
        ->latest()
        ->get();

        return view(
            'admin.paket.index',
            compact('pakets')
        );
    }


    /**
     * Form tambah paket
     */
    public function create()
    {
        $kategori = KategoriPaket::orderBy(
            'nama_kategori'
        )->get();

        return view(
            'admin.paket.create',
            compact('kategori')
        );
    }


    /**
     * Simpan paket baru
     */
    public function store(Request $request)
    {
        $request->validate([

            'kategori_id' => 'required',

            'nama_paket' => 'required|max:255',

            'harga' => 'required|numeric',

            'ukuran_dekorasi' =>
                'required|numeric|min:0',

            'include' => 'required',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);


        $namaFoto = null;


        if ($request->hasFile('foto')) {

            $namaFoto =
                time() . '.' .
                $request->foto->extension();

            $request->foto->storeAs(
                'public/paket',
                $namaFoto
            );
        }


        $paket = Paket::create([

            'kategori_id' =>
                $request->kategori_id,

            'nama_paket' =>
                $request->nama_paket,

            'harga' =>
                $request->harga,

            'ukuran_dekorasi' =>
                $request->ukuran_dekorasi,

            'include' =>
                $request->include,

            'foto' =>
                $namaFoto,

        ]);


        return redirect()
            ->route('admin.paket.index')
            ->with(
                'success',
                'Paket berhasil ditambahkan'
            );
    }


    /**
     * Detail paket
     */
    public function show(string $id)
    {
        $paket = Paket::with([
            'kategori',
            'fullBookings'
        ])->findOrFail($id);

        return view(
            'admin.paket.show',
            compact('paket')
        );
    }


    /**
     * Form edit paket
     */
    public function edit(string $id)
    {
        $paket = Paket::with(
            'fullBookings'
        )->findOrFail($id);

        $kategori = KategoriPaket::orderBy(
            'nama_kategori'
        )->get();

        return view(
            'admin.paket.edit',
            compact(
                'paket',
                'kategori'
            )
        );
    }


    /**
     * Update paket
     */
    public function update(
        Request $request,
        string $id
    ) {
        $request->validate([

            'kategori_id' =>
                'required',

            'nama_paket' =>
                'required|max:255',

            'harga' =>
                'required|numeric',

            'ukuran_dekorasi' =>
                'required|numeric|min:0',

            'include' =>
                'required',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);


        $paket =
            Paket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Upload foto baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if (
                $paket->foto &&
                Storage::exists(
                    'public/paket/' .
                    $paket->foto
                )
            ) {

                Storage::delete(
                    'public/paket/' .
                    $paket->foto
                );
            }


            $namaFoto =
                time() . '.' .
                $request->foto->extension();


            $request->foto->storeAs(
                'public/paket',
                $namaFoto
            );


            $paket->foto =
                $namaFoto;
        }


        /*
        |--------------------------------------------------------------------------
        | Update data paket
        |--------------------------------------------------------------------------
        */

        $paket->kategori_id =
            $request->kategori_id;

        $paket->nama_paket =
            $request->nama_paket;

        $paket->harga =
            $request->harga;

        $paket->ukuran_dekorasi =
            $request->ukuran_dekorasi;

        $paket->include =
            $request->include;


        $paket->save();


        return redirect()
            ->route(
                'admin.paket.index'
            )
            ->with(
                'success',
                'Paket berhasil diperbarui'
            );
    }


    /**
     * Hapus paket
     */
    public function destroy(string $id)
    {
        $paket =
            Paket::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Hapus foto
        |--------------------------------------------------------------------------
        */

        if (
            $paket->foto &&
            Storage::exists(
                'public/paket/' .
                $paket->foto
            )
        ) {

            Storage::delete(
                'public/paket/' .
                $paket->foto
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus paket
        |--------------------------------------------------------------------------
        */

        $paket->delete();


        return redirect()
            ->route(
                'admin.paket.index'
            )
            ->with(
                'success',
                'Paket berhasil dihapus'
            );
    }


    /**
     * Tambahkan tanggal full booking
     */
    public function tambahTanggalFull(
        Request $request,
        Paket $paket
    ) {
        $request->validate([

            'tanggal' =>
                'required|date',

        ]);


        PaketFullBooking::firstOrCreate([

            'paket_id' =>
                $paket->id,

            'tanggal_full' =>
                $request->tanggal,

        ]);


        return redirect()
            ->route(
                'admin.paket.edit',
                $paket->id
            )
            ->with(
                'success',
                'Tanggal full booking berhasil ditambahkan.'
            );
    }


    /**
     * Hapus tanggal full booking
     */
    public function hapusTanggalFull(
        Paket $paket,
        PaketFullBooking $fullBooking
    ) {

        /*
        |--------------------------------------------------------------------------
        | Pastikan tanggal tersebut milik paket
        |--------------------------------------------------------------------------
        */

        if (
            $fullBooking->paket_id
            != $paket->id
        ) {

            abort(404);
        }


        $fullBooking->delete();


        return redirect()
            ->route(
                'admin.paket.edit',
                $paket->id
            )
            ->with(
                'success',
                'Tanggal full booking berhasil dihapus.'
            );
    }
}
