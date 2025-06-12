@extends('layouts.app')

@section('title', 'Moeket - Temukan Event Terbaik di Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container h-100 d-flex align-items-center">
        <div class="row w-100 align-items-end">
            <div class="col-lg-6" style="padding-bottom: 80px">
                <h1 class="display-4 fw-bold mb-4">Temukan Event Terbaik di Indonesia</h1>
                <p class="lead mb-4">Ikuti festival hingga kegiatan volunteer dari Event Organizer terpercaya!</p>
                <a href="#events" class="btn btn-outline-light btn-lg px-4">Dapatkan Tiket ></a>
            </div>
            <div class="col-lg-6 text-end">
                <img src="images/welcome/singer.png" alt="Event Image" class="img-fluid" style="width: 400px; border-radius: 20px 20px 0px 0px;">
            </div>
        </div>
    </div>
    <div class="radius-top py-5 bg-light"></div>
</section>


<!-- Popular Events Section -->
<section class="py-5 bg-light" id="events">
    <div class="container position-relative">
        <h2 class="h3 fw-bold mb-4">Paling sering dibeli</h2>
        
        <button class="scroll-button scroll-left" aria-label="Scroll left">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="scrolling-wrapper">
            @forelse($popularEvents as $event)
                <div class="card card-hover shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="position-relative h-100">
                        <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/no-img.jpg') }}"
                            alt="{{ $event->title }}"
                            class="w-100 h-100 object-fit-cover">
                        <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                            <span class="small card-category">{{ $event->category }}</span>
                            <h5 class="card-title mb-1">{{ $event->title }}</h5>
                            <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</p>
                            <p class="small mb-1"><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}</p>
                            <p class="small mb-2"><i class="fas fa-tag me-1"></i>
                                {{ $event->tickets->min('price') ? 'Rp ' . number_format($event->tickets->min('price'), 0, ',', '.') : 'Gratis' }}
                            </p>
                            <div class="card-actions d-flex align-items-center gap-2">
                                @auth
                                    <button type="button" 
                                        class="btn-favorite {{ auth()->user()->favorites->contains($event->id) ? 'favorited' : '' }}" 
                                        onclick="toggleFavorite(this, {{ $event->id }}, {{ auth()->user()->favorites->contains($event->id) ? 'true' : 'false' }})">
                                        <i class="{{ auth()->user()->favorites->contains($event->id) ? 'fas' : 'far' }} fa-heart"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-favorite" title="Login untuk menyimpan favorit">
                                        <i class="far fa-heart"></i>
                                    </a>
                                @endauth

                                <a href="{{ route('events.show', $event) }}" class="btn btn-detail">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div id="noResults" class="text-center mt-4">
                <div class="alert alert-info px-5">
                    <i class="fas fa-search me-2"></i>
                    Belum ada event yang tersedia.
                </div>
            </div>
            @endforelse
        </div>
        
        <button class="scroll-button scroll-right" aria-label="Scroll right">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>

<!-- Nearest Events Section -->
<section class="py-5 bg-light">
    <div class="container position-relative">
        <h2 class="h3 fw-bold mb-4">Event Terdekat</h2>
        
        <button class="scroll-button scroll-left" aria-label="Scroll left">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="scrolling-wrapper">
            @forelse($upcomingEvents as $event)
                <div class="card card-hover shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="position-relative h-100">
                        <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/no-img.jpg') }}"
                            alt="{{ $event->title }}"
                            class="w-100 h-100 object-fit-cover">
                        <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                            <span class="small card-category">{{ $event->category }}</span>
                            <h5 class="card-title mb-1">{{ $event->title }}</h5>
                            <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</p>
                            <p class="small mb-1"><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}</p>
                            <p class="small mb-2"><i class="fas fa-tag me-1"></i>
                                {{ $event->tickets->min('price') ? 'Rp ' . number_format($event->tickets->min('price'), 0, ',', '.') : 'Gratis' }}
                            </p>
                            <div class="card-actions d-flex align-items-center gap-2">
                                 @auth
                                    <button type="button" 
                                        class="btn-favorite {{ auth()->user()->favorites->contains($event->id) ? 'favorited' : '' }}" 
                                        onclick="toggleFavorite(this, {{ $event->id }}, {{ auth()->user()->favorites->contains($event->id) ? 'true' : 'false' }})">
                                        <i class="{{ auth()->user()->favorites->contains($event->id) ? 'fas' : 'far' }} fa-heart"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-favorite" title="Login untuk menyimpan favorit">
                                        <i class="far fa-heart"></i>
                                    </a>
                                @endauth

                                <a href="{{ route('events.show', $event) }}" class="btn btn-detail">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div id="noResults" class="text-center mt-4">
                <div class="alert alert-info px-5">
                    <i class="fas fa-search me-2"></i>
                    Belum ada event yang tersedia.
                </div>
            </div>
            @endforelse
        </div>
        
        <button class="scroll-button scroll-right" aria-label="Scroll right">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>

