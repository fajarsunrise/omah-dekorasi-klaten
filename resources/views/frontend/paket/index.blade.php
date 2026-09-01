@extends('layouts.frontend')

@section('title','Paket Dekorasi')

@section('content')

<!-- ================= Banner ================= -->

<section class="page-banner text-white"
style="
background:
linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
url('{{ asset('image/hero.jpg') }}');
background-size:cover;
background-position:center;">


    <div class="container text-center">

        <h1 class="display-4 fw-bold">

            Paket Dekorasi

        </h1>

        <p class="lead">

            Temukan paket dekorasi terbaik untuk mewujudkan acara impian Anda.

        </p>

    </div>


</section>

<div class="container py-5">

<div class="row g-4">

@forelse($pakets as $paket)

<div class="col-lg-4 col-md-6">

<div class="card h-100 shadow-sm">

@if($paket->foto)

<img src="{{ asset('storage/paket/'.$paket->foto) }}"
class="card-img-top"
style="height:280px;object-fit:cover;">

@else

<img src="{{ asset('image/no-image.jpg') }}"
class="card-img-top"
style="height:280px;object-fit:cover;">

@endif

<div class="card-body">

<span class="badge rounded-pill mb-3"
style="background:#C8A96A;">

{{ $paket->kategori->nama_kategori }}

</span>

<h4 class="fw-bold">

{{ $paket->nama_paket }}

</h4>

<div class="mb-3">

<i class="fas fa-star text-warning"></i>
<i class="fas fa-star text-warning"></i>
<i class="fas fa-star text-warning"></i>
<i class="fas fa-star text-warning"></i>
<i class="fas fa-star text-warning"></i>

</div>

<h3 class="fw-bold mb-3"
style="color:#B8904F;">

Rp {{ number_format($paket->harga,0,',','.') }}

</h3>

@php

$fasilitas = explode("\n",$paket->include);

@endphp

<ul class="list-unstyled">

@foreach(array_slice($fasilitas,0,3) as $item)

@if(trim($item))

<li class="mb-2">

<i class="fas fa-check-circle text-success"></i>

{{ $item }}

</li>

@endif

@endforeach

</ul>

</div>

<div class="card-footer bg-white border-0 pb-4">

<a href="{{ route('frontend.paket.show',$paket->id) }}"
class="btn btn-gold w-100">

<i class="fas fa-eye"></i>

Lihat Detail Paket

</a>

</div>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-warning text-center">

Belum ada paket dekorasi.

</div>

</div>

@endforelse

</div>

</div>

@endsection
