<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekapPemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapPemesananController extends Controller
{
    /**
     * Menampilkan rekap pemesanan
     */
    public function index(Request $request)
    {
        $query = RekapPemesanan::query();

        if ($request->bulan) {
            $query->whereMonth(
                'tanggal_acara',
                $request->bulan
            );
        }

        if ($request->tahun) {
            $query->whereYear(
                'tanggal_acara',
                $request->tahun
            );
        }

        // Query khusus data yang sudah selesai
        $query->where('status', 'Selesai');

        // Hitung total dari SELURUH data hasil filter
        $totalDP = (clone $query)->sum('nominal_dp');

        $totalPelunasan = (clone $query)->sum('nominal_pelunasan');

        $totalPendapatan = $totalDP + $totalPelunasan;

        // Data tabel menggunakan pagination
        $rekaps = $query
            ->orderByDesc('tanggal_acara')
            ->paginate(10);

        // Mempertahankan filter bulan dan tahun saat pindah halaman
        $rekaps->appends($request->query());

        return view('admin.rekap.index', compact(
            'rekaps',
            'totalDP',
            'totalPelunasan',
            'totalPendapatan'
        ));
    }


    /**
     * Form tambah rekap pemesanan manual
     */
    public function create()
    {
        return view('admin.rekap.create');
    }


    /**
     * Simpan rekap pemesanan manual
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama_pemesan' => 'required|string|max:255',

            'nama_pengantin' => 'nullable|string|max:255',

            'paket' => 'required|string|max:255',

            'tanggal_acara' => 'required|date',

            'lokasi_acara' => 'nullable|string',

            'total_harga' => 'required|numeric|min:0',

            'nominal_dp' => 'nullable|numeric|min:0',

            'nominal_pelunasan' => 'nullable|numeric|min:0',

        ]);


        RekapPemesanan::create([

            'booking_id' => null,

            'nama_pemesan' => $request->nama_pemesan,

            'nama_pengantin' => $request->nama_pengantin,

            'paket' => $request->paket,

            'tanggal_acara' => $request->tanggal_acara,

            'lokasi_acara' => $request->lokasi_acara,

            'total_harga' => $request->total_harga,

            'nominal_dp' => $request->nominal_dp ?? 0,

            'nominal_pelunasan' => $request->nominal_pelunasan ?? 0,

            'status' => 'Selesai',

        ]);


        return redirect()

            ->route('admin.rekap.index')

            ->with(
                'success',
                'Rekap pemesanan berhasil ditambahkan.'
            );
    }


    /**
     * Form edit
     */
    public function edit(RekapPemesanan $rekap)
    {
        return view(
            'admin.rekap.edit',
            compact('rekap')
        );
    }


    /**
     * Update rekap
     */
    public function update(
        Request $request,
        RekapPemesanan $rekap
    ) {
        $request->validate([

            'nama_pemesan' => 'required|string|max:255',

            'nama_pengantin' => 'nullable|string|max:255',

            'paket' => 'required|string|max:255',

            'tanggal_acara' => 'required|date',

            'lokasi_acara' => 'nullable|string',

            'total_harga' => 'required|numeric|min:0',

            'nominal_dp' => 'nullable|numeric|min:0',

            'nominal_pelunasan' => 'nullable|numeric|min:0',

        ]);


        $rekap->update([

            'nama_pemesan' => $request->nama_pemesan,

            'nama_pengantin' => $request->nama_pengantin,

            'paket' => $request->paket,

            'tanggal_acara' => $request->tanggal_acara,

            'lokasi_acara' => $request->lokasi_acara,

            'total_harga' => $request->total_harga,

            'nominal_dp' => $request->nominal_dp ?? 0,

            'nominal_pelunasan' =>
                $request->nominal_pelunasan ?? 0,

            'status' => 'Selesai',

        ]);


        return redirect()

            ->route('admin.rekap.index')

            ->with(
                'success',
                'Rekap pemesanan berhasil diperbarui.'
            );
    }


    /**
     * Hapus rekap
     */
    public function destroy(RekapPemesanan $rekap)
    {
        $rekap->delete();

        return redirect()

            ->route('admin.rekap.index')

            ->with(
                'success',
                'Rekap pemesanan berhasil dihapus.'
            );
    }


    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $query = RekapPemesanan::query();

        if ($request->bulan) {
            $query->whereMonth(
                'tanggal_acara',
                $request->bulan
            );
        }

        if ($request->tahun) {
            $query->whereYear(
                'tanggal_acara',
                $request->tahun
            );
        }

        $rekaps = $query

            ->where('status', 'Selesai')

            ->orderBy('tanggal_acara')

            ->get();


        $namaBulan = '';

        if ($request->bulan) {

            $namaBulan = [

                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',

            ][$request->bulan];
        }


        $periode = $namaBulan;

        if ($request->tahun) {

            $periode .= ' ' . $request->tahun;
        }


        $tanggalCetak = now()->format('d-m-Y');


        $pdf = Pdf::loadView(
            'admin.rekap.pdf',
            compact(
                'rekaps',
                'periode',
                'tanggalCetak'
            )
        );


        $pdf->setPaper('A4', 'landscape');


        return $pdf->stream(
            'Laporan Rekap Pemesanan.pdf'
        );
    }
}
