@extends('adminlte::page')

@section('title','Galeri')

@section('content_header')
<h1>Galeri Dekorasi</h1>
@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="mb-3">

    <a href="{{ route('admin.galeri.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Foto

    </a>

</div>

<div class="row">

@forelse($galeris as $galeri)

<div class="col-md-3">

    <div class="card">

        <img src="{{ asset('uploads/galeri/'.$galeri->foto) }}"
             class="card-img-top"
             style="height:220px; object-fit:cover;">

        <div class="card-body">

            <h5 class="card-title">

            @if($galeri->judul)
                <h5 class="card-title">
                    {{ $galeri->judul }}
                </h5>
            @endif

            </h5>

        </div>

        <div class="card-footer text-center">

            <a href="{{ route('admin.galeri.edit',$galeri) }}"
               class="btn btn-warning btn-sm">

                <i class="fas fa-edit"></i>

            </a>

            <form action="{{ route('admin.galeri.destroy',$galeri) }}"
                  method="POST"
                  style="display:inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus foto ini?')">

                    <i class="fas fa-trash"></i>

                </button>

            </form>

        </div>

    </div>

</div>

@empty

<div class="col-12">

    <div class="alert alert-info">

        Belum ada foto galeri.

    </div>

</div>

@endforelse

</div>

@stop
