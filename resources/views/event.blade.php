@extends('layouts.app')

@section('title', 'Moeket - Event')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cari Event</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h2 class="mt-4 mb-3 fw-bold">Cari Event</h2>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="position-relative">
                <input type="text" class="form-control form-control-lg rounded-4 ps-5" 
                       placeholder="Ketik nama event ..." id="searchEvent">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select form-select-lg rounded-4" id="categoryFilter">
                <option value="">Semua Kategori</option>
                <option value="volunteer">Volunteer</option>
                <option value="festival">Festival</option>
                <option value="expo">Expo</option>
                <option value="workshop">Workshop</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-gradient btn-lg rounded-4 w-100" id="resetBtn" style="border: 0;">
                <i class="fas fa-redo me-2"></i>Reset
            </button>
        </div>
    </div>
    
    <!-- Event Cards Grid -->
    <div class="d-flex flex-wrap gap-3 justify-content-center mb-4" id="eventGrid">
        <!-- Event Card 1 -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden event-card" data-category="volunteer" data-title="bersama mengajar">
            <div class="position-relative h-100">
                <img src="images/welcome/ryo-img.jpg" alt="Bersama Mengajar" class="w-100 h-100 object-fit-cover">
                <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                    <span class="small card-category">Volunteer</span>
                    <h5 class="card-title mb-1">Bersama Mengajar</h5>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Sariwangi Permasalahan</p>
                    <p class="small mb-1"><i class="fas fa-calendar me-1"></i>3 Juli 2024</p>
                    <p class="small mb-2"><i class="fas fa-tag me-1"></i>Rp 50.000</p>
                    <div class="card-actions">
                        <button class="btn-favorite" onclick="toggleFavorite(this)">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="btn btn-detail" onclick="showDetail()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Card 2 -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden event-card" data-category="festival" data-title="smansa fair">
            <div class="position-relative h-100">
                <img src="images/welcome/ryo-img.jpg" alt="Smansa Fair" class="w-100 h-100 object-fit-cover">
                <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                    <span class="small card-category">Festival</span>
                    <h5 class="card-title mb-1">Smansa Fair</h5>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Gor Satria Purwokerto</p>
                    <p class="small mb-1"><i class="fas fa-calendar me-1"></i>18 Agustus 2025</p>
                    <p class="small mb-2"><i class="fas fa-tag me-1"></i>Rp 80.000</p>
                    <div class="card-actions">
                        <button class="btn-favorite" onclick="toggleFavorite(this)">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="btn btn-detail" onclick="showDetail()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Card 3 -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden event-card" data-category="expo" data-title="atrium eastcoast">
            <div class="position-relative h-100">
                <img src="images/welcome/ryo-img.jpg" alt="Atrium Eastcoast" class="w-100 h-100 object-fit-cover">
                <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                    <span class="small card-category">Expo</span>
                    <h5 class="card-title mb-1">Atrium Eastcoast</h5>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Pakuwon City Mal Surabaya</p>
                    <p class="small mb-1"><i class="fas fa-calendar me-1"></i>2 Juli 2025</p>
                    <p class="small mb-2"><i class="fas fa-tag me-1"></i>Rp 80.000</p>
                    <div class="card-actions">
                        <button class="btn-favorite" onclick="toggleFavorite(this)">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="btn btn-detail" onclick="showDetail()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Card 4 -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden event-card" data-category="expo" data-title="batik expo">
            <div class="position-relative h-100">
                <img src="images/welcome/ryo-img.jpg" alt="Batik Expo" class="w-100 h-100 object-fit-cover">
                <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                    <span class="small card-category">Expo</span>
                    <h5 class="card-title mb-1">Batik Expo</h5>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Gor Satria Purwokerto</p>
                    <p class="small mb-1"><i class="fas fa-calendar me-1"></i>25 Juli 2025</p>
                    <p class="small mb-2"><i class="fas fa-tag me-1"></i>Rp 80.000</p>
                    <div class="card-actions">
                        <button class="btn-favorite" onclick="toggleFavorite(this)">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="btn btn-detail" onclick="showDetail()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Card 5 -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden event-card" data-category="workshop" data-title="workshop digital">
            <div class="position-relative h-100">
                <img src="images/welcome/ryo-img.jpg" alt="Workshop Digital" class="w-100 h-100 object-fit-cover">
                <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                    <span class="small card-category">Workshop</span>
                    <h5 class="card-title mb-1">Workshop Digital</h5>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Gedung Serbaguna</p>
                    <p class="small mb-1"><i class="fas fa-calendar me-1"></i>15 Juli 2025</p>
                    <p class="small mb-2"><i class="fas fa-tag me-1"></i>Rp 100.000</p>
                    <div class="card-actions">
                        <button class="btn-favorite" onclick="toggleFavorite(this)">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="btn btn-detail" onclick="showDetail()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="text-center mt-4" style="display: none;">
        <div class="alert alert-info">
            <i class="fas fa-search me-2"></i>
            Tidak ada event yang ditemukan sesuai kriteria pencarian.
        </div>
    </div>
</div>

<style>
    .container-fluid {
        padding: 0 50px;
        padding-top: 80px;
        padding-bottom: 1px;
        background: #F1F7FE;
    }

    .card {
        width: 20rem;
        height: 28rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
    
    .position-absolute.bottom-3 {
        bottom: 1rem;
    }
    
    .position-absolute.top-3 {
        top: 1rem;
    }
    
    .position-absolute.start-3 {
        left: 1rem;
    }

    /* Event grid centered layout */
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchEvent');
    const categoryFilter = document.getElementById('categoryFilter');
    const resetBtn = document.getElementById('resetBtn');
    const eventGrid = document.getElementById('eventGrid');
    const noResults = document.getElementById('noResults');
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        filterEvents();
    });
    
    // Category filter functionality
    categoryFilter.addEventListener('change', function() {
        filterEvents();
    });
    
    // Reset functionality
    resetBtn.addEventListener('click', function() {
        searchInput.value = '';
        categoryFilter.value = '';
        filterEvents();
    });
    
    function filterEvents() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categoryFilter.value.toLowerCase();
        const eventCards = eventGrid.querySelectorAll('.event-card');
        let visibleCount = 0;
        
        eventCards.forEach(function(card) {
            const eventTitle = card.getAttribute('data-title');
            const eventCategory = card.getAttribute('data-category');
            
            const matchesSearch = !searchTerm || eventTitle.includes(searchTerm);
            const matchesCategory = !selectedCategory || eventCategory === selectedCategory;
            
            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }
});
</script>
@endsection