@extends('layouts.frontend')

@section('title','Cek Status Booking')

@section('content')

<div class="container page-content">

    <div class="text-center mb-5">

        <h2 class="fw-bold">

            Cek Status Booking

        </h2>

        <p class="text-muted">

            Masukkan kode booking untuk mengetahui status pesanan Anda.

        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    @if(session('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                    @endif

                    <form method="POST"
                          action="{{ route('frontend.cek.booking.hasil') }}">

                        @csrf

                        <label class="form-label fw-semibold">

                            Kode Booking

                        </label>

                        <div class="input-group mb-4">

                            <span class="input-group-text">

                                <i class="fas fa-receipt"></i>

                            </span>

                            <input type="text"
                                   name="kode_booking"
                                   class="form-control"
                                   placeholder="Contoh : BK-1753849200"
                                   required>

                        </div>

                        <button class="btn btn-gold w-100 btn-lg">

                            <i class="fas fa-search me-2"></i>

                            Cek Status Booking

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@if(isset($booking))

<div class="row justify-content-center mt-5">

<div class="col-lg-8">

<div class="card border-0 shadow">

<div class="card-body p-4">

<h3 class="fw-bold mb-4">

<i class="fas fa-file-circle-check text-success me-2"></i>

Informasi Booking

</h3>

<div class="row mb-3">

<div class="col-md-4 fw-semibold">

Kode Booking

</div>

<div class="col-md-8">

{{ $booking->kode_booking }}

</div>

</div>

<div class="row mb-3">

<div class="col-md-4 fw-semibold">

Nama Pemesan

</div>

<div class="col-md-8">

{{ $booking->nama_pemesan }}

</div>

</div>

<div class="row mb-3">

<div class="col-md-4 fw-semibold">

Paket

</div>

<div class="col-md-8">

{{ $booking->paket->nama_paket }}

</div>

</div>

<div class="row mb-3">

<div class="col-md-4 fw-semibold">

Tanggal Acara

</div>

<div class="col-md-8">

{{ \Carbon\Carbon::parse($booking->tanggal_acara)->translatedFormat('d F Y') }}

</div>

</div>

<hr>

<div class="row mb-3">

<div class="col-md-4 fw-semibold">

Total Pesanan

</div>

<div class="col-md-8 text-success fw-bold">

Rp {{ number_format($booking->total_harga,0,',','.') }}

</div>

</div>

<div class="row mb-4">

<div class="col-md-4 fw-semibold">

DP

</div>

<div class="col-md-8 text-success fw-bold">

Rp {{ number_format($booking->nominal_dp,0,',','.') }}

</div>

</div>

<div class="mb-4">

<strong>Status Booking</strong>

<br><br>

@if($booking->status=='Menunggu Verifikasi')

<span class="badge rounded-pill px-4 py-2 bg-warning text-dark">

Menunggu Verifikasi

</span>

@elseif($booking->status=='Diterima')

<span class="badge rounded-pill px-4 py-2 bg-success">

Diterima

</span>

@else

<span class="badge rounded-pill px-4 py-2 bg-danger">

Ditolak

</span>

@endif

</div>

<div class="d-grid">

<a href="{{ route('frontend.booking.cetak',$booking) }}"
   class="btn btn-danger btn-lg"
   target="_blank">

<i class="fas fa-file-pdf me-2"></i>

Cetak Bukti Booking

</a>

</div>

</div>

</div>

</div>

</div>

@endif

</div>

@endsection
