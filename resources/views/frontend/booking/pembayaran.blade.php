@extends('layouts.frontend')

@section('title','Pembayaran DP')

@section('content')

<div class="container page-content">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<div class="text-center mb-5">

<h2 class="fw-bold">

Pembayaran Down Payment

</h2>

<p class="text-muted">

Silakan lakukan pembayaran sesuai nominal berikut.

</p>

</div>

<div class="row">

<div class="col-lg-5 mb-4">

<div class="card border-0 shadow-sm mb-4">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="fas fa-file-invoice text-warning me-2"></i>

Informasi Booking

</h4>

<p>

<strong>Kode Booking</strong><br>

{{ $booking->kode_booking }}

</p>

<p>

<strong>Nama Pemesan</strong><br>

{{ $booking->nama_pemesan }}

</p>

<p class="mb-0">

<strong>Paket</strong><br>

{{ $booking->paket->nama_paket }}

</p>

</div>

</div>

<div class="card border-0 shadow-sm">

<div class="card-body text-center">

<h4 class="fw-bold mb-4">

<i class="fas fa-qrcode text-success me-2"></i>

Scan QRIS

</h4>

<img src="{{ asset('image/qris2.png') }}"

class="img-fluid rounded"

style="max-width:280px;">

<p class="text-muted mt-3 mb-0">

Scan QRIS menggunakan aplikasi pembayaran favorit Anda.

</p>

</div>

</div>

</div>

<div class="col-lg-7">

<div class="card border-0 shadow-sm mb-4">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="fas fa-wallet text-primary me-2"></i>

Ringkasan Pembayaran

</h4>

<table class="table align-middle">

<tr>

<td>Harga Paket</td>

<td class="text-end">

Rp {{ number_format($booking->total_paket,0,',','.') }}

</td>

</tr>

<tr>

<td>Barang Tambahan</td>

<td class="text-end">

Rp {{ number_format($booking->total_addon,0,',','.') }}

</td>

</tr>

<tr>

<td class="fw-bold">

Total Pesanan

</td>

<td class="text-end fw-bold">

Rp {{ number_format($booking->total_harga,0,',','.') }}

</td>

</tr>

<tr class="table-warning">

<td class="fw-bold">

DP (10%)

</td>

<td class="text-end fw-bold text-success">

Rp {{ number_format($booking->nominal_dp,0,',','.') }}

</td>

</tr>

</table>

</div>

</div>

@if(!$booking->bukti_dp)

<div class="card border-0 shadow-sm">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="fas fa-upload text-danger me-2"></i>

Upload Bukti Transfer

</h4>

<form action="{{ route('frontend.upload.dp',$booking->id) }}"

method="POST"

enctype="multipart/form-data">

@csrf

<div class="mb-4">

<input type="file"

name="bukti_dp"

class="form-control"

accept="image/*"

required>

</div>

<button class="btn btn-gold btn-lg w-100">

<i class="fas fa-paper-plane me-2"></i>

Kirim Bukti Pembayaran

</button>

</form>

</div>

</div>

@else

<div class="alert border-0 shadow-sm"
     style="background:#EAF8F1;border-left:5px solid #28a745;">

    <h2 class="fw-bold mb-3 text-success">
        <i class="fas fa-check-circle"></i>
        Bukti Pembayaran Berhasil Dikirim
    </h2>

    <hr>

    <div class="mb-3">

        <strong>Status Booking</strong>

        <br>

        <span class="badge rounded-pill px-4 py-2 mt-2"
              style="background:#FFC107;color:#222;font-size:15px;">

            Menunggu Verifikasi

        </span>

    </div>

    <p class="mb-4">
        Admin akan melakukan verifikasi pembayaran Anda. Proses verifikasi dilakukan setelah bukti pembayaran diperiksa oleh admin.
    </p>

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body text-center">

            <small class="text-muted">
                Simpan kode booking berikut untuk mengecek status pembayaran
            </small>

            <h3 class="fw-bold mt-2 mb-2 text-primary">

                {{ $booking->kode_booking }}

            </h3>

            <small class="text-danger">
                Jangan sampai kode booking ini hilang.
            </small>

        </div>

    </div>

       <a href="{{ route('frontend.paket') }}"
       class="btn btn-secondary rounded-pill px-4">

        <i class="fas fa-arrow-left me-2"></i>

        Kembali

    </a>

    <a href="{{ route('frontend.cek.booking') }}"
       class="btn btn-primary rounded-pill px-4">

        <i class="fas fa-search"></i>

        Cek Status Booking

    </a>

</div>

@endif

</div>

</div>

</div>

@endsection