<!-- Latest Events Section -->
<section class="py-5 bg-light">
    <div class="container position-relative">
        <h2 class="h3 fw-bold mb-4">Terbaru</h2>
        
        <button class="scroll-button scroll-left" aria-label="Scroll left">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="scrolling-wrapper">
            @forelse($latestEvents as $event)
                <div class="card card-hover shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="position-relative h-100">
                        <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/no-img.jpg') }}"
                            alt="{{ $event->title }}"
                            class="w-100 h-100 object-fit-cover">
                        <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                            <span class="small card-category">{{ $event->category }}</span>
                            <h5 class="card-title mb-1">{{ $event->title }}</h5>
                            <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</p>
                            <p class="small mb-1"><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}</p>
                            <p class="small mb-2"><i class="fas fa-tag me-1"></i>
                                {{ $event->tickets->min('price') ? 'Rp ' . number_format($event->tickets->min('price'), 0, ',', '.') : 'Gratis' }}
                            </p>
                            <div class="card-actions d-flex align-items-center gap-2">
                                 @auth
                                    <button type="button" 
                                        class="btn-favorite {{ auth()->user()->favorites->contains($event->id) ? 'favorited' : '' }}" 
                                        onclick="toggleFavorite(this, {{ $event->id }}, {{ auth()->user()->favorites->contains($event->id) ? 'true' : 'false' }})">
                                        <i class="{{ auth()->user()->favorites->contains($event->id) ? 'fas' : 'far' }} fa-heart"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-favorite" title="Login untuk menyimpan favorit">
                                        <i class="far fa-heart"></i>
                                    </a>
                                @endauth

                                <a href="{{ route('events.show', $event) }}" class="btn btn-detail">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div id="noResults" class="text-center mt-4">
                <div class="alert alert-info px-5">
                    <i class="fas fa-search me-2"></i>
                    Belum ada event yang tersedia.
                </div>
            </div>
            @endforelse
        </div>
        
        <button class="scroll-button scroll-right" aria-label="Scroll right">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="h3 fw-bold mb-4">Punya event ? Jual Tiketmu di <span style="color: #ffd700;">🎫 moeket</span> !</h2>
                <p class="lead mb-4">Platform terpercaya untuk menjual tiket event, solusi cerdas untuk mensukseskan event Anda!</p>
                <a href="mailto:wildanhabib436@gmail.com" class="btn btn-light btn-lg px-4" target="_top">Daftar Sebagai Penyelenggara ></a>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="py-5" style="background: var(--bg-default);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 custom-image-layout">
                <div class="experience-container">
                    <div class="large-image-container">
                        <img src="images/welcome/konser.jpg" 
                            class="large-image" 
                            alt="Event Experience">
                    </div>
                    <div class="small-images-container">
                        <img src="images/welcome/expo.jpg" 
                            class="small-image" 
                            alt="Event Experience">
                        <img src="images/welcome/volunteer.jpg" 
                            class="small-image" 
                            alt="Event Experience">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="h3 fw-bold mb-4">Jangan lewatkan acaranya, Beli tiketmu sekarang!</h2>
                <p class="mb-4">Rasakan pengalaman seru di acara spesial ini bersama teman dan keluarga dengan mudah dan cepat hanya dalam beberapa klik!</p>
                <a href="{{ route('events.index') }}" class="btn btn-outline-gradient px-4">Cari Tiket ></a>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
    .card-category {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        margin-bottom: 8px;
    }

    .container.position-relative {
        position: relative;
    }

    .scrolling-wrapper {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 1rem;
        scroll-behavior: smooth;
        -ms-overflow-style: none;  /* Hide scrollbar for IE and Edge */
        scrollbar-width: none;  /* Hide scrollbar for Firefox */
        padding: 0.5rem 0;
    }

    .scrolling-wrapper::-webkit-scrollbar {
        display: none; /* Hide scrollbar for Chrome, Safari and Opera */
    }

    .scrolling-wrapper .card {
        flex: 0 0 auto;
    }

    .scroll-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: white;
        border: none;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .scroll-left {
        left: -20px;
    }

    .scroll-right {
        right: -20px;
    }

    .container:hover .scroll-button {
        opacity: 1;
    }

    .scroll-button:hover {
        background-color: #f8f9fa;
    }

    .scroll-button i {
        color: #333;
        font-size: 1rem;
    }

    .custom-image-layout {
        height: 400px; /* Atur tinggi sesuai kebutuhan */
    }

    .experience-container {
        display: flex;
        height: 100%;
        gap: 15px;
    }

    .large-image-container {
        width: 60%; /* Lebar gambar besar */
        height: 100%;
    }

    .small-images-container {
        width: 40%; /* Lebar container gambar kecil */
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .large-image, .small-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .small-image {
        height: calc(50% - 7.5px); /* 50% dikurangi setengah gap */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.scrolling-wrapper').forEach(scrollContainer => {
            const container = scrollContainer.closest('.container');
            const scrollLeftBtn = container.querySelector('.scroll-left');
            const scrollRightBtn = container.querySelector('.scroll-right');

            scrollLeftBtn?.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
            });

            scrollRightBtn?.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
            });
        });
        
        // Hide/show buttons based on scroll position
        scrollContainer.addEventListener('scroll', () => {
            const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
            
            if (scrollContainer.scrollLeft <= 0) {
                scrollLeftBtn.style.display = 'none';
            } else {
                scrollLeftBtn.style.display = 'flex';
            }
            
            if (scrollContainer.scrollLeft >= maxScroll) {
                scrollRightBtn.style.display = 'none';
            } else {
                scrollRightBtn.style.display = 'flex';
            }
        });
        
        // Initial check
        scrollContainer.dispatchEvent(new Event('scroll'));
    });
</script>
@endsection