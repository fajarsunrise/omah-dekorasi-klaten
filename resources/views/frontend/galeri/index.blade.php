@extends('layouts.frontend')

@section('title','Galeri')

@section('content')

<section class="page-banner text-white"
style="
background:
linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
url('{{ asset('image/hero.jpg') }}');
background-size:cover;
background-position:center;">

    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Galeri Dekorasi
        </h1>

        <p class="lead">
            Dokumentasi hasil dekorasi terbaik dari Omah Dekorasi Klaten.
        </p>

    </div>

</section>

<div class="container py-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Hasil Dekorasi Kami
        </h2>

        <p class="text-muted">

            Beberapa dokumentasi acara yang telah kami kerjakan.

        </p>

    </div>

    <div class="row g-4">

        @forelse($galeris as $galeri)

        <div class="col-lg-4 col-md-6">

        <div class="gallery-item">

        <a href="{{ asset('uploads/galeri/'.$galeri->foto) }}"
        data-lightbox="galeri"
        data-title="{{ $galeri->judul }}">

            <img src="{{ asset('uploads/galeri/'.$galeri->foto) }}"
                class="gallery-img">

            <div class="gallery-overlay">

                <i class="fas fa-search-plus fa-2x"></i>

            </div>

        </a>

        </div>

            @if($galeri->judul)

            <h5 class="text-center mt-3 fw-semibold">

                {{ $galeri->judul }}

            </h5>

            @endif

        </div>





        @empty

        <div class="col-12">

            <div class="alert alert-warning text-center">

                Belum ada foto galeri.

            </div>

        </div>

        @endforelse

    </div>

</div>

<style>

.gallery-item{
    position: relative;
    overflow: hidden;
    border-radius: 20px;
}

.gallery-item a{
    display: block;
    position: relative;
}

.gallery-img{
    width:100%;
    height:330px;
    object-fit:cover;
    border-radius:20px;
    transition:.4s;
}

.gallery-overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.45);
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    opacity:0;
    transition:.3s;
    border-radius:20px;
}

.gallery-item:hover .gallery-img{
    transform:scale(1.08);
}

.gallery-item:hover .gallery-overlay{
    opacity:1;
}

</style>

@endsection
