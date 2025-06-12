@extends('layouts.app')

@section('title', 'Pembayaran - ' . $transaction->event->title)

@section('content')
<div class="container-fluid pb-4">
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

    <h3 class="fw-bold mb-4">Pembelian Tiket</h3>

    <!-- Progress -->
    <div class="progress my-4">
        <div class="progress-bar bg-primary" style="width: 66%;"></div>
        <div class="progress-bar bg-primary-subtle" style="width: 34%;"></div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4 w-100 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Selesaikan Pembayaran</h5>

                    <div class="alert alert-warning mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-clock me-2"></i>
                                Selesaikan pembayaran sebelum:
                            </div>
                            <div id="payment-countdown" class="fw-bold"></div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6>Detail Pesanan</h6>
                        <p class="mb-1"><strong>Nomor Pesanan:</strong> {{ $transaction->order_number }}</p>
                        <p class="mb-1"><strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('ticketing.process-payment', $transaction) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Bank Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Bank Tujuan:</label>
                            
                            @foreach(\App\Models\BankAccount::active()->get() as $bank)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="bank_account_id" 
                                        id="bank{{ $bank->id }}" value="{{ $bank->id }}" required
                                        @if(old('bank_account_id') == $bank->id) checked @endif>
                                    <label class="form-check-label d-flex align-items-center" for="bank{{ $bank->id }}">
                                        <img src="{{ asset('images/banks/' . Str::slug($bank->bank_name) . '.png') }}" 
                                            alt="{{ $bank->bank_name }}" class="bank-logo me-2" width="40">
                                        <div>
                                            <strong>Bank {{ $bank->bank_name }}</strong><br>
                                            {{ $bank->account_number }} a.n {{ $bank->account_name }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                            
                            @error('bank_account_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- File Upload -->
                        <div class="mb-4">
                            <label for="proof_image" class="form-label fw-bold">Upload Bukti Transfer:</label>
                            <input type="file" class="form-control @error('proof_image') is-invalid @enderror" 
                                id="proof_image" name="proof_image" accept="image/jpeg,image/png" required>
                            <div class="file-upload-preview mt-2 d-none">
                                <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                            @error('proof_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPEG, PNG (Maks. 2MB)</small>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Order Summary (unchanged) -->
        <div class="col-md-4">
            <div class="card shadow-sm w-100">
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

<style>
    .container-fluid {
        padding: 0 50px;
        padding-top: 80px;
        background: var(--bg-default);
    }
    
    .bank-logo {
        border-radius: 4px;
        object-fit: contain;
    }
    
    .file-upload-preview {
        transition: all 0.3s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Countdown timer
        function updateCountdown() {
            const paymentDeadline = new Date('{{ $transaction->created_at->addMinutes(15)->toIso8601String() }}').getTime();
            const now = new Date().getTime();
            const distance = paymentDeadline - now;

            if (distance < 0) {
                document.getElementById('payment-countdown').innerHTML = "Waktu pembayaran telah habis!";
                document.querySelector('form button[type="submit"]').disabled = true;
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('payment-countdown').innerHTML = 
                `${minutes} menit ${seconds} detik`;
        }

        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);

        // Image preview
        document.getElementById('proof_image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview-image');
            const previewContainer = document.querySelector('.file-upload-preview');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection