@extends('layouts.frontend')

@section('title', 'Rekomendasi Paket')

@section('content')

<section class="page-banner text-white"
style="
background:
linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
url('{{ asset('image/hero.jpg') }}');
background-size:cover;
background-position:center;">

    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Rekomendasi Paket
        </h1>

        <p class="lead">
            Temukan paket dekorasi yang sesuai dengan kebutuhan dan budget Anda.
        </p>

    </div>

</section>


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <div class="mb-3">

                            <i class="fas  fa-3x"
                               style="color:#C8A96A;"></i>

                        </div>

                        <h2 class="fw-bold">
                            Cari Paket yang Sesuai
                        </h2>

                        <p class="text-muted mb-0">
                            Masukkan kebutuhan Anda dan sistem akan membantu
                            menentukan paket dekorasi yang paling sesuai.
                        </p>

                    </div>


                    <form action="{{ route('frontend.rekomendasi.proses') }}"
                          method="POST">

                        @csrf


                        {{-- JENIS ACARA --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                <i class="fas fa-calendar-alt me-2"
                                   style="color:#C8A96A;"></i>

                                Jenis Acara

                            </label>

                            <select name="jenis_acara"
                                    class="form-select form-select-lg"
                                    >

                                <option value="">
                                    -- Pilih Jenis Acara --
                                </option>

                                <option value="Lamaran">
                                    Lamaran
                                </option>

                                <option value="Akad">
                                    Akad
                                </option>

                                <option value="Resepsi">
                                    Resepsi
                                </option>

                                <option value="Ngunduh Mantu">
                                    Ngunduh Mantu
                                </option>

                            </select>

                            <small class="text-muted">
                                    Pilih jenis acara jika ingin rekomendasi disesuaikan dengan jenis acara.
                                    Jika tidak dipilih, sistem akan mencari dari semua kategori paket.
                            </small>

                        </div>


                        {{-- BUDGET --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                <i class="fas fa-wallet me-2"
                                   style="color:#C8A96A;"></i>

                                Budget Dekorasi

                            </label>

                            <div class="input-group input-group-lg">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input type="text"
                                    name="budget"
                                    id="budget"
                                    class="form-control"
                                    placeholder="Contoh: 2.500.000"
                                    inputmode="numeric"
                                    value="{{ old('budget') }}"
                                    required>

                            </div>

                            <small class="text-muted">
                                Masukkan batas maksimal budget yang Anda siapkan
                                untuk dekorasi apabila rekomendasi tidak muncul budget tidak memenuhisyarat minimal.
                            </small>

                        </div>


                        {{-- UKURAN LOKASI --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                <i class="fas fa-ruler-horizontal me-2"
                                   style="color:#C8A96A;"></i>

                                Ukuran Area Dekorasi

                                <span class="badge bg-secondary ms-1">
                                    Opsional
                                </span>

                            </label>

                            <div class="input-group input-group-lg">

                                <input type="number"
                                       name="ukuran_lokasi"
                                       class="form-control"
                                       placeholder="Contoh: 6"
                                       min="1"
                                       step="0.5">

                                <span class="input-group-text">
                                    meter
                                </span>

                            </div>

                            <small class="text-muted">

                                Jika Anda mengetahui ukuran area yang tersedia
                                untuk dekorasi, masukkan perkiraannya.
                                Jika belum tahu, boleh dikosongkan.

                            </small>

                        </div>


                        {{-- INFO --}}
                        <div class="alert alert-light border rounded-3 mb-4">

                            <div class="d-flex">

                                <i class="fas fa-info-circle text-primary me-3 mt-1"></i>

                                <div>

                                    <strong>
                                        Bagaimana rekomendasi bekerja?
                                    </strong>

                                    <p class="mb-0 mt-1 text-muted">

                                        Sistem akan mempertimbangkan budget,
                                        kesesuaian ukuran area, dan jumlah
                                        fasilitas paket untuk menentukan
                                        rekomendasi.

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-lg text-white"
                                    style="background:#C8A96A;">

                                <i class="fas fa-search me-2"></i>

                                Cari Rekomendasi

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

.form-control,
.form-select {

    border-radius: 10px;

}

.input-group-text {

    border-radius: 10px 0 0 10px;

    background:#f8f8f8;

}

.card {

    transition: .3s;

}

.card:hover {

    transform: translateY(-3px);

}

</style>

<script>
    const budgetInput = document.getElementById('budget');

    budgetInput.addEventListener('input', function () {

        let value = this.value.replace(/\D/g, '');

        if (value) {
            this.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            this.value = '';
        }

    });
</script>

@endsection
