<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Ticketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body, html {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }
        .hero-section {
            background: url('{{ asset('images/landing-bg.jpg') }}') center center/cover no-repeat;
            height: 100vh;
            color: white;
            position: relative;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.4);
            position: absolute;
            height: 100%;
            width: 100%;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }
        .date-top {
            position: absolute;
            top: 80px;
            right: 30px;
            z-index: 2;
            font-size: 16px;
            font-weight: 500;
        }
        .section-title {
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
        }
        .footer {
            background: #212529;
            color: white;
            padding: 40px 0;
        }
        .custom-navbar {
            background-color: rgba(33, 37, 41, 0.6); /* transparan */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px); /* Safari support */
            transition: background-color 0.3s ease;
        }
        .img-fixed {
            width: 100%;
            height: 400px;
            object-fit: cover; /* agar gambar crop otomatis */
        }
        .img-crop-atas {
            object-position: center top;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">E-Ticketing</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section d-flex align-items-center">
    <div class="overlay"></div>
    <div class="date-top text-white">
        <i class="bi bi-calendar3 me-2"></i>
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </div>
    <div class="container">
        <div class="hero-content text-start ms-5">
            <h1 class="display-4 fw-bold">Selamat Datang di E-Ticketing</h1>
            <p class="lead mb-0">Solusi mudah membeli tiket event favorit secara online</p>
        </div>
    </div>
</section>

<section id="about" class="py-5 bg-dark text-white">
    <div class="container">
        <h2 class="section-title text-white">About Us</h2>

        <!-- Blok 1 -->
        <div class="row mb-5">
            <div class="col-md-6">
                <img src="{{ asset('images/about/about1.jpg') }}" alt="About 1" class="img-fixed rounded shadow">
            </div>
            <div class="col-md-6 pt-md-4">
                <h2>Platform Tiket Masa Kini</h2>
                <p>
                    E-Ticketing adalah platform modern untuk membeli tiket acara secara online. Kami mempermudah pengguna menemukan dan mengamankan tiket tanpa harus keluar rumah.
                </p>
            </div>
        </div>

        <!-- Blok 2 -->
        <div class="row mb-5 flex-md-row-reverse">
            <div class="col-md-6">
                <img src="{{ asset('images/about/about2.jpg') }}" alt="About 2" class="img-fixed img-crop-atas rounded shadow">
            </div>
            <div class="col-md-6 pt-md-4">
                <h2>Acara Sesuai Minatmu</h2>
                <p>
                    Dengan berbagai pilihan acara mulai dari konser, cosplay, seminar, hingga pameran UMKM, kami menyediakan pengalaman pembelian tiket yang cepat, aman, dan nyaman.
                </p>
            </div>
        </div>

        <!-- Blok 3 -->
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/about/about3.jpg') }}" alt="About 3" class="img-fixed rounded shadow">
            </div>
            <div class="col-md-6 pt-md-4">
                <h2>Teknologi untuk Masa Depan Event</h2>
                <p>
                    Visi kami adalah menjadikan E-Ticketing sebagai solusi utama dalam digitalisasi event, mendukung penyelenggara dan pengunjung dengan teknologi yang efisien.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="events" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Upcoming Events</h2>
        <div class="row g-4">
            @foreach(range(2, 4) as $event)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://picsum.photos/seed/event{{$event}}/400/200" class="card-img-top" alt="Event {{$event}}">
                    <div class="card-body">
                        <h5 class="card-title">Event Name</h5>
                        <p class="card-text">Deskripsi singkat event yang mantap.</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="footer text-center">
    <div class="container">
        <p class="mb-1 fw-bold">E-Ticketing</p>
        <p>Email: support@eticketing.id | WhatsApp: +62 8123 4567 8910</p>
        <p>&copy; {{ date('Y') }} E-Ticketing. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
