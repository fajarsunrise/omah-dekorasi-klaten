@extends('adminlte::page')

@section('title', 'Edit Rekap Pemesanan')

@section('content_header')
    <h1>Edit Rekap Pemesanan</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Edit Data Pemesanan
        </h3>
    </div>

    <form action="{{ route('admin.rekap.update', $rekap->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- NAMA PEMESAN --}}
            <div class="form-group mb-3">

                <label>
                    Nama Pemesan
                </label>

                <input
                    type="text"
                    name="nama_pemesan"
                    class="form-control"
                    value="{{ old('nama_pemesan', $rekap->nama_pemesan) }}"
                    required>

            </div>


            {{-- NAMA PENGANTIN --}}
            <div class="form-group mb-3">

                <label>
                    Nama Pengantin
                </label>

                <input
                    type="text"
                    name="nama_pengantin"
                    class="form-control"
                    value="{{ old('nama_pengantin', $rekap->nama_pengantin) }}">

            </div>


            {{-- NO WA --}}
            <div class="form-group mb-3">

                <label>
                    No. WhatsApp
                </label>

                <input
                    type="text"
                    name="no_wa"
                    class="form-control"
                    value="{{ old('no_wa', $rekap->no_wa) }}">

            </div>


            {{-- PAKET --}}
            <div class="form-group mb-3">

                <label>
                    Paket
                </label>

                <input
                    type="text"
                    name="paket"
                    class="form-control"
                    value="{{ old('paket', $rekap->paket) }}"
                    required>

            </div>


            {{-- TANGGAL ACARA --}}
            <div class="form-group mb-3">

                <label>
                    Tanggal Acara
                </label>

                <input
                    type="date"
                    name="tanggal_acara"
                    class="form-control"
                    value="{{ old('tanggal_acara', $rekap->tanggal_acara) }}"
                    required>

            </div>


            {{-- LOKASI --}}
            <div class="form-group mb-3">

                <label>
                    Lokasi Acara
                </label>

                <textarea
                    name="lokasi_acara"
                    class="form-control"
                    rows="3">{{ old('lokasi_acara', $rekap->lokasi_acara) }}</textarea>

            </div>


            {{-- TOTAL HARGA --}}
            <div class="form-group mb-3">

                <label>
                    Total Harga
                </label>

                <input
                    type="number"
                    name="total_harga"
                    class="form-control"
                    value="{{ old('total_harga', $rekap->total_harga) }}"
                    min="0"
                    required>

            </div>


            {{-- DP --}}
            <div class="form-group mb-3">

                <label>
                    DP
                </label>

                <input
                    type="number"
                    name="nominal_dp"
                    class="form-control"
                    value="{{ old('nominal_dp', $rekap->nominal_dp) }}"
                    min="0">

            </div>


            {{-- PELUNASAN --}}
            <div class="form-group mb-3">

                <label>
                    Pelunasan
                </label>

                <input
                    type="number"
                    name="nominal_pelunasan"
                    class="form-control"
                    value="{{ old('nominal_pelunasan', $rekap->nominal_pelunasan) }}"
                    min="0">

            </div>


            {{-- KETERANGAN --}}
            <div class="form-group mb-3">

                <label>
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    class="form-control"
                    rows="3">{{ old('keterangan', $rekap->keterangan) }}</textarea>

            </div>

        </div>


        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">

                <i class="fas fa-save"></i>
                Simpan Perubahan

            </button>


            <a href="{{ route('admin.rekap.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </form>

</div>

@stop
