@extends('layouts.frontend')

@section('title', 'Hasil Rekomendasi')

@section('content')

<style>
    .rekomendasi-page {
        padding-top: 100px;
        padding-bottom: 60px;
    }
</style>

<div class="rekomendasi-page">

<div class="container">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Hasil Rekomendasi Paket
        </h2>

        <p class="text-muted">
            Paket yang sesuai dengan kebutuhan Anda.
        </p>

    </div>


    {{-- INFORMASI CUSTOMER --}}

    <div class="card shadow-sm border-0 rounded-4 mb-4">

        <div class="card-body">

            <h5 class="fw-bold mb-3">
                <i class="fas fa-user-check me-2"></i>
                Kebutuhan Anda
            </h5>

            <div class="row">

                <div class="col-md-4 mb-2">

                    <strong>Jenis Acara</strong>

                    <br>

                    {{ $jenis_acara }}

                </div>


                <div class="col-md-4 mb-2">

                    <strong>Budget</strong>

                    <br>

                    Rp {{ number_format($budget,0,',','.') }}

                </div>


                <div class="col-md-4 mb-2">

                    <strong>Ukuran Lokasi</strong>

                    <br>

                    @if($ukuran_lokasi)

                        {{ $ukuran_lokasi }} meter

                    @else

                        Tidak diketahui

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- HASIL PAKET --}}

    @if($pakets->count() > 0)

        <div class="row g-4">

        @foreach($pakets as $index => $paket)

        <div class="col-lg-4 col-md-6">

            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">


                {{-- REKOMENDASI UTAMA --}}

                @if($index == 0)

                    <div class="bg-warning text-dark text-center py-2 fw-bold">

                        <i class="fas fa-star me-1"></i>

                        REKOMENDASI UTAMA

                    </div>

                @endif


                {{-- FOTO PAKET --}}

                @if($paket->foto)

                    <img
                        src="{{ asset('storage/paket/'.$paket->foto) }}"
                        class="card-img-top"
                        style="height:230px; object-fit:cover;">

                @endif


                <div class="card-body">

                    {{-- NAMA + RANKING --}}

                    <div class="d-flex justify-content-between align-items-start">

                        <h5 class="fw-bold">

                            {{ $paket->nama_paket }}

                        </h5>

                        <span class="badge bg-success">

                            #{{ $index + 1 }}

                        </span>

                    </div>


                    {{-- HARGA --}}

                    <h5 class="text-success fw-bold">

                        Rp {{ number_format($paket->harga,0,',','.') }}

                    </h5>


                    <hr>


                    {{-- UKURAN --}}

                    <p class="mb-2">

                        <i class="fas fa-ruler-horizontal me-2"></i>

                        Ukuran:

                        <strong>
                            {{ $paket->ukuran_dekorasi }} meter
                        </strong>

                    </p>


                    {{-- FASILITAS --}}

                    <p class="mb-2">

                        <i class="fas fa-list me-2"></i>

                        Fasilitas:

                        <strong>
                            {{ $paket->jumlah_fasilitas }}
                        </strong>

                    </p>


                    {{-- LIHAT DETAIL --}}

                    <a href="{{ route('frontend.paket.show', $paket->id) }}"
                       class="btn btn-outline-success w-100 mt-3">

                        <i class="fas fa-eye me-2"></i>

                        Lihat Detail Paket

                    </a>


                </div>

            </div>

        </div>

        @endforeach

        </div>

    @else

        <div class="alert alert-warning text-center rounded-4">

            <i class="fas fa-exclamation-circle me-2"></i>

            Belum ditemukan paket yang sesuai dengan kebutuhan Anda.

            <br>

            <small>
                Silakan konsultasikan kebutuhan dekorasi Anda dengan
                Omah Dekorasi Klaten.
            </small>

        </div>

    @endif


    {{-- TOMBOL KEMBALI --}}

    <div class="text-center mt-5">

        <a href="{{ route('frontend.rekomendasi') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left me-2"></i>

            Ubah Pencarian

        </a>

    </div>

</div>

</div>

@endsection
