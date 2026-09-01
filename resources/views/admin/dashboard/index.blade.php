@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Admin</h1>
@stop

@section('content')

{{-- ========================================================= --}}
{{-- CARD STATISTIK --}}
{{-- ========================================================= --}}

<div class="row">

    {{-- TOTAL PAKET --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>{{ $totalPaket }}</h3>

                <p>Total Paket</p>

            </div>

            <div class="icon">

                <i class="fas fa-box"></i>

            </div>

        </div>

    </div>


    {{-- TOTAL BOOKING --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>{{ $totalBooking }}</h3>

                <p>Total Booking</p>

            </div>

            <div class="icon">

                <i class="fas fa-calendar-check"></i>

            </div>

        </div>

    </div>


    {{-- BOOKING PENDING --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>{{ $bookingPending }}</h3>

                <p>Booking Pending</p>

            </div>

            <div class="icon">

                <i class="fas fa-clock"></i>

            </div>

        </div>

    </div>


    {{-- BOOKING SELESAI --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>{{ $bookingSelesai }}</h3>

                <p>Booking Selesai</p>

            </div>

            <div class="icon">

                <i class="fas fa-check-circle"></i>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- BOOKING MENUNGGU VERIFIKASI --}}
{{-- ========================================================= --}}

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h3 class="card-title">

                <i class="fas fa-clock mr-2"></i>

                Booking Menunggu Verifikasi

            </h3>


            {{-- JUMLAH + TOMBOL --}}
            <div>

                <span class="badge badge-warning mr-2">

                    {{ $bookingPending }} Booking

                </span>


                <a href="{{ route('admin.booking.index') }}"
                   class="btn btn-sm btn-primary">

                    <i class="fas fa-calendar-check mr-1"></i>

                    Lihat Booking

                </a>

            </div>

        </div>

    </div>


    <div class="card-body p-0">

        @if($bookingMenunggu->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

                        <tr>

                            <th width="50">No</th>

                            <th>Nama Pemesan</th>

                            <th>Nama Pada backdrop</th>

                            <th>Paket</th>

                            <th>Tanggal Acara</th>

                            <th>Nominal DP</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($bookingMenunggu as $index => $booking)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <strong>
                                        {{ $booking->nama_pemesan }}
                                    </strong>

                                </td>


                                <td>

                                    {{ $booking->nama_pengantin }}

                                </td>


                                <td>

                                    {{ $booking->paket->nama_paket ?? '-' }}

                                </td>


                                <td>

                                    {{ \Carbon\Carbon::parse($booking->tanggal_acara)->translatedFormat('d F Y') }}

                                </td>


                                <td>

                                    Rp {{ number_format($booking->nominal_dp, 0, ',', '.') }}

                                </td>


                                <td>

                                    <span class="badge badge-warning">

                                        {{ $booking->status }}

                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center p-4 text-muted">

                <i class="fas fa-check-circle fa-2x mb-2"></i>

                <br>

                Tidak ada booking yang menunggu verifikasi.

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- BOOKING TERDEKAT --}}
{{-- ========================================================= --}}

<div class="card mt-4">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-calendar-alt mr-2"></i>

            Booking Terdekat

        </h3>

    </div>


    <div class="card-body p-0">

        @if($bookingTerdekat->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

                        <tr>

                            <th width="50">No</th>

                            <th>Nama Pemesan</th>

                            <th>Nama Pada Backdrop</th>

                            <th>Paket</th>

                            <th>Tanggal Acara</th>

                            <th>Lokasi</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($bookingTerdekat as $index => $booking)

                            @php

                                $tanggalAcara = \Carbon\Carbon::parse(
                                    $booking->tanggal_acara
                                );

                                $hariIni = \Carbon\Carbon::today();

                                $selisihHari = $hariIni->diffInDays(
                                    $tanggalAcara,
                                    false
                                );

                            @endphp


                            <tr>

                                <td>

                                    {{ $index + 1 }}

                                </td>


                                <td>

                                    <strong>
                                        {{ $booking->nama_pemesan }}
                                    </strong>

                                </td>


                                <td>

                                    {{ $booking->nama_pengantin }}

                                </td>


                                <td>

                                    {{ $booking->paket->nama_paket ?? '-' }}

                                </td>


                                <td>

                                    <strong>

                                        {{ $tanggalAcara->translatedFormat('d F Y') }}

                                    </strong>


                                    <br>


                                    @if($selisihHari == 0)

                                        <span class="badge badge-danger">

                                            Hari ini

                                        </span>

                                    @elseif($selisihHari == 1)

                                        <small class="text-danger">

                                            Besok

                                        </small>

                                    @else

                                        <small class="text-danger">

                                            {{ $selisihHari }} hari lagi

                                        </small>

                                    @endif

                                </td>


                                <td>

                                    {{ $booking->lokasi_acara }}

                                </td>


                                <td>

                                    <span class="badge badge-success">

                                        Diterima

                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
            <div class="mt-3">
    {{ $bookingTerdekat->appends(request()->except('booking_page'))->links() }}
</div>

        @else

            <div class="text-center p-4 text-muted">

                <i class="fas fa-calendar-times fa-2x mb-2"></i>

                <br>

                Belum ada booking yang diterima untuk acara mendatang.

            </div>

        @endif

    </div>

</div>

@stop
