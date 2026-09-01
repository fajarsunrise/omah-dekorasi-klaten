@extends('adminlte::page')

@section('title','Edit Galeri')

@section('content_header')
<h1>Edit Foto Galeri</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('admin.galeri.update',$galeri) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Judul (Opsional)</label>

                <input
                    type="text"
                    name="judul"
                    class="form-control"
                    value="{{ old('judul',$galeri->judul) }}">

            </div>

            <div class="mb-3">

                <label>Foto Saat Ini</label>

                <br>

                <img
                    src="{{ asset('uploads/galeri/'.$galeri->foto) }}"
                    width="250"
                    class="img-thumbnail">

            </div>

            <div class="mb-3">

                <label>Ganti Foto (Opsional)</label>

                <input
                    type="file"
                    name="foto"
                    class="form-control">

            </div>

            <button class="btn btn-success">

                Simpan Perubahan

            </button>

            <a
                href="{{ route('admin.galeri.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@stop
