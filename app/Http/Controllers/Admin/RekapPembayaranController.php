<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekapPembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class RekapPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = RekapPembayaran::with('booking.paket');

        if ($request->bulan) {

            $query->whereHas('booking', function ($q) use ($request) {

                $q->whereMonth('tanggal_acara', $request->bulan);

            });

        }

        if ($request->tahun) {

            $query->whereHas('booking', function ($q) use ($request) {

                $q->whereYear('tanggal_acara', $request->tahun);

            });

        }

        $rekaps = $query->latest()->get();

        return view('admin.rekap.index', compact('rekaps'));
    }

    public function edit(RekapPembayaran $rekap)
    {
        $rekap->load('booking.paket');

        return view(
            'admin.rekap.edit',
            compact('rekap')
        );
    }

    public function update(Request $request, RekapPembayaran $rekap)
    {
        $request->validate([
            'nominal_pelunasan' => 'nullable|numeric|min:0',
            'tanggal_pelunasan' => 'nullable|date',
        ]);

        $status = $request->nominal_pelunasan > 0
            ? 'Lunas'
            : 'Belum Lunas';

        $rekap->update([
            'nominal_pelunasan' => $request->nominal_pelunasan,
            'tanggal_pelunasan' => $request->tanggal_pelunasan,
            'status_pelunasan' => $status,
        ]);

        return redirect()
            ->route('admin.rekap.index')
            ->with('success', 'Pelunasan berhasil diperbarui.');
    }

    public function exportPdf(Request $request)
    {
        $query = RekapPembayaran::with('booking.paket');

        if ($request->bulan) {

            $query->whereHas('booking', function ($q) use ($request) {

                $q->whereMonth('tanggal_acara', $request->bulan);

            });

        }

        if ($request->tahun) {

            $query->whereHas('booking', function ($q) use ($request) {

                $q->whereYear('tanggal_acara', $request->tahun);

            });

        }

        $rekaps = $query->get();

        $namaBulan = '';

        if ($request->bulan) {

            $namaBulan = [
                1=>'Januari',
                2=>'Februari',
                3=>'Maret',
                4=>'April',
                5=>'Mei',
                6=>'Juni',
                7=>'Juli',
                8=>'Agustus',
                9=>'September',
                10=>'Oktober',
                11=>'November',
                12=>'Desember'
            ][$request->bulan];

        }

        $periode = $namaBulan;

        if ($request->tahun) {

            $periode .= ' '.$request->tahun;

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

        $pdf->setPaper('A4','landscape');

        return $pdf->stream('Laporan Rekap Pembayaran.pdf');
    }
}
