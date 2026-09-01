@extends('layouts.frontend')

@section('title', $paket->nama_paket)

@section('content')

<div class="container page-content">

    <div class="row g-5">

        {{-- FOTO --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-lg overflow-hidden">

                <img src="{{ asset('storage/paket/'.$paket->foto) }}"
                     class="img-fluid"
                     style="
                        width:100%;
                        height:550px;
                        object-fit:cover;
                     ">

            </div>

        </div>


        {{-- INFORMASI PAKET --}}
        <div class="col-lg-5">

            {{-- KATEGORI --}}
            <span class="badge rounded-pill px-3 py-2 mb-3"
                  style="
                    background:#C8A96A;
                    font-size:15px;
                  ">

                {{ $paket->kategori->nama_kategori }}

            </span>


            {{-- NAMA PAKET --}}
            <h2 class="fw-bold mb-3">

                {{ $paket->nama_paket }}

            </h2>


            {{-- HARGA --}}
            <h3 class="text-success fw-bold mb-3">

                Rp {{ number_format($paket->harga,0,',','.') }}

            </h3>


            {{-- UKURAN DEKORASI --}}
            <div class="d-flex align-items-center mb-4">

                <div class="me-3"
                     style="
                        width:45px;
                        height:45px;
                        background:#f5f1e8;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                     ">

                    <i class="fas fa-ruler-horizontal"
                       style="color:#C8A96A;">
                    </i>

                </div>

                <div>

                    <small class="text-muted d-block">
                        Ukuran Dekorasi
                    </small>

                    <strong>
                        {{ $paket->ukuran_dekorasi }} meter
                    </strong>

                </div>

            </div>


            {{-- FASILITAS --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Fasilitas Paket

                    </h5>

                    @php

                        $includes = preg_split(
                            '/\r\n|\r|\n/',
                            $paket->include
                        );

                    @endphp


                    @foreach($includes as $item)

                        @if(trim($item) != '')

                            <div class="mb-2">

                                <i class="fas fa-check text-success me-2"></i>

                                {{ trim($item) }}

                            </div>

                        @endif

                    @endforeach

                </div>

            </div>


            {{-- BARANG TAMBAHAN --}}
            <div class="mb-4">

                <button
                    class="btn btn-light border w-100 text-start d-flex justify-content-between align-items-center"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#barangTambahan"
                    aria-expanded="false">

                    <span>

                        <i class="fas fa-plus-circle text-primary me-2"></i>

                        <strong>
                            Tersedia Juga Barang Tambahan
                        </strong>

                    </span>

                    <i class="fas fa-chevron-down"></i>

                </button>


                <div class="collapse mt-2"
                     id="barangTambahan">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body">

                            @forelse($addons as $addon)

                                <div class="d-flex justify-content-between align-items-center py-2">

                                    <span>

                                        <i class="fas fa-check text-success me-2"></i>

                                        {{ $addon->nama_barang }}

                                    </span>

                                </div>

                                @if(!$loop->last)

                                    <hr class="my-1">

                                @endif

                            @empty

                                <p class="text-muted mb-0">

                                    Belum ada barang tambahan.

                                </p>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>


            {{-- BOOKING --}}
            <a href="{{ route('frontend.booking.create',$paket->id) }}"
               class="btn btn-gold btn-lg w-100 mb-3">

                <i class="fas fa-calendar-check me-2"></i>

                Booking Sekarang

            </a>


            {{-- KEMBALI --}}
            <a href="{{ route('frontend.paket') }}"
               class="btn btn-outline-secondary w-100">

                <i class="fas fa-arrow-left me-2"></i>

                Kembali ke Daftar Paket

            </a>

        </div>

    </div>

</div>

@endsection
