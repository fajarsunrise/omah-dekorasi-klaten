@extends('layouts.frontend')

@section('title','Beranda')

@section('content')

<!-- ================= HERO ================= -->

<section class="hero">

    <div class="hero-content">

        <h5 class="text-uppercase mb-3"
            style="letter-spacing:3px;color:#E9D5A1;">

            Wedding • Lamaran • Akad

        </h5>

        <h1>
            Omah Dekorasi Klaten
        </h1>

        <p>

            Mewujudkan dekorasi elegan untuk setiap momen istimewa Anda
            dengan konsep modern, pelayanan profesional, dan harga yang
            bersahabat.

        </p>


        <div class="d-flex justify-content-center flex-wrap gap-3">


            {{-- REKOMENDASI --}}

            <a href="{{ route('frontend.rekomendasi') }}"
               class="btn btn-gold">

                <i class="fas fa-magic me-1"></i>

                Cari Rekomendasi

            </a>


            {{-- PAKET --}}

            <a href="{{ route('frontend.paket') }}"
               class="btn btn-outline-light">

                <i class="fas fa-box-open me-1"></i>

                Lihat Paket

            </a>


        </div>

    </div>

</section>


<!-- ================= KEUNGGULAN ================= -->

<section class="py-5 bg-white">

    <div class="container">

        <div class="text-center mb-5">

            <span class="text-uppercase text-warning fw-semibold">

                Kenapa Memilih Kami?

            </span>

            <h2 class="fw-bold mt-2">

                Mengapa Memilih Omah Dekorasi?

            </h2>

            <p class="text-muted">

                Kami menghadirkan dekorasi yang elegan, pelayanan terbaik,
                serta harga yang terjangkau untuk berbagai acara spesial Anda.

            </p>

        </div>


        <div class="row g-4">


            {{-- KEUNGGULAN 1 --}}

            <div class="col-md-3">

                <div class="card h-100 text-center p-4">

                    <div class="mb-3">

                        <i class="fas fa-award fa-3x text-warning"></i>

                    </div>

                    <h5 class="fw-bold">

                        Berpengalaman

                    </h5>

                    <p class="text-muted">

                        Telah menangani berbagai acara seperti
                        wedding, akad, lamaran hingga wisuda.

                    </p>

                </div>

            </div>


            {{-- KEUNGGULAN 2 --}}

            <div class="col-md-3">

                <div class="card h-100 text-center p-4">

                    <div class="mb-3">

                        <i class="fas fa-gem fa-3x text-warning"></i>

                    </div>

                    <h5 class="fw-bold">

                        Dekorasi Elegan

                    </h5>

                    <p class="text-muted">

                        Mengutamakan desain modern,
                        estetik dan sesuai keinginan pelanggan.

                    </p>

                </div>

            </div>


            {{-- KEUNGGULAN 3 --}}

            <div class="col-md-3">

                <div class="card h-100 text-center p-4">

                    <div class="mb-3">

                        <i class="fas fa-wallet fa-3x text-warning"></i>

                    </div>

                    <h5 class="fw-bold">

                        Harga Terjangkau

                    </h5>

                    <p class="text-muted">

                        Tersedia berbagai pilihan paket
                        sesuai kebutuhan dan anggaran Anda.

                    </p>

                </div>

            </div>


            {{-- KEUNGGULAN 4 --}}

            <div class="col-md-3">

                <div class="card h-100 text-center p-4">

                    <div class="mb-3">

                        <i class="fas fa-headset fa-3x text-warning"></i>

                    </div>

                    <h5 class="fw-bold">

                        Pelayanan Ramah

                    </h5>

                    <p class="text-muted">

                        Siap membantu mulai dari konsultasi,
                        pemesanan hingga acara selesai.

                    </p>

                </div>

            </div>


        </div>

    </div>

</section>


<!-- ================= REKOMENDASI PAKET ================= -->

<section class="py-5">

    <div class="container">

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="row align-items-center">


                {{-- INFORMASI REKOMENDASI --}}

                <div class="col-lg-8">

                    <div class="p-5">

                        <span class="text-warning fw-semibold text-uppercase">

                            Pilihan Lebih Mudah

                        </span>


                        <h2 class="fw-bold mt-2 mb-3">

                            Bingung Memilih Paket Dekorasi?

                        </h2>


                        <p class="text-muted mb-4">

                            Setiap acara memiliki kebutuhan dekorasi yang berbeda.
                            Masukkan jenis acara, budget, dan ukuran lokasi Anda
                            untuk mendapatkan rekomendasi paket yang sesuai.

                        </p>


                        <a href="{{ route('frontend.rekomendasi') }}"
                           class="btn btn-gold px-4 py-3">

                            <i class="fas fa-magic me-2"></i>

                            Cari Rekomendasi Paket

                        </a>

                    </div>

                </div>


                {{-- ICON --}}

                <div class="col-lg-4 d-none d-lg-flex justify-content-center">

                    <div class="text-center p-4">

                        <i class="fas fa-magic"
                           style="
                               font-size:90px;
                               color:#B8904F;
                           "></i>


                        <h5 class="fw-bold mt-3">

                            Rekomendasi Paket

                        </h5>


                        <p class="text-muted mb-0">

                            Sesuai kebutuhan Anda

                        </p>

                    </div>

                </div>


            </div>

        </div>

    </div>

</section>


<!-- ================= PAKET ================= -->

<section class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <span class="text-warning fw-semibold">

                Paket Dekorasi

            </span>

            <h2 class="fw-bold">

                Paket Favorit

            </h2>

            <p class="text-muted">

                Pilih paket dekorasi terbaik sesuai kebutuhan acara Anda.

            </p>

        </div>


        <div class="row">


            @forelse($pakets as $paket)

                <div class="col-lg-4 mb-4">

                    <div class="card h-100">


                        {{-- FOTO PAKET --}}

                        @if($paket->foto)

                            <img src="{{ asset('storage/paket/'.$paket->foto) }}"
                                 class="card-img-top"
                                 style="height:260px;object-fit:cover;">

                        @else

                            <img src="{{ asset('image/no-image.jpg') }}"
                                 class="card-img-top"
                                 style="height:260px;object-fit:cover;">

                        @endif


                        <div class="card-body">


                            {{-- KATEGORI --}}

                            <span class="badge bg-warning text-dark mb-2">

                                {{ $paket->kategori->nama_kategori }}

                            </span>


                            {{-- NAMA PAKET --}}

                            <h4 class="fw-bold">

                                {{ $paket->nama_paket }}

                            </h4>


                            {{-- HARGA --}}

                            <h5 class="text-warning fw-bold">

                                Rp {{ number_format($paket->harga,0,',','.') }}

                            </h5>


                        </div>


                        {{-- DETAIL --}}

                        <div class="card-footer bg-white border-0">

                            <a href="{{ route('frontend.paket.show',$paket->id) }}"
                               class="btn btn-gold w-100">

                                Lihat Detail

                            </a>

                        </div>


                    </div>

                </div>

            @empty

                <div class="text-center">

                    Belum ada paket.

                </div>

            @endforelse


        </div>


        {{-- SEMUA PAKET --}}

        <div class="text-center mt-4">

            <a href="{{ route('frontend.paket') }}"
               class="btn btn-outline-dark btn-lg">

                Lihat Semua Paket

            </a>

        </div>


    </div>

</section>


<!-- ================= GALERI ================= -->

<section class="py-5 bg-white">

    <div class="container">


        <div class="text-center mb-5">

            <h2 class="fw-bold">

                Galeri Dekorasi

            </h2>

            <p class="text-muted">

                Beberapa hasil dekorasi yang telah kami kerjakan.

            </p>

        </div>


        <div class="row g-4">


            @foreach($galeris as $galeri)

                <div class="col-lg-4 col-md-6">

                    <div class="overflow-hidden rounded-4 shadow-sm">

                        <img src="{{ asset('uploads/galeri/'.$galeri->foto) }}"
                             class="w-100"
                             style="
                                 height:280px;
                                 object-fit:cover;
                                 transition:.4s;
                             ">

                    </div>

                </div>

            @endforeach


        </div>


        <div class="text-center mt-5">

            <a href="{{ route('frontend.galeri') }}"
               class="btn btn-gold px-5">

                Lihat Semua Galeri

            </a>

        </div>


    </div>

</section>


<!-- ================= ALUR PEMESANAN ================= -->

<section class="py-5">

    <div class="container">


        <div class="text-center mb-5">

            <h2 class="fw-bold">

                Alur Pemesanan

            </h2>

            <p class="text-muted">

                Booking dekorasi menjadi lebih mudah hanya dalam beberapa langkah.

            </p>

        </div>


        <div class="row text-center g-4">


            {{-- STEP 1 --}}

            <div class="col-md-3">

                <div class="card p-4 h-100">


                    <div class="step-number mb-3">

                        1

                    </div>


                    <i class="fas fa-list fa-3x text-warning mb-3"></i>


                    <h5 class="fw-bold">

                        Pilih Paket

                    </h5>


                    <p class="text-muted mb-0">

                        Pilih paket dekorasi sesuai kebutuhan acara Anda.

                    </p>


                </div>

            </div>


            {{-- STEP 2 --}}

            <div class="col-md-3">

                <div class="card p-4 h-100">


                    <div class="step-number mb-3">

                        2

                    </div>


                    <i class="fas fa-edit fa-3x text-warning mb-3"></i>


                    <h5 class="fw-bold">

                        Isi Form Booking

                    </h5>


                    <p class="text-muted mb-0">

                        Lengkapi data pemesanan melalui formulir booking.

                    </p>


                </div>

            </div>


            {{-- STEP 3 --}}

            <div class="col-md-3">

                <div class="card p-4 h-100">


                    <div class="step-number mb-3">

                        3

                    </div>


                    <i class="fas fa-money-check-alt fa-3x text-warning mb-3"></i>


                    <h5 class="fw-bold">

                        Bayar DP

                    </h5>


                    <p class="text-muted mb-0">

                        Lakukan pembayaran DP dan upload bukti transfer.

                    </p>


                </div>

            </div>


            {{-- STEP 4 --}}

            <div class="col-md-3">

                <div class="card p-4 h-100">


                    <div class="step-number mb-3">

                        4

                    </div>


                    <i class="fas fa-check-circle fa-3x text-warning mb-3"></i>


                    <h5 class="fw-bold">

                        Booking Disetujui

                    </h5>


                    <p class="text-muted mb-0">

                        Admin memverifikasi pembayaran dan booking siap diproses.

                    </p>


                </div>

            </div>


        </div>

    </div>

</section>


<!-- ================= CALL TO ACTION ================= -->

<section class="py-5 text-center text-white"
         style="background:#B8904F;">

    <div class="container">


        <h2 class="fw-bold mb-3">

            Siap Mewujudkan Acara Impian Anda?

        </h2>


        <p class="mb-4">

            Percayakan dekorasi acara spesial Anda kepada Omah Dekorasi Klaten.
            Hubungi kami sekarang dan dapatkan pelayanan terbaik.

        </p>


        <a href="{{ route('frontend.paket') }}"
           class="btn btn-light btn-lg me-3">

            <i class="fas fa-gift"></i>

            Lihat Paket

        </a>


        <a href="https://wa.me/62882005085948"
           target="_blank"
           class="btn btn-success btn-lg">

            <i class="fab fa-whatsapp"></i>

            Hubungi WhatsApp

        </a>


    </div>

</section>


@endsection
