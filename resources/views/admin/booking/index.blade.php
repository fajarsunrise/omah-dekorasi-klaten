@extends('adminlte::page')

@section('title','Data Booking')

@section('content_header')
<h1>Data Booking</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>Nama Pemesan</th>
                    <th>Paket</th>
                    <th>Tanggal Acara</th>
                    <th>Total</th>
                    <th>DP</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($bookings as $booking)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $booking->kode_booking }}</td>

                    <td>{{ $booking->nama_pemesan }}</td>

                    <td>{{ $booking->paket->nama_paket }}</td>

                    <td>{{ $booking->tanggal_acara }}</td>

                    <td>

                        Rp {{ number_format($booking->total_harga,0,',','.') }}

                    </td>

                    <td>

                        Rp {{ number_format($booking->nominal_dp,0,',','.') }}

                    </td>

                    <td>

                        <!-- <span class="badge badge-warning">

                            {{ $booking->status }}

                        </span> -->

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

                            @elseif($booking->status == 'Ditolak')

                            <span class="badge bg-danger">
                                Ditolak
                            </span>

                            @endif


                    </td>

                    <td>

                        <a href="{{ route('admin.booking.show',$booking->id) }}"
                           class="btn btn-info btn-sm">

                            Detail

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada booking.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">
    {{ $bookings->links() }}
</div>

    </div>

</div>

@stop
