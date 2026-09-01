@extends('layouts.frontend')

@section('title','Booking Paket')

@section('content')

<div class="container page-content">

    <div class="text-center mb-5">

        <h2 class="fw-bold">

            Booking Paket Dekorasi

        </h2>

        <p class="text-muted">

            Lengkapi data berikut untuk melanjutkan proses pemesanan.

        </p>

    </div>

    <form action="{{ route('frontend.booking.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <input type="hidden"
               name="paket_id"
               value="{{ $paket->id }}">

               {{-- PESAN ERROR --}}
@if(session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
    </div>
@endif

{{-- PESAN VALIDASI --}}
@if($errors->any())
    <div class="alert alert-danger">

        <strong>
            Terdapat kesalahan:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>
@endif

        {{-- INFORMASI PAKET --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    <i class="fas fa-box-open text-warning me-2"></i>

                    Paket Dipilih

                </h4>

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h5 class="fw-bold mb-1">

                            {{ $paket->nama_paket }}

                        </h5>

                        <span class="badge bg-warning text-dark">

                            {{ $paket->kategori->nama_kategori }}

                        </span>

                    </div>

                    <div class="col-md-4 text-md-end mt-3 mt-md-0">

                        <h4 class="text-success fw-bold">

                            Rp {{ number_format($paket->harga,0,',','.') }}

                        </h4>

                    </div>

                </div>

            </div>

        </div>

        {{-- DATA PEMESAN --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    <i class="fas fa-user text-primary me-2"></i>

                    Data Pemesan

                </h4>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nama Pemesan

                        </label>

                        <input type="text"
                               name="nama_pemesan"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nama Pada Backdrop

                        </label>

                        <input type="text"
                               name="nama_pengantin"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            No WhatsApp

                        </label>

                        <input type="text"
                               name="no_wa"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Username Instagram
                            <small class="text-muted">(Opsional)</small>

                        </label>

                        <input type="text"
                               name="username_instagram"
                               class="form-control">

                    </div>

                </div>

            </div>

        </div>

        {{-- DETAIL ACARA --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    <i class="fas fa-calendar-days text-danger me-2"></i>

                    Detail Acara

                </h4>

<div class="mb-3">

    <label class="form-label">
        Tanggal Acara
    </label>

    <input
        type="date"
        name="tanggal_acara"
        id="tanggal_acara"
        class="form-control"
        min="{{ date('Y-m-d') }}"
        value="{{ old('tanggal_acara') }}"
        required
    >

    <small class="text-muted">
        Pilih tanggal acara yang masih tersedia.
    </small>

    {{-- PESAN TANGGAL FULL --}}
    <div
        id="pesanTanggalFull"
        class="alert alert-danger mt-3"
        style="display: none;"
    >
        <i class="fas fa-calendar-times me-2"></i>

        <strong>
            Tanggal tidak tersedia.
        </strong>

        Paket ini sudah full booking pada tanggal yang dipilih.
        Silakan pilih tanggal lain.
    </div>

</div>

@if($tanggalFull->count())

    <div class="alert alert-warning">

        <div class="fw-bold mb-2">

            <i class="fas fa-calendar-times me-2"></i>

            Tanggal Full Booking

        </div>

        <small>
            Paket ini tidak tersedia pada tanggal:
        </small>

        <ul class="mb-0 mt-2">

            @foreach($tanggalFull as $tanggal)

                <li>
                    {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}
                </li>

            @endforeach

        </ul>

    </div>

@endif

                <div class="mb-3">

                    <label class="form-label">

                        Lokasi Acara

                    </label>

                    <textarea name="lokasi_acara"
                              class="form-control"
                              rows="3"
                              required></textarea>

                </div>

                <div>

                    <label class="form-label">

                        Catatan

                    </label>

                    <textarea name="catatan"
                              class="form-control"
                              rows="3"></textarea>

                </div>

            </div>

        </div>

        {{-- BARANG TAMBAHAN --}}
        <div class="card border-0 shadow-sm mb-5">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    <i class="fas fa-plus-circle text-warning me-2"></i>

                    Barang Tambahan

                </h4>

                <div class="row">

                    @foreach($addons as $addon)

                    <div class="col-lg-6 mb-4">

                        <div class="border rounded-4 p-3 h-100">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <h6 class="fw-bold mb-1">

                                        {{ $addon->nama_barang }}

                                    </h6>

                                    <span class="text-success fw-bold">

                                        Rp {{ number_format($addon->harga,0,',','.') }}

                                    </span>

                                </div>

                                @if($addon->status=='Ready')

                                    <span class="badge bg-success">

                                        Ready

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Tidak Ready

                                    </span>

                                @endif

                            </div>

                            @if($addon->status=='Ready')

                            <div class="mt-3">

                                <label class="form-label">

                                    Jumlah

                                </label>

                                <input
                                    type="number"
                                    name="addons[{{ $addon->id }}]"
                                    class="form-control"
                                    min="0"
                                    value="0">

                            </div>

                            @endif

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

<div class="text-center">

    {{-- TOMBOL KEMBALI KE DAFTAR PAKET --}}
    <a href="{{ route('frontend.paket') }}"
       class="btn btn-secondary btn-lg px-4 me-2">

        <i class="fas fa-arrow-left me-2"></i>

        Kembali

    </a>


    {{-- TOMBOL LANJUT PEMBAYARAN --}}
    <button
        type="submit"
        class="btn btn-gold btn-lg px-5">

        <i class="fas fa-arrow-right me-2"></i>

        Lanjut Pembayaran DP

    </button>

</div>

    </form>
    <script>

    document.addEventListener('DOMContentLoaded', function () {

        const tanggalInput =
            document.getElementById('tanggal_acara');

        const pesanTanggalFull =
            document.getElementById('pesanTanggalFull');

        const tanggalFull = @json($tanggalFull);


        tanggalInput.addEventListener('change', function () {

            const tanggalDipilih = this.value;


            if (tanggalFull.includes(tanggalDipilih)) {

                pesanTanggalFull.style.display = 'block';

                this.setCustomValidity(
                    'Tanggal tersebut sudah full booking.'
                );

            } else {

                pesanTanggalFull.style.display = 'none';

                this.setCustomValidity('');

            }

        });

    });

</script>

</div>

@endsection
