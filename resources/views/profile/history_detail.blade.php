@extends('layouts.app')

@section('title', 'Moeket - Detail Pembelian')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('profile.history') }}" class="text-decoration-none">Riwayat Pembelian</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pembelian</li>
        </ol>
    </nav>
    
    <div class="main-container my-4 mb-0">
        <div class="wrapper-container">
            <div class="card-custom">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Detail Pembelian</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Informasi Pembayaran</h6>
                            <p class="mb-1"><strong>Status:</strong> 
                                <span class="badge 
                                    @if($transaction->status === 'completed') bg-success
                                    @elseif($transaction->status === 'pending') bg-warning
                                    @elseif($transaction->status === 'failed') bg-danger
                                    @elseif($transaction->status === 'cancelled') bg-secondary
                                    @else bg-info
                                    @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </p>
                            <p class="mb-1"><strong>Total Pembayaran:</strong> Rp {{ $transaction->formatted_total_price }}</p>
                            <p class="mb-1"><strong>Metode Pembayaran:</strong> {{ $payment->method ?? 'Transfer Bank' }}</p>
                            <p class="mb-1"><strong>Tanggal Pembayaran:</strong> {{ $payment->created_at->format('d F Y H:i') ?? '-' }}</p>
                            
                            @if($payment && $payment->proof_image)
                                <div class="mt-3">
                                    <p class="mb-2"><strong>Bukti Pembayaran:</strong></p>
                                    <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank" class="d-block">
                                        <img src="{{ asset('storage/' . $payment->proof_image) }}" 
                                             alt="Bukti Pembayaran"
                                             class="img-fluid border rounded" 
                                             style="max-height: 200px;">
                                    </a>
                                </div>
                            @else
                                <p class="mb-1 mt-3"><strong>Bukti Pembayaran:</strong> Belum tersedia</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h6>Informasi Pesanan</h6>
                            <p class="mb-1"><strong>Nomor Pesanan:</strong> {{ $transaction->order_number }}</p>
                            <p class="mb-1"><strong>Tanggal Pesanan:</strong> {{ $transaction->created_at->format('d F Y H:i') }}</p>
                            <p class="mb-1"><strong>Jumlah Tiket:</strong> {{ $transaction->quantity }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h6 class="mb-3">Detail Event</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $transaction->event->banner_image ? asset('storage/' . $transaction->event->banner_image) : asset('images/no-img1.jpg') }}"
                                class="card-img-top h-100 rounded-3" alt="{{ $transaction->event->title }}" style="object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $transaction->event->title }}</h5>
                            <p class="mb-1"><i class="fas fa-calendar me-2"></i> {{ $transaction->event->start_date->format('d F Y') }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> {{ $transaction->event->location }}</p>
                            <p class="mb-1"><i class="fas fa-info-circle me-2"></i> {{ $transaction->event->category }}</p>
                        </div>
                        <div class="col-md-4">
                            <div class="border p-3 rounded">
                                <p class="mb-2"><strong>Tiket:</strong> {{ $transaction->ticket->name }}</p>
                                <p class="mb-2"><strong>Jumlah:</strong> {{ $transaction->quantity }}</p>
                                <p class="mb-2"><strong>Harga Satuan:</strong> Rp {{ number_format($transaction->ticket->price, 2, ',', '.') }}</p>
                                <hr>
                                <p class="mb-0"><strong>Total:</strong> Rp {{ $transaction->formatted_total_price }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($transaction->notes)
                        <hr>
                        <div class="alert alert-info">
                            <h6>Catatan:</h6>
                            <p class="mb-0">{{ $transaction->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('profile._style')
@endsection