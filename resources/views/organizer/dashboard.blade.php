@extends('layouts.app')

@section('title', 'Dashboard Organizer')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Dashboard Organizer</h2>

    <div class="row mb-4">
        <!-- Total Event -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Event</h5>
                    <p class="display-5">{{ $totalEvents }}</p>
                </div>
            </div>
        </div>

        <!-- Total Tiket -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Tiket</h5>
                    <p class="display-5">{{ $totalTickets }}</p>
                </div>
            </div>
        </div>

        <!-- Tiket Terjual -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Tiket Terjual</h5>
                    <p class="display-5">{{ $ticketsSold }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Event Saya</h4>
        <a href="{{ route('events.create') }}" class="btn btn-gradient">+ Buat Event Baru</a>
    </div>

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm rounded-4">
                    <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/default-banner.jpg') }}" 
                         class="card-img-top" 
                         style="height: 180px; object-fit: cover;"
                         alt="Banner {{ $event->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="text-muted small mb-1"><i class="bi bi-geo-alt"></i> {{ $event->location }}</p>
                        <p class="small mb-2"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }}</p>
                        <span class="badge bg-{{ $event->is_published ? 'success' : 'secondary' }}">
                            {{ $event->is_published ? 'Published' : 'Draft' }}
                        </span>
                        <a href="{{ route('events.edit', $event->id) }}" class="mt-auto btn btn-outline-primary btn-sm mt-3">Kelola</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada event.</p>
        @endforelse
    </div>
</div>
@endsection
