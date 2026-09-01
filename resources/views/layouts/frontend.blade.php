<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Omah Dekorasi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- lightbox -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">

        <style>

body{

    font-family:'Poppins',sans-serif;

    background:#FAF7F2;

    color:#333;

}

h1,h2,h3,h4{

    font-family:'Playfair Display',serif;

}

.card{

    border:none;

    border-radius:18px;

    transition:.35s;

    box-shadow:0 8px 25px rgba(0,0,0,.08);

}

.card:hover{

    transform:translateY(-8px);

    box-shadow:0 18px 45px rgba(0,0,0,.15);

}

.navbar{

    background:#ffffff !important;

    box-shadow:0 3px 15px rgba(0,0,0,.06);

}

.navbar-brand{

    color:#B8904F !important;

    font-weight:bold;

    font-size:26px;

}

.nav-link{

    color:#333 !important;

    font-weight:500;

    margin-left:15px;

}

.nav-link:hover{

    color:#B8904F !important;

}

.btn-gold{

    background:#B8904F;

    color:white;

    border:none;

    border-radius:50px;

    padding:12px 28px;

}

.btn-gold:hover{

    background:#9c7537;

    color:white;

}

footer{

    background:#222 !important;

}

/* ================= HERO ================= */
    .hero{
    height:100vh;
    background:
        linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.55)),
        url("/image/hero.jpg");
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    color:white;
    position:relative;
}



.hero-content{
    max-width:800px;
    padding:20px;
    animation:fadeUp 1s ease;
}

.hero h1{
    font-size:64px;
    font-weight:700;
    margin-bottom:20px;
}

.hero p{
    font-size:22px;
    line-height:1.7;
    margin-bottom:35px;
}

.btn-gold{
    background:#C8A96A;
    color:white;
    border:none;
    border-radius:50px;
    padding:14px 32px;
    font-weight:600;
}

.btn-gold:hover{
    background:#B8904F;
    color:white;
}

.btn-outline-light{
    border-radius:50px;
    padding:14px 32px;
    font-weight:600;
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@media (max-width:768px){

    .hero h1{
        font-size:42px;
    }

    .hero p{
        font-size:18px;
    }

}

/* ================================== */
.card i{

    transition:.35s;

}

.card:hover i{

    transform:scale(1.2);

    color:#B8904F !important;

}

/* =============================== */
.card-img-top{

    height:260px;

    object-fit:cover;

}

.badge{

    padding:8px 14px;

    border-radius:20px;

}

.card h4{

    font-size:22px;

}

.card-footer{

    background:white;

}
/* ================GALERI================= */
.gallery-item{
    overflow:hidden;
    border-radius:20px;
}

.gallery-item img{
    transition:.5s;
}

.gallery-item:hover img{
    transform:scale(1.08);
}

/* ===================CTA============ */
.step-number{

    width:50px;

    height:50px;

    background:#C8A96A;

    color:white;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-weight:bold;

    font-size:22px;

    margin:auto;

}
/* ================= FOOTER ================= */

.footer-custom{

    background:#1F1F1F;

}

.footer-custom h3,
.footer-custom h5{

    color:white;

}

.footer-custom p{

    color:#d8d8d8;

}

.footer-custom a{

    color:#d8d8d8;

    text-decoration:none;

    transition:.3s;

}

.footer-custom a:hover{

    color:#C8A96A;

    padding-left:6px;

}

.footer-custom i{

    width:24px;

}
/* ==============PAKET============== */
.card-img-top{

    transition:.4s;

}

.card:hover .card-img-top{

    transform:scale(1.05);

}

.badge{

    padding:8px 16px;

    font-size:13px;

}

.card-footer{

    background:white;

}
.page-banner {
    padding-top: 120px;
    padding-bottom: 60px;
    background-size: cover;
    background-position: center;
}
/* ======detail paket========= */
.page-content{

    padding-top:140px;
    padding-bottom:70px;

}
.accordion-button{

    padding:12px 0;

    font-weight:600;

}

.accordion-button:not(.collapsed){

    background:white;

    color:#B8904F;

}

.accordion-button:focus{

    box-shadow:none;

}

.accordion-button::after{

    margin-left:auto;

}

/* ========FORM BOOKING============ */
.form-control{

    border-radius:12px;

    padding:12px;

    border:1px solid #ddd;

}

.form-control:focus{

    border-color:#C8A96A;

    box-shadow:0 0 0 .15rem rgba(200,169,106,.25);

}

.form-label{

    font-weight:600;

}

.card{

    border-radius:18px;

}

.badge{

    font-size:13px;

}

textarea.form-control{

    resize:none;

}

.border.rounded-4{

    transition:.3s;

}

.border.rounded-4:hover{

    border-color:#C8A96A !important;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    transform:translateY(-3px);

}

</style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100" style="z-index:999;">
        <div class="container">

        <a class="navbar-brand fw-bold"
            href="{{ route('home') }}">

            <i class="fa-solid fa-crown"></i>

            Omah Dekorasi

        </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.rekomendasi') }}">
                            Rekomendasi
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.paket') }}">
                            Paket
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('frontend.galeri') }}" class="nav-link">
                            Galeri
                        </a>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                        href="{{ route('frontend.cek.booking') }}">

                            Cek Status

                        </a>

                    </li>

                    <li class="nav-item ms-3">

                        <a href="https://wa.me/628xxxxxxxxxx"

                        target="_blank"

                        class="btn btn-gold">

                            <i class="fab fa-whatsapp"></i>

                            Hubungi Kami

                        </a>

                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            Kontak
                        </a>
                    </li> -->

                </ul>

            </div>

        </div>
    </nav>

    <!-- Content -->
    @yield('content')

<!-- ================= FOOTER ================= -->

<footer class="footer-custom text-white pt-5 pb-3">

    <div class="container">

        <div class="row">

            <!-- Logo -->
            <div class="col-lg-4 mb-4">

                <h3 class="fw-bold">

                    <i class="fa-solid fa-crown text-warning"></i>

                    Omah Dekorasi

                </h3>

                <p class="mt-3">

                    Omah Dekorasi Klaten menyediakan layanan dekorasi
                    untuk Wedding, Lamaran, Akad Nikah,
                    dan berbagai acara spesial lainnya.

                </p>

            </div>

            <!-- Kontak -->

            <div class="col-lg-4 mb-4">

                <h5 class="fw-bold mb-3">

                    Hubungi Kami

                </h5>

                <p>

                    <i class="fas fa-map-marker-alt text-warning"></i>

                    Klaten, Jawa Tengah

                </p>

                <p>

                    <i class="fab fa-whatsapp text-warning"></i>

                    08xxxxxxxxxx

                </p>

                <p>

                    <i class="fas fa-envelope text-warning"></i>

                    omahdekorasi@gmail.com

                </p>
                <div class="mt-4">

    <a href="#" class="me-3">

        <i class="fab fa-instagram fa-lg"></i>

    </a>

    <a href="#" class="me-3">

        <i class="fab fa-facebook fa-lg"></i>

    </a>

    <a href="https://wa.me/628xxxxxxxxxx">

        <i class="fab fa-whatsapp fa-lg"></i>

    </a>

</div>

            </div>

            <!-- Menu -->

            <div class="col-lg-4 mb-4">

                <h5 class="fw-bold mb-3">

                    Menu

                </h5>

                <p>

                    <a href="{{ route('home') }}">

                        Home

                    </a>

                </p>

                <p>
                <a href="{{ route('frontend.rekomendasi') }}">

                    <!-- <i class="fas fa-magic me-1"></i> -->

                    Rekomendasi Paket

                </a>
                </p>

                <p>

                    <a href="{{ route('frontend.galeri') }}">

                        Galeri

                    </a>

                </p>

                <p>

                    <a href="{{ route('frontend.cek.booking') }}">

                        Cek Booking

                    </a>

                </p>

            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center">

            © {{ date('Y') }}

            Omah Dekorasi Klaten.

            All Rights Reserved.

        </div>

    </div>

</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- lightbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<script>
lightbox.option({
    resizeDuration:200,
    wrapAround:true,
    fadeDuration:250,
    imageFadeDuration:250,
    albumLabel:"Foto %1 dari %2"
});
</script>

</body>

</html>
