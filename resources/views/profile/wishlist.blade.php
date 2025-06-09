@extends('layouts.app')

@section('title', 'Moeket - Wishlist')

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
  <div class="main-container my-4 mb-0">
    <!-- Main Layout -->
    <div class="wrapper-container">
        <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3 sidebar">
            <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.show') }}" id="navProfile">Profile</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.security') }}" id="navKeamanan">Keamanan</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('profile.wishlist') }}" id="navWishlist">Wishlist</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.history') }}" id="navRiwayat">Riwayat Pembelian</a></li>
            </ul>
        </div>

        <!-- Wishlist Content -->
        <div class="col-md-9 ps-md-4">
            <h5 class="fw-bold mb-4">Wishlist</h5>
            <div class="row g-4">
            <!-- Event -->
            <div class="d-flex flex-wrap gap-4 justify-content-left mb-4" id="eventGrid">
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
            </div>
        </div>
        </div>
    </div>
    </div>
  </div>
</div>
@include('profile._style')
@endsection