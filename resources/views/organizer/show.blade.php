@extends('layouts.app')

@section('title', 'Moeket - ' . $organizer->name)

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

    <!-- Profile -->
    <div class="profile-container mb-4 d-flex align-items-center">
        <div class="col-md-1 py-3 m-4">
            <img src="{{ $organizer->logo ? asset('storage/' . $organizer->logo) : asset('images/no-img1.jpg') }}"
                    class="img-fluid rounded" alt="{{ $organizer->logo }}" style="width: object-fit: cover;">
        </div>
        <div>
            <h5 class="mb-0">{{ $organizer->name }}</h5>
            <p class="mb-0 text-muted">
                {{ $organizer->contact_email }}<br>
                {{ $organizer->description }}
            </p>
        </div>
    </div>

    <!-- Event Tersedia -->
    @if($availableEvents->count() > 0)
    <h5 class="fw-bold border-bottom border-primary pb-1">Event Tersedia</h5>
    <div class="d-flex flex-wrap gap-2 justify-content-left mb-4">
        @foreach($availableEvents as $event)
            <div class="col-md-3 mb-4">
                @include('organizer.partials.event_card', ['event' => $event])
            </div>
        @endforeach
    </div>
    @endif

    <!-- Event Terpublikasi -->
    @if($publishedEvents->count() > 0)
    <h5 class="fw-bold border-bottom border-primary pb-1">Event Terpublikasi</h5>
    <div class="d-flex flex-wrap gap-2 justify-content-left mb-4">
        @foreach($publishedEvents as $event)
            <div class="col-md-4 mb-4">
                @include('organizer.partials.event_card', ['event' => $event])
            </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .profile-container {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .event-card {
        transition: transform 0.3s ease;
        height: 100%;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .event-card img {
        height: 200px;
        object-fit: cover;
    }

    .border-primary {
        border-color: var(--primary) !important;
    }
</style>
@include('profile._style')
@endsection