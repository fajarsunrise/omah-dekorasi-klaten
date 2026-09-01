@extends('adminlte::page')

@section('title', 'Edit Kategori')

@section('content_header')
<h1>Edit Kategori</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text"
                       name="nama_kategori"
                       class="form-control"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       required>
            </div>

            <button type="submit" class="btn btn-warning mt-3">
                Update
            </button>

            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary mt-3">
                Kembali
            </a>

        </form>

    </div>
</div>

@stop
