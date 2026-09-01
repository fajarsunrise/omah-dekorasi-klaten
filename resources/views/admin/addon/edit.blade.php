@extends('adminlte::page')

@section('title', 'Edit Barang Tambahan')

@section('content_header')
<h1>Edit Barang Tambahan</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('admin.addon.update', $addon->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Barang</label>

                <input
                    type="text"
                    name="nama_barang"
                    class="form-control"
                    value="{{ old('nama_barang', $addon->nama_barang) }}"
                    required>
            </div>

            <div class="form-group mt-3">
                <label>Harga</label>

                <input
                    type="number"
                    name="harga"
                    class="form-control"
                    value="{{ old('harga', $addon->harga) }}"
                    required>
            </div>

            <div class="form-group mt-3">

                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="Ready"
                        {{ $addon->status == 'Ready' ? 'selected' : '' }}>
                        Ready
                    </option>

                    <option value="Tidak Ready"
                        {{ $addon->status == 'Tidak Ready' ? 'selected' : '' }}>
                        Tidak Ready
                    </option>

                </select>

            </div>

            <button class="btn btn-primary mt-4">

                Simpan

            </button>

            <a href="{{ route('admin.addon.index') }}"
               class="btn btn-secondary mt-4">

                Kembali

            </a>

        </form>

    </div>

</div>

@stop
