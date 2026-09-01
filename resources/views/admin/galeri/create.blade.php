@extends('adminlte::page')

@section('title','Tambah Foto Galeri')

@section('content_header')
<h1>Tambah Foto Galeri</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Form Tambah Foto</h3>
    </div>

    <form action="{{ route('admin.galeri.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="card-body">

            <div class="form-group">

                <label>Judul Foto</label>

                <input type="text"
                       name="judul"
                       class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}"
                       placeholder="Masukkan judul foto">

                @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">

                <label>Foto</label>

                <input type="file"
                       name="foto"
                       class="form-control @error('foto') is-invalid @enderror"
                       accept="image/*">

                @error('foto')
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

            <a href="{{ route('admin.galeri.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </form>

</div>

@stop
