@extends('adminlte::page')

@section('title', 'Tambah Rekap Pemesanan')


@section('content_header')

<h1>Tambah Rekap Pemesanan</h1>

@stop


@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Tambah Pesanan
        </h3>

    </div>


    <form
        action="{{ route('admin.rekap.store') }}"
        method="POST">

        @csrf


        <div class="card-body">


            <div class="alert alert-info">

                <i class="fas fa-info-circle mr-2"></i>

                Form ini digunakan untuk mencatat pesanan
                yang dilakukan di luar sistem.

            </div>


            {{-- NAMA PEMESAN --}}

            <div class="form-group">

                <label>
                    Nama Pemesan
                </label>

                <input
                    type="text"
                    name="nama_pemesan"
                    class="form-control @error('nama_pemesan') is-invalid @enderror"
                    value="{{ old('nama_pemesan') }}"
                    required>

                @error('nama_pemesan')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- NAMA PENGANTIN --}}

            <div class="form-group">

                <label>
                    Nama Pengantin
                </label>

                <input
                    type="text"
                    name="nama_pengantin"
                    class="form-control"
                    value="{{ old('nama_pengantin') }}">

            </div>


            {{-- PAKET --}}

            <div class="form-group">

                <label>
                    Paket
                </label>

                <input
                    type="text"
                    name="paket"
                    class="form-control @error('paket') is-invalid @enderror"
                    value="{{ old('paket') }}"
                    required>

                @error('paket')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- TANGGAL --}}

            <div class="form-group">

                <label>
                    Tanggal Acara
                </label>

                <input
                    type="date"
                    name="tanggal_acara"
                    class="form-control @error('tanggal_acara') is-invalid @enderror"
                    value="{{ old('tanggal_acara') }}"
                    required>

            </div>


            {{-- LOKASI --}}

            <div class="form-group">

                <label>
                    Lokasi Acara
                </label>

                <textarea
                    name="lokasi_acara"
                    class="form-control"
                    rows="3">{{ old('lokasi_acara') }}</textarea>

            </div>


            <div class="row">


                {{-- TOTAL --}}

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Total Harga
                        </label>

                        <input
                            type="number"
                            name="total_harga"
                            class="form-control"
                            min="0"
                            value="{{ old('total_harga', 0) }}"
                            required>

                    </div>

                </div>


                {{-- DP --}}

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Nominal DP
                        </label>

                        <input
                            type="number"
                            name="nominal_dp"
                            class="form-control"
                            min="0"
                            value="{{ old('nominal_dp', 0) }}">

                    </div>

                </div>


                {{-- PELUNASAN --}}

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Nominal Pelunasan
                        </label>

                        <input
                            type="number"
                            name="nominal_pelunasan"
                            class="form-control"
                            min="0"
                            value="{{ old('nominal_pelunasan', 0) }}">

                    </div>

                </div>

            </div>


        </div>


        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>


            <a
                href="{{ route('admin.rekap.index') }}"
                class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </form>

</div>

@stop
