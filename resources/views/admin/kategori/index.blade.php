@extends('adminlte::page')

@section('title', 'Kategori Paket')

@section('content_header')
    <h1>Data Kategori Paket</h1>
@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-header">
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Kategori</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($kategori as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama_kategori }}</td>

                    <td>

                        <a href="{{ route('admin.kategori.edit',$item->id) }}"
                           class="btn btn-warning btn-sm">

                           Edit

                        </a>

                        <form action="{{ route('admin.kategori.destroy',$item->id) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus kategori?')"
                                class="btn btn-danger btn-sm">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center">

                        Belum ada data

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
