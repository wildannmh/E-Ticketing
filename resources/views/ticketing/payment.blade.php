@extends('layouts.app')

@section('title', 'Pembayaran - ' . $transaction->event->title)

@section('content')
<div class="container">
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
        <div class="progress-bar bg-primary" style="width: 66%;"></div>
        <div class="progress-bar bg-primary-subtle" style="width: 34%;"></div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Selesaikan Pembayaran</h5>
                    
                    <div class="alert alert-info">
                        <h6>Detail Pesanan</h6>
                        <p class="mb-1"><strong>Nomor Pesanan:</strong> {{ $transaction->order_number }}</p>
                        <p class="mb-1"><strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('ticketing.process-payment', $transaction) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kirim pembayaran ke:</label>
                            
                            @foreach($banks as $bank)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="bank_name" 
                                           id="bank{{ $loop->index }}" value="{{ $bank['name'] }}" 
                                           data-account-number="{{ $bank['account_number'] }}"
                                           data-account-name="{{ $bank['account_name'] }}"
                                           required>
                                    <label class="form-check-label d-flex align-items-center" for="bank{{ $loop->index }}">
                                        <img src="{{ asset('images/banks/' . strtolower($bank['name']) . '.png') }}" 
                                             alt="{{ $bank['name'] }}" class="bank-logo me-2" width="40">
                                        <div>
                                            <strong>Bank {{ $bank['name'] }}</strong><br>
                                            {{ $bank['account_number'] }} a.n {{ $bank['account_name'] }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                            
                            <input type="hidden" id="account_number" name="account_number">
                            <input type="hidden" id="account_name" name="account_name">
                        </div>
                        
                        <div class="mb-4">
                            <label for="proof_image" class="form-label fw-bold">Upload bukti pembayaran:</label>
                            <input type="file" class="form-control" id="proof_image" name="proof_image" required>
                            <small class="text-muted">Format: JPEG, PNG (Maks. 2MB)</small>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Ringkasan Pesanan</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Event:</span>
                        <span class="fw-bold">{{ $transaction->event->title }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tiket:</span>
                        <span class="fw-bold">{{ $transaction->ticket->name }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga Satuan:</span>
                        <span class="fw-bold">Rp {{ number_format($transaction->ticket->price, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah Tiket:</span>
                        <span class="fw-bold">{{ $transaction->quantity }}</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bankRadios = document.querySelectorAll('input[name="bank_name"]');
        const accountNumberInput = document.getElementById('account_number');
        const accountNameInput = document.getElementById('account_name');
        
        bankRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    accountNumberInput.value = this.dataset.accountNumber;
                    accountNameInput.value = this.dataset.accountName;
                }
            });
        });
    });
</script>
@endsection