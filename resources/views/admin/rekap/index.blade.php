@extends('adminlte::page')

@section('title', 'Rekap Pemesanan')

@section('content_header')

<h1>Rekap Pemesanan</h1>

@stop


@section('content')

@if(session('success'))

    <div class="alert alert-success">

        <i class="fas fa-check-circle mr-2"></i>

        {{ session('success') }}

    </div>

@endif


<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Data Rekap Pemesanan
        </h3>

        <div class="card-tools">

            <a href="{{ route('admin.rekap.create') }}"
               class="btn btn-primary">

                <i class="fas fa-plus"></i>

                Tambah Pesanan

            </a>

        </div>

    </div>


    <div class="card-body">


        {{-- FILTER --}}

        <form method="GET" class="mb-4">

            <div class="row">

                <div class="col-md-3">

                    <select
                        name="bulan"
                        class="form-control">

                        <option value="">
                            -- Semua Bulan --
                        </option>

                        @for($i = 1; $i <= 12; $i++)

                            <option
                                value="{{ $i }}"
                                {{ request('bulan') == $i ? 'selected' : '' }}>

                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}

                            </option>

                        @endfor

                    </select>

                </div>


                <div class="col-md-3">

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        placeholder="Tahun"
                        value="{{ request('tahun') }}">

                </div>


                <div class="col-md-4">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-filter"></i>

                        Filter

                    </button>


                    <a
                        href="{{ route('admin.rekap.export.pdf', request()->all()) }}"
                        class="btn btn-danger">

                        <i class="fas fa-file-pdf"></i>

                        Export PDF

                    </a>

                </div>

            </div>

        </form>


        {{-- TABEL --}}

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Pemesan</th>

                        <th>Nama Pengantin</th>

                        <th>Paket</th>

                        <th>Tanggal Acara</th>

                        <th>Lokasi</th>

                        <th>Total</th>

                        <th>DP</th>

                        <th>Pelunasan</th>

                        <th>Status</th>

                        <th width="120">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($rekaps as $rekap)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>
                            <strong>
                                {{ $rekap->nama_pemesan }}
                            </strong>
                        </td>


                        <td>
                            {{ $rekap->nama_pengantin ?? '-' }}
                        </td>


                        <td>
                            {{ $rekap->paket }}
                        </td>


                        <td>

                            {{ $rekap->tanggal_acara->format('d-m-Y') }}

                        </td>


                        <td>

                            {{ $rekap->lokasi_acara ?? '-' }}

                        </td>


                        <td>

                            Rp
                            {{ number_format(
                                $rekap->total_harga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>


                        <td>

                            Rp
                            {{ number_format(
                                $rekap->nominal_dp,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>


                        <td>

                            Rp
                            {{ number_format(
                                $rekap->nominal_pelunasan,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>


                        <td>

                            <span class="badge badge-success">

                                Selesai

                            </span>

                        </td>


                        <td>

                            <a
                                href="{{ route(
                                    'admin.rekap.edit',
                                    $rekap
                                ) }}"
                                class="btn btn-warning btn-sm"
                                title="Edit">

                                <i class="fas fa-edit"></i>

                            </a>


                            <form
                                action="{{ route(
                                    'admin.rekap.destroy',
                                    $rekap
                                ) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm(
                                    'Yakin ingin menghapus data ini?'
                                )">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Hapus">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="11"
                            class="text-center">

                            <i class="fas fa-info-circle mr-2"></i>

                            Belum ada pesanan yang selesai.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- REKAP TOTAL --}}

<div class="row">


    <div class="col-md-4">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>

                    Rp
                    {{ number_format(
                        $totalDP,
                        0,
                        ',',
                        '.'
                    ) }}

                </h3>

                <p>
                    Total DP
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-money-bill-wave"></i>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>

                    Rp
                    {{ number_format(
                        $totalPelunasan,
                        0,
                        ',',
                        '.'
                    ) }}

                </h3>

                <p>
                    Total Pelunasan
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-check-circle"></i>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>

                    Rp
                    {{ number_format(
                        $totalPendapatan,
                        0,
                        ',',
                        '.'
                    ) }}

                </h3>

                <p>
                    Total Pendapatan
                </p>

            </div>

            <div class="icon">

                <i class="fas fa-chart-line"></i>

            </div>

        </div>

    </div>

</div>


@stop
