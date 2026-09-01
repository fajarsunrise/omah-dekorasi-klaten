@extends('adminlte::page')

@section('title', 'Paket Dekorasi')

@section('content_header')
    <h1>Data Paket Dekorasi</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('admin.paket.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th width="50">No</th>
                    <th>Foto</th>
                    <th>Nama Paket</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <!-- <th>Status</th> -->
                     <th>Tanggal Full Booking</th>
                    <th width="170">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($pakets as $paket)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td width="120">

                        @if($paket->foto)

                        <img src="{{ asset('storage/paket/' . $paket->foto) }}"
                            width="100"
                            class="img-thumbnail">

                        @else

                        <span class="text-muted">Tidak ada foto</span>

                        @endif

                    </td>

                    <td>{{ $paket->nama_paket }}</td>

                    <td>{{ $paket->kategori->nama_kategori }}</td>

                    <td>Rp {{ number_format($paket->harga,0,',','.') }}</td>

                    <td>

    @if($paket->fullBookings->count())

        <span class="badge badge-danger">
            {{ $paket->fullBookings->count() }}
            tanggal full
        </span>

    @else

        <span class="badge badge-success">
            Tidak ada tanggal full
        </span>

    @endif

</td>

                    <td>

                        <a href="{{ route('admin.paket.edit',$paket->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form action="{{ route('admin.paket.destroy',$paket->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada data paket.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
