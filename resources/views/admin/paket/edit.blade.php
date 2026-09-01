@extends('adminlte::page')

@section('title', 'Edit Paket')

@section('content_header')
    <h1>Edit Paket Dekorasi</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        {{-- ===================================================== --}}
        {{-- PESAN SUCCESS --}}
        {{-- ===================================================== --}}

        @if(session('success'))

            <div class="alert alert-success">

                <i class="fas fa-check-circle"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- ERROR VALIDASI --}}
        {{-- ===================================================== --}}

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        {{-- ===================================================== --}}
        {{-- FORM UPDATE DATA PAKET --}}
        {{-- ===================================================== --}}

        <form
            id="form-update-paket"
            action="{{ route('admin.paket.update', $paket->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')


            {{-- ================================================= --}}
            {{-- KATEGORI --}}
            {{-- ================================================= --}}

            <div class="form-group">

                <label>
                    Kategori Paket
                </label>

                <select
                    name="kategori_id"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    @foreach($kategori as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ old('kategori_id', $paket->kategori_id) == $item->id ? 'selected' : '' }}>

                            {{ $item->nama_kategori }}

                        </option>

                    @endforeach

                </select>

            </div>



            {{-- ================================================= --}}
            {{-- NAMA PAKET --}}
            {{-- ================================================= --}}

            <div class="form-group mt-3">

                <label>
                    Nama Paket
                </label>

                <input
                    type="text"
                    name="nama_paket"
                    class="form-control"
                    value="{{ old('nama_paket', $paket->nama_paket) }}"
                    required>

            </div>



            {{-- ================================================= --}}
            {{-- HARGA --}}
            {{-- ================================================= --}}

            <div class="form-group mt-3">

                <label>
                    Harga
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="{{ old('harga', $paket->harga) }}"
                        min="0"
                        required>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- UKURAN DEKORASI --}}
            {{-- ================================================= --}}

            <div class="form-group mt-3">

                <label>
                    Ukuran Dekorasi
                </label>

                <div class="input-group">

                    <input
                        type="number"
                        name="ukuran_dekorasi"
                        class="form-control"
                        value="{{ old('ukuran_dekorasi', $paket->ukuran_dekorasi) }}"
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

            </div>



            {{-- ================================================= --}}
            {{-- INCLUDE PAKET --}}
            {{-- ================================================= --}}

            <div class="form-group mt-3">

                <label>
                    Include Paket
                </label>

                <textarea
                    name="include"
                    class="form-control"
                    rows="8"
                    required>{{ old('include', $paket->include) }}</textarea>

                <small class="text-muted">

                    Tulis satu fasilitas setiap baris.

                </small>

            </div>



            {{-- ================================================= --}}
            {{-- FOTO PAKET --}}
            {{-- ================================================= --}}

            <div class="form-group mt-3">

                <label>
                    Foto Paket
                </label>

                <input
                    type="file"
                    name="foto"
                    class="form-control"
                    accept="image/*">

                <small class="text-muted">

                    Format JPG, JPEG, PNG. Maksimal 2 MB.

                </small>


                {{-- FOTO LAMA --}}

                @if($paket->foto)

                    <div class="mt-3">

                        <p class="mb-2">

                            <strong>
                                Foto saat ini:
                            </strong>

                        </p>

                        <img
                            src="{{ asset('storage/paket/'.$paket->foto) }}"
                            width="150"
                            class="img-thumbnail">

                    </div>

                @endif

            </div>

        </form>



        {{-- ===================================================== --}}
        {{-- PEMISAH --}}
        {{-- ===================================================== --}}

        <hr class="my-4">



        {{-- ===================================================== --}}
        {{-- TANGGAL FULL BOOKING --}}
        {{-- ===================================================== --}}

        <div class="form-group">

            <h4>

                <i class="fas fa-calendar-times text-danger"></i>

                Tanggal Full Booking

            </h4>


            <p class="text-muted">

                Tambahkan tanggal ketika paket ini sudah penuh
                dan tidak dapat dipesan oleh customer.

            </p>



            {{-- ================================================= --}}
            {{-- FORM TAMBAH TANGGAL FULL --}}
            {{-- ================================================= --}}

            <form
                action="{{ route('admin.paket.tanggal-full.store', $paket->id) }}"
                method="POST"
                class="mb-4">

                @csrf


                <div class="row">

                    <div class="col-md-5">

                        <label>
                            Pilih Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            min="{{ date('Y-m-d') }}"
                            required>

                    </div>


                    <div class="col-md-3">

                        <label>
                            &nbsp;
                        </label>

                        <div>

                            <button
                                type="submit"
                                class="btn btn-danger">

                                <i class="fas fa-calendar-times"></i>

                                Tandai Full

                            </button>

                        </div>

                    </div>

                </div>

            </form>



            {{-- ================================================= --}}
            {{-- DAFTAR TANGGAL FULL --}}
            {{-- ================================================= --}}

            <div class="card">

                <div class="card-header bg-light">

                    <strong>

                        <i class="fas fa-calendar-alt"></i>

                        Daftar Tanggal Full

                    </strong>

                </div>


                <div class="card-body p-0">


                    {{-- ================================================= --}}
                    {{-- JIKA ADA TANGGAL FULL --}}
                    {{-- ================================================= --}}

                    @if($paket->fullBookings->count())

                        <div class="table-responsive">

                            <table
                                class="table table-bordered table-hover mb-0">

                                <thead>

                                    <tr>

                                        <th
                                            width="60"
                                            class="text-center">

                                            No

                                        </th>


                                        <th>

                                            Tanggal

                                        </th>


                                        <th
                                            width="150"
                                            class="text-center">

                                            Aksi

                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach(
                                        $paket->fullBookings
                                            ->sortBy('tanggal')
                                        as $fullBooking
                                    )

                                        <tr>


                                            {{-- NOMOR --}}

                                            <td class="text-center">

                                                {{ $loop->iteration }}

                                            </td>



                                            {{-- TANGGAL --}}

                                            <td>

                                                {{ $fullBooking->tanggal_full->format('d-m-Y') }}

                                            </td>



                                            {{-- AKSI --}}

                                            <td class="text-center">

                                                <form
                                                    action="{{ route(
                                                        'admin.paket.tanggal-full.destroy',
                                                        [
                                                            'paket' => $paket->id,
                                                            'fullBooking' => $fullBooking->id
                                                        ]
                                                    ) }}"
                                                    method="POST"
                                                    style="display:inline-block;">

                                                    @csrf

                                                    @method('DELETE')


                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tanggal full booking ini?')">

                                                        <i class="fas fa-trash"></i>

                                                        Hapus

                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                    {{-- ================================================= --}}
                    {{-- JIKA BELUM ADA TANGGAL --}}
                    {{-- ================================================= --}}

                    @else

                        <div class="p-3 text-muted">

                            <i class="fas fa-info-circle"></i>

                            Belum ada tanggal yang ditandai full.

                        </div>

                    @endif

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- TOMBOL SIMPAN DAN KEMBALI --}}
        {{-- ===================================================== --}}

        <div class="mt-4 pt-3 border-top">

            <button
                type="submit"
                form="form-update-paket"
                class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>


            <a
                href="{{ route('admin.paket.index') }}"
                class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>


    </div>

</div>

@stop
