@extends('adminlte::page')

@section('title','Tambah Paket')

@section('content_header')
<h1>Tambah Paket Dekorasi</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('admin.paket.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            {{-- KATEGORI --}}
            <div class="form-group">

                <label>Kategori Paket</label>

                <select name="kategori_id"
                        class="form-control"
                        required>

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    @foreach($kategori as $item)

                        <option value="{{ $item->id }}"
                            {{ old('kategori_id') == $item->id ? 'selected' : '' }}>

                            {{ $item->nama_kategori }}

                        </option>

                    @endforeach

                </select>

                @error('kategori_id')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- NAMA PAKET --}}
            <div class="form-group mt-3">

                <label>Nama Paket</label>

                <input type="text"
                       name="nama_paket"
                       class="form-control"
                       value="{{ old('nama_paket') }}"
                       required>

                @error('nama_paket')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- HARGA --}}
            <div class="form-group mt-3">

                <label>Harga</label>

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ old('harga') }}"
                           min="0"
                           required>

                </div>

                @error('harga')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- UKURAN DEKORASI --}}
            <div class="form-group mt-3">

                <label>
                    Ukuran Dekorasi
                </label>

                <div class="input-group">

                    <input type="number"
                           name="ukuran_dekorasi"
                           class="form-control"
                           value="{{ old('ukuran_dekorasi') }}"
                           min="0"
                           step="0.1"
                           placeholder="Contoh: 6"
                           required>

                    <span class="input-group-text">
                        meter
                    </span>

                </div>

                <small class="text-muted">
                    Masukkan ukuran maksimal dekorasi dalam meter.
                </small>

                @error('ukuran_dekorasi')
                    <br>
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- INCLUDE --}}
            <div class="form-group mt-3">

                <label>
                    Include Paket
                </label>

                <textarea name="include"
                          class="form-control"
                          rows="8"
                          required>{{ old('include') }}</textarea>

                <small class="text-muted">
                    Tulis satu fasilitas setiap baris.
                </small>

                @error('include')
                    <br>
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- FOTO --}}
            <div class="form-group mt-3">

                <label>
                    Foto Paket
                </label>

                <input type="file"
                       name="foto"
                       class="form-control"
                       accept="image/*">

                <small class="text-muted">
                    Format JPG, JPEG, PNG. Maksimal 2 MB.
                </small>

                @error('foto')
                    <br>
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- STATUS --}}
            <div class="form-group mt-3">

                <label>
                    Status
                </label>

                <select name="status"
                        class="form-control">

                    <option value="Aktif"
                        {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="Nonaktif"
                        {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>

            </div>


            {{-- BUTTON --}}
            <button class="btn btn-primary mt-4">

                <i class="fas fa-save"></i>
                Simpan

            </button>

            <a href="{{ route('admin.paket.index') }}"
               class="btn btn-secondary mt-4">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </form>

    </div>

</div>

@stop
