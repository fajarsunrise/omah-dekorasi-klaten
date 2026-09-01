@extends('adminlte::page')

@section('title', 'Barang Tambahan')

@section('content_header')
<h1>Data Barang Tambahan</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('admin.addon.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($addons as $addon)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $addon->nama_barang }}</td>

                    <td>
                        Rp {{ number_format($addon->harga,0,',','.') }}
                    </td>

                    <td>

                        @if($addon->status == 'Ready')

                            <span class="badge badge-success">
                                Ready
                            </span>

                        @else

                            <span class="badge badge-danger">
                                Tidak Ready
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('admin.addon.edit',$addon->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.addon.destroy',$addon->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus barang ini?')">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center">

                        Belum ada data barang tambahan.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
