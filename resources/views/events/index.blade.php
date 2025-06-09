@extends('layouts.app')

@section('title', 'Moeket - Event')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $item)
                @if(isset($item['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}" class="text-decoration-none">
                            @if($loop->first)<i class="fas fa-home me-1"></i>@endif
                            {{ $item['text'] }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $item['text'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>

    <!-- Page Title -->
    <h2 class="mt-4 mb-3 fw-bold">Cari Event</h2>

    <!-- Search and Filter Section -->
    <form method="GET" action="{{ route('events.index') }}">
        <div class="row mb-4">
            <div class="col-md-5 mb-2">
                <div class="position-relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="form-control form-control-lg rounded-4 ps-5" 
                        placeholder="Ketik nama event ...">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <select class="form-select form-select-lg rounded-4" name="category">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-gradient btn-lg rounded-4 w-100" type="submit" style="border: 0;">
                    <i class="fas fa-search me-2"></i>Cari
                </button>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-gradient btn-lg rounded-4 w-100" id="resetBtn" style="border: 0;">
                    <i class="fas fa-redo me-2"></i>Reset
                </button>
            </div>
        </div>
    </form>

    
    <!-- Event Cards Grid -->
    <div class="d-flex flex-wrap gap-4 justify-content-center mb-4" id="eventGrid">
        @forelse($events as $event)
            @php
                $cheapestTicket = $event->tickets->sortBy('price')->first();
                $price = $cheapestTicket ? 'Rp ' . number_format($cheapestTicket->price, 0, ',', '.') : 'Gratis';
            @endphp
            
            <div class="card card-hover shadow-sm border-0 rounded-4 overflow-hidden event-card" 
                 data-category="{{ strtolower($event->category) }}" 
                 data-title="{{ strtolower($event->title) }}">
                <div class="position-relative h-100">
                    <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/no-img.jpg') }}"
                         alt="{{ $event->title }}" 
                         class="w-100 h-100 object-fit-cover">
                    <div class="overlay position-absolute bottom-0 start-0 w-100 text-white">
                        <span class="small card-category">{{ $event->category }}</span>
                        <h5 class="card-title mb-1">{{ $event->title }}</h5>
                        <p class="small mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</p>
                        <p class="small mb-1"><i class="fas fa-calendar me-1"></i>{{ $event->start_date->format('j F Y') }}</p>
                        <p class="small mb-2"><i class="fas fa-tag me-1"></i>{{ $price }}</p>
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

    <!-- No Results Message -->
    <div id="noResults" class="text-center mt-4" style="display: none;">
        <div class="alert alert-info">
            <i class="fas fa-search me-2"></i>
            Tidak ada event yang ditemukan.
        </div>
    </div>
</div>

<div class="d-flex flex-column align-items-center pt-4" style="background: var(--bg-default);">
    {{ $events->withQueryString()->links() }}

    <small class="text-muted mb-4">
        Showing {{ $events->count() }} of {{ $events->total() }} events
    </small>
</div>


<style>
    .container-fluid {
        padding: 0 50px;
        padding-top: 80px;
        padding-bottom: 1px;
        background: var(--bg-default);
    }

    .card {
        width: 20rem;
        height: 28rem;
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