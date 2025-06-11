@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

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
        <div class="progress-bar bg-primary" style="width: 33%;"></div>
        <div class="progress-bar bg-primary-subtle" style="width: 67%;"></div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4 w-100 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Data Diri</h5>
                    
                    <form method="POST" action="{{ route('ticketing.process', [$event, $ticket]) }}">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="full_name" class="form-label">Nama Lengkap*</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" 
                                       value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender*</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option selected disabled>Pilih opsi</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">No Telepon*</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label">Tanggal Lahir*</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Jumlah Tiket (Tersedia: {{ $ticket->remaining }})</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" 
                                       min="1" max="{{ $ticket->remaining }}" value="1" required>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>
                    </form>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger mx-3">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="col-md-4 pb-3">
            <div class="card shadow-sm w-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Ringkasan Pesanan</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Event:</span>
                        <span class="fw-bold">{{ $event->title }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tiket:</span>
                        <span class="fw-bold">{{ $ticket->name }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga Satuan:</span>
                        <span class="fw-bold">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah Tiket:</span>
                        <span class="fw-bold" id="summaryQuantity">1</span>
                    </div>
                    
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span id="summaryTotal">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const summaryQuantity = document.getElementById('summaryQuantity');
        const summaryTotal = document.getElementById('summaryTotal');
        const ticketPrice = {{ $ticket->price }};
        
        quantityInput.addEventListener('input', function() {
            const quantity = parseInt(this.value) || 1;
            summaryQuantity.textContent = quantity;
            summaryTotal.textContent = 'Rp ' + (quantity * ticketPrice).toLocaleString('id-ID');
        });
    });
</script>
@endsection