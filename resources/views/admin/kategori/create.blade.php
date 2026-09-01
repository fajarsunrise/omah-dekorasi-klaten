@extends('adminlte::page')

@section('title', 'Tambah Kategori')

@section('content_header')
    <h1>Tambah Kategori Paket</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Form Tambah Kategori</h5>
    </div>

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label>Nama Kategori</label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-control @error('nama_kategori') is-invalid @enderror"
                    value="{{ old('nama_kategori') }}"
                    placeholder="Contoh : Wedding">

                @error('nama_kategori')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">
                <i class="fas fa-save"></i>
                Simpan
            </button>

            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </form>

</div>

@stop
