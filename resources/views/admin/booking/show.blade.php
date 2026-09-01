@extends('adminlte::page')

@section('title','Detail Booking')

@section('content_header')
<h1>Detail Booking</h1>
@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-header">

        <h4>{{ $booking->kode_booking }}</h4>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Nama Pemesan</th>
                <td>{{ $booking->nama_pemesan }}</td>
            </tr>

            <tr>
                <th>Nama Pada Backdrop</th>
                <td>{{ $booking->nama_pengantin }}</td>
            </tr>

            <tr>
                <th>No WA</th>
                <td>{{ $booking->no_wa }}</td>
            </tr>

            <tr>
                <th>Paket</th>
                <td>{{ $booking->paket->nama_paket }}
                <br>
                <small class="text-muted">
                    Rp {{ number_format($booking->paket->harga,0,',','.') }}
                </small>
                </td>
            </tr>

            <tr>
                <th>Tanggal Acara</th>
                <td>{{ $booking->tanggal_acara }}</td>
            </tr>

            <tr>
                <th>Lokasi</th>
                <td>{{ $booking->lokasi_acara }}</td>
            </tr>

            <tr>
                <th>Instagram</th>
                <td>{{ $booking->username_instagram }}</td>
            </tr>

            <tr>
                <th>Catatan</th>
                <td>{{ $booking->catatan }}</td>
            </tr>

            <tr>

                <th>Barang Tambahan</th>

                <td>

                    @if($booking->addons->count())

                        <table class="table table-sm table-bordered mb-0">

                            <thead>

                                <tr>

                                    <th>Barang</th>

                                    <th>Harga</th>

                                    <th>Jumlah</th>

                                    <th>Subtotal</th>

                                </tr>

                            </thead>

                            <tbody>

                            @foreach($booking->addons as $addon)

                                <tr>

                                    <td>{{ $addon->nama_barang }}</td>

                                    <td>
                                        Rp {{ number_format($addon->harga,0,',','.') }}
                                    </td>

                                    <td>

                                        {{ $addon->pivot->jumlah }}

                                    </td>

                                    <td>

                                        Rp {{ number_format($addon->pivot->subtotal,0,',','.') }}

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    @else

                        Tidak ada barang tambahan.

                    @endif

                </td>

            </tr>

            <tr>

                <!-- <th>Status</th>

                <td>

                    {{ $booking->status }}

                </td> -->

                <th width="220">Status</th>
    <td>

    @if($booking->status == 'Menunggu Verifikasi')

<span class="badge bg-warning">
    Menunggu Verifikasi
</span>

@elseif($booking->status == 'Diterima')

<span class="badge bg-success">
    Diterima
</span>

@elseif($booking->status == 'Selesai')

<span class="badge bg-primary">
    Selesai
</span>

@else

<span class="badge bg-danger">
    Ditolak
</span>

@endif

    </td>

            </tr>

            <tr>

    <th>Total Paket</th>

    <td>

        Rp {{ number_format($booking->total_paket,0,',','.') }}

    </td>

</tr>

<tr>

    <th>Total Addon</th>

    <td>

        Rp {{ number_format($booking->total_addon,0,',','.') }}

    </td>

</tr>

<tr>

    <th>Total Pesanan</th>

    <td>

        <strong>

            Rp {{ number_format($booking->total_harga,0,',','.') }}

        </strong>

    </td>

</tr>

<tr>

    <th>DP (10%)</th>

    <td>

        <strong class="text-success">

            Rp {{ number_format($booking->nominal_dp,0,',','.') }}

        </strong>

    </td>

</tr>

            <tr>

            <th>Bukti DP</th>

<td>

    @if($booking->bukti_dp)

        <a
            href="{{ asset('bukti_dp/'.$booking->bukti_dp) }}"
            target="_blank">

            <img
                src="{{ asset('bukti_dp/'.$booking->bukti_dp) }}"
                width="300"
                class="img-thumbnail">

        </a>

    @else

        <span class="text-danger">
            Belum upload bukti pembayaran
        </span>

    @endif

</td>


            </tr>

        </table>

        <div class="mt-4">

    <a href="{{ route('admin.booking.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>
        Kembali

    </a>

    @if($booking->status == 'Menunggu Verifikasi')

        <form
            action="{{ route('admin.booking.terima', $booking) }}"
            method="POST"
            class="d-inline">

            @csrf

            @method('PATCH')

            <button
                class="btn btn-success"
                onclick="return confirm('Terima booking ini?')">

                <i class="fas fa-check"></i>

                Terima

            </button>

        </form>

        <form
            action="{{ route('admin.booking.tolak', $booking) }}"
            method="POST"
            class="d-inline">

            @csrf

            @method('PATCH')

            <button
                class="btn btn-danger"
                onclick="return confirm('Tolak booking ini?')">

                <i class="fas fa-times"></i>

                Tolak

            </button>

        </form>

    @endif

    @if($booking->status == 'Diterima')

    <form
        action="{{ route('admin.booking.selesai', $booking) }}"
        method="POST"
        class="d-inline">

        @csrf
        @method('PATCH')

        <button
            class="btn btn-primary"
            onclick="return confirm('Tandai booking ini sebagai selesai?')">

            <i class="fas fa-check-double"></i>
            Tandai Selesai

        </button>

    </form>

@endif

</div>

    </div>

</div>

<!-- <div class="mt-3">

    @if($booking->status == 'Menunggu Verifikasi')

        <form action="{{ route('admin.booking.terima',$booking) }}"
              method="POST"
              style="display:inline">

            @csrf
            @method('PATCH')

            <button class="btn btn-success">

                <i class="fas fa-check"></i>

                Terima Booking

            </button>

        </form>

        <form action="{{ route('admin.booking.tolak',$booking) }}"
              method="POST"
              style="display:inline">

            @csrf
            @method('PATCH')

            <button class="btn btn-danger">

                <i class="fas fa-times"></i>

                Tolak Booking

            </button>

        </form>

    @endif

</div> -->

@stop
