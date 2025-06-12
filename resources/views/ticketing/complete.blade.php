@extends('layouts.app')

@section('title', 'Pesanan Selesai - ' . $transaction->event->title)

@section('content')
<div class="container-fluid pb-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mt-4">
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

    <h3 class="fw-bold mb-4">Pembelian Tiket</h3>

    <!-- Progress -->
    <div class="progress my-4">
        <div class="progress-bar bg-primary" style="width: 100%;"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm text-center mb-4 w-100 h-100">
                <div class="card-body py-5">
                    <div class="checkmark mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 60px;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Pesanan Selesai</h4>
                    <p class="mb-4">
                        Pesanan Anda dengan nomor <strong>{{ $transaction->order_number }}</strong> telah berhasil dibuat.<br>
                        Tunggu e-ticket Anda di inbox email <strong>{{ $transaction->email }}</strong>.
                    </p>
                    
                    <div class="alert alert-info text-start">
                        <h6 class="fw-bold">Detail Pesanan:</h6>
                        <p class="mb-1"><strong>Event:</strong> {{ $transaction->event->title }}</p>
                        <p class="mb-1"><strong>Tiket:</strong> {{ $transaction->ticket->name }} ({{ $transaction->quantity }}x)</p>
                        <p class="mb-1"><strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                        <p class="mb-0"><strong>Status:</strong> {!! $transaction->status_badge !!}</p>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('events.show', $transaction->event) }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar me-2"></i>Lihat Event
                        </a>
                        <a href="{{ route('profile.history') }}" class="btn btn-primary">
                            <i class="fas fa-history me-2"></i>Riwayat Pembelian
                        </a>
                    </div>
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
</style>
@endsection