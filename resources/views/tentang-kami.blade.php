@extends('layouts.app')

@section('title', 'Moeket - Tentang Kami')

@section('content')
</head>
<body>
<!-- Hero Section -->
<section class="hero-section wave-container">
    <div class="wave-bg">
        <div class="orange-section"></div>
    </div>
    <div class="container">
        <div class="row align-items-center min-vh-60">
            <div class="col-lg-12 mx-auto text-center">
                <!-- Decorative Sparkles -->
                <div class="position-relative mb-4">
                    <span class="sparkle position-absolute" style="top: -120px; left: 10%; font-size: 6rem;">✨</span>
                    <span class="sparkle position-absolute" style="top: -20px; right: 8%; font-size: 4rem;">✨</span>
                    <h1 class="display-3 fw-bold mb-4">Tentang Kami</h1>
                </div>
                
                <p class="lead mb-5 fs-4">
                    Platform terdepan untuk pemesanan tiket festival, konser, volunteer, dan expo di Indonesia. Kami menghubungkan event organizer dengan jutaan pencinta acara di seluruh nusantara.
                </p>

                <!-- Tentang Images Grid -->
                <div class="row g-3 mb-5 justifice-content-center align-items-center">
                    <div class="col-md-3 col-6">
                        <div class="position-relative">
                            <img src="images/welcome/cat.jpg" class="card-img-top h-100 rounded-3 rounded-3 w-100"
                                style="aspect-ratio: 1/1; object-fit: cover; background: linear-gradient(45deg, #ff6b6b, #ee5a24);" 
                                alt="Tentang image">
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <div class="position-relative">
                            <img src="images/welcome/cat.jpg" class="card-img-top h-100 rounded-3 rounded-3 w-100"
                                class="img-fluid rounded-3 w-100" 
                                style="aspect-ratio: 4/3; object-fit: cover; background: linear-gradient(45deg, #26de81, #20bf6b);" 
                                alt="Tentang image">
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <div class="position-relative">
                            <img src="images/welcome/cat.jpg" class="card-img-top h-100 rounded-3 rounded-3 w-100"
                                style="aspect-ratio: 1/1; object-fit: cover; background: linear-gradient(45deg, #ff6b6b, #ee5a24);" 
                                alt="Tentang image">
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <div class="position-relative">
                            <img src="images/welcome/cat.jpg" class="card-img-top h-100 rounded-3 rounded-3 w-100"
                                class="img-fluid rounded-3 w-100" 
                                style="aspect-ratio: 4/3; object-fit: cover; background: linear-gradient(45deg, #26de81, #20bf6b);" 
                                alt="Tentang image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="feature-section">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h2 class="display-5 fw-bold text-muted mb-4">Mudah, Aman, Terpercaya, Lengkap, Efisien.</h2>
                        <p class="fs-5 text-muted mb-4">
                            Moeket adalah platform penjualan tiket event yang terpercaya untuk memudahkan penyelenggara dan pengunjung dalam mengelola serta mendapatkan tiket acara. Dengan fitur lengkap, sistem yang aman, dan komisi terjangkau, kami menjadi solusi cerdas bagi event organizer dan pengalaman terbaik bagi penikmat acara. Misi kami adalah menghadirkan kemudahan, kenyamanan, dan kepercayaan dalam setiap transaksi tiket.
                        </p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <!-- Phone Mockup -->
                        <div class="bg-transparent d-inline-block rounded-3 position-relative">
                            <!-- Image Container -->
                            <img src="images/tentang/hp.png" 
                                class="img-fluid rounded-3 w-100 d-block"
                                style="aspect-ratio: 1/1; object-fit: cover;" 
                                alt="Tentang image">
                            
                            <!-- Centered Brand Overlay -->
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
                                <a class="navbar-brand d-flex align-items-center" 
                                    href="{{ url('/') }}"
                                    style="transform: translate(14px, -5px) rotate(-5deg);">
                                    <div class="gradient-icon me-2"></div>
                                    <span class="brand-name">moeket</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-number">100+</div>
                <div class="stat-label">Event Tersedia</div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-number">15,000+</div>
                <div class="stat-label">Tiket Terjual</div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-number">10+</div>
                <div class="stat-label">Event Organizer</div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-number">20+</div>
                <div class="stat-label">Kota di Indonesia</div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 text-muted category-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Kategori Event</h2>
            <p class="lead">Berbagai jenis acara yang dapat Anda temukan di platform kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Festival</h5>
                    <p class="small mb-0">Music festival, festival makanan, dan berbagai festival menarik lainnya</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-guitar"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Konser</h5>
                    <p class="small mb-0">Konser musik terbaru dari artis lokal hingga internasional</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Volunteer</h5>
                    <p class="small mb-0">Program volunteer dan kegiatan sosial kemasyarakatan</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Expo</h5>
                    <p class="small mb-0">Pameran dagang, expo startup, exhibition, dan lainnya</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h2 class="display-4 fw-bold mb-4">
                    Siap bergabung dengan <span style="color: #ffd700; font-family: 'Josefin Sans', sans-serif; font-weight: 700;">🎫 moeket</span> ?
                </h2>
                <p class="lead mb-5">
                    Mulai jual event Anda atau temukan acara menarik di sekitar Anda. Bergabunglah dengan ribuan event organizer dan jutaan pengunjung yang telah mempercayai platform kami.
                </p>
                
                <div class="d-flex justify-content-center flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-custom btn-primary-custom">
                        Daftar EO <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ url('/events') }}" class="btn btn-outline-light btn-custom btn-outline-custom">
                        Cari Tiket <i class="fas fa-search ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .wave-container {
        padding-top: 250px;
        width: 100%;
        min-height: 160vh;
        z-index: -2;
    }

    .wave-bg {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--bg-default);
        clip-path: ellipse(120% 60% at 50% 100%);
        z-index: -1;
    }

    .orange-section {
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        height: 100%;
        background: linear-gradient(135deg, #ff9a56 0%, #ff6b35 100%);
        clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    .stats-section {
        background: white;
        padding: 60px 0;
    }

    .category-section {
        background: var(--bg-default);
    }

    .category-card {
        background: white;
        border-radius: 20px;
        padding: 40px 20px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .category-card:hover {
        transform: translateY(-10px);
    }

    .category-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 15px;
    }

    .feature-section {
        background: transparent;
        margin: 120px 0;
        color: blue;
    }

    .phone-mockup {
        max-width: 300px;
        height: auto;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--gradient-start) 30%, var(--gradient-end) 100%);
        padding: 80px 0;
        color: white;
    }

    .btn-custom {
        padding: 15px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary-custom {
        background: white;
        color: var(--gradient-end);
        border: 2px solid white;
    }

    .btn-outline-custom {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        border: 2px solid white;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--gradient-end);
    }

    .stat-label {
        color: var(--gradient-end);
        font-size: 1.1rem;
    }
</style>
@endsection