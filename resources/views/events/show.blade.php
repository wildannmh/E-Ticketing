@extends('layouts.app')

@section('title', 'Moeket - ' . $event->title)

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

    <div class="row">
        <!-- Left Column - Event Details -->
        <div class="col-lg-8">
            <!-- Event Banner -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/no-img1.jpg') }}"
                     class="card-img-top h-100 rounded-3" alt="{{ $event->title }}" style="object-fit: cover;">
            </div>

            <!-- Event Description -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi Acara</h5>
                    <p class="card-text mb-3">
                        {!! nl2br(e($event->description)) !!}
                    </p>
                </div>
            </div>

            <!-- Location -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Lokasi</h5>
                    <div class="row">
                        <div class="col-12">
                            <div style="height: 300px; background-color: #e9ecef; border-radius: 8px; position: relative; text-align: center;">
                                @if(!empty($event->location_link))
                                    @if(Str::contains($event->location_link, 'embed'))
                                        {{-- Tampilkan iframe jika link embed --}}
                                        <iframe 
                                            src="{{ $event->location_link }}" 
                                            width="100%" 
                                            height="300" 
                                            style="border:0; border-radius: 8px;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    @else
                                        {{-- Lokasi Link Gmaps --}}
                                        <div style="height: 300px; background-color: #e9ecef; border-radius: 8px; position: relative; overflow: hidden;">
                                            {{-- Overlay menutupi seluruh map --}}
                                            <div style="
                                                position: absolute;
                                                top: 0;
                                                left: 0;
                                                width: 100%;
                                                height: 100%;
                                                background-color: rgba(0, 0, 0, 0.6);
                                                color: white;
                                                z-index: 2;
                                                display: flex;
                                                flex-direction: column;
                                                align-items: center;
                                                justify-content: center;
                                                text-align: center;
                                                padding: 20px;
                                                border-radius: 8px;
                                                    ">
                                                <p style="font-size: 1.1rem; font-style: italic; margin-bottom: 15px;">
                                                    Link map tidak mendukung, buka di Google Maps
                                                </p>
                                                @if(!empty($event->location_link))
                                                    <a href="{{ $event->location_link }}" target="_blank" class="btn btn-outline-light">
                                                        Lihat Lokasi di Google Maps
                                                    </a>
                                                @endif
                                            </div>

                                            {{-- Iframe Google Maps --}}
                                            <iframe 
                                                src="https://www.google.com/maps/embed?..." 
                                                width="100%" 
                                                height="300" 
                                                style="border:0; border-radius: 8px;" 
                                                allowfullscreen="" 
                                                loading="lazy">
                                            </iframe>
                                        </div>
                                    @endif
                                @else
                                    {{-- Lokasi default jika kosong --}}
                                    <div style="height: 300px; background-color: #e9ecef; border-radius: 8px; position: relative; overflow: hidden;">
                                        {{-- Overlay teks di atas peta --}}
                                        <div style="
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            background-color: rgba(0, 0, 0, 0.5); /* semi transparan */
                                            z-index: 2;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            color: white;
                                            font-size: 1.2rem;
                                            font-style: italic;
                                            border-radius: 8px;
                                            ">
                                            Lokasi belum di set
                                        </div>

                                        {{-- Iframe Google Maps --}}
                                        <iframe 
                                            src="https://www.google.com/maps/embed?..." 
                                            width="100%" 
                                            height="300" 
                                            style="border:0; border-radius: 8px;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Policies -->
            @if($event->policies)
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Kebijakan Acara</h5>
                    <ol>
                        @foreach(explode("\n", $event->policies) as $policy)
                            @if(trim($policy))
                                <li class="mb-3">
                                    {!! nl2br(e(trim($policy))) !!}
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
            @endif

            <!-- Event Organizer -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Tentang Penyelenggara</h5>
                    <div class="row align-items-center mb-3">
                        <div class="col-md-2 py-3">
                            <img src="{{ $event->organizer->logo ? asset('storage/' . $event->organizer->logo) : asset('images/no-img1.jpg') }}"
                                 class="img-fluid rounded" alt="{{ $event->organizer->name }}" style="width: object-fit: cover;">
                        </div>
                        <div class="col-md-10">
                            <h6 class="mb-1">{{ $event->organizer->name }}</h6>
                            <p class="text-muted mb-2">{{ $event->organizer->description }}</p>
                            <p class="text-muted mb-3">{{ $event->organizer->address }}</p>
                            <div class="d-flex gap-2">
                                <a href="mailto:{{ $event->organizer->contact_email }}" class="btn btn-gradient btn-sm">Hubungi Penyelenggara</a>
                                <a href="{{ route('organizers.show', $event->organizer->id) }}" class="btn btn-outline-gradient btn-sm">Lihat Penyelenggara</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Ticket Booking -->
        <div class="col-lg-4">
            <div class="card sticky-top mb-4 w-100 h-auto rounded-3" style="top: 100px;">
                <div class="card-body">
                    <div class="mb-2">
                        <span class="small card-category">{{ $event->category }}</span>
                    </div>
                    <h4 class="card-title">{{ $event->title }}</h4>
                    
                    <!-- Event Details -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar text-muted me-2"></i>
                            <span>{{ $event->start_date->format('j F Y') }}</span>
                        </div>
                    </div>

                    <!-- Ticket Selection -->
                    <div class="mb-3">
                        @if($event->tickets->count() > 0)
                            @php
                                $cheapestTicket = $event->tickets->sortBy('price')->first();
                                $remainingTickets = $cheapestTicket->remaining ?? $cheapestTicket->quantity;
                            @endphp
                            
                            <div class="border rounded p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <div class="fw-bold">Rp {{ number_format($cheapestTicket->price, 0, ',', '.') }},-</div>
                                        <small class="text-muted">{{ $remainingTickets }} Tiket tersedia</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity()">-</button>
                                        <input type="number" id="quantity" class="form-control mx-2 text-center" value="1" min="1" max="{{ $remainingTickets }}" style="width: 60px;">
                                        <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity()">+</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">Tiket belum tersedia</div>
                        @endif
                    </div>

                    <!-- Total -->
                    @if($event->tickets->count() > 0)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Total</span>
                            <span class="fw-bold">Rp <span id="total">{{ number_format($cheapestTicket->price, 0, ',', '.') }}</span>,-</span>
                        </div>
                        <small class="text-muted">1 Tiket</small>
                    </div>

                    <!-- Book Button -->
                    <form id="checkout-form" method="GET" action="{{ route('ticketing.checkout', ['event' => $event->id, 'ticket' => $cheapestTicket->id]) }}">
                        <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                        <button type="submit" class="btn btn-gradient w-100 mb-3">Pesan Tiket</button>
                    </form>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container-fluid {
        padding: 0 50px;
        padding-top: 80px;
        background: var(--bg-default);
    }

    .sticky-top {
        z-index: 1020;
    }

    .card-category {
        background: linear-gradient(135deg, var(--gradient-start) 30%, var(--gradient-end) 100%);
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        display: inline-block;
        margin-bottom: 2px;
    }

    .card-img-top {
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    @media (max-width: 991.98px) {
        .sticky-top {
            position: relative !important;
            top: auto !important;
        }
    }
</style>

<script>
    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const max = parseInt(quantityInput.getAttribute('max'));
        const currentValue = parseInt(quantityInput.value);
        
        if (currentValue < max) {
            quantityInput.value = currentValue + 1;
            updateTotal();
        }
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            updateTotal();
        }
    }

    function updateTotal() {
        const quantity = parseInt(document.getElementById('quantity').value);
        const pricePerTicket = {{ $event->tickets->count() > 0 ? $cheapestTicket->price : 0 }};
        const total = quantity * pricePerTicket;
        document.getElementById('total').textContent = total.toLocaleString('id-ID');
        document.getElementById('quantity-hidden').value = quantity;
    }

    // Update total when quantity input changes
    document.getElementById('quantity').addEventListener('input', function() {
        const max = parseInt(this.getAttribute('max'));
        const value = parseInt(this.value);
        
        if (this.value === '' || isNaN(value) || value < 1) {
            this.value = 1;
        } else if (value > max) {
            this.value = max;
        }
        
        updateTotal();
    });
</script>

@endsection