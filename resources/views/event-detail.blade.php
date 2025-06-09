@extends('layouts.app')

@section('title', 'Moeket - Detail Event')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="fas fa-home me-1"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="" class="text-decoration-none">Cari Event</a></li>
            <li class="breadcrumb-item active" aria-current="page">Atrium EastCoast</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Left Column - Event Details -->
        <div class="col-lg-8">
            <!-- Event Banner -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <img src="images/welcome/cat.jpg" class="card-img-top h-100 rounded-3" alt="Atrium Eastcoast 2025" style="object-fit: cover;">
            </div>

            <!-- Event Description -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi Acara</h5>
                    <p class="card-text mb-3">
                        Atrium East Coast Center (Pakuwon City Mall) menjadi pusat berbagai acara menarik yang siap 
                        menghibur pengunjung, mulai dari pertunjukan spektakuler Laser Harp Show & Mirrors Girl, pesta 
                        kembang api setiap akhir pekan, hingga Pasar Malam Tjap Toedjoengan yang menghadirkan suasana 
                        tempo dulu lengkap dengan kuliner khas Surabaya. Tak hanya hiburan, tersedia juga Health Care Expo 
                        oleh Jawa Pos yang menyajikan talk show kesehatan bersama dokter spesialis. Dengan rangkaian 
                        acara ini, Atrium East Coast menjadi destinasi ideal untuk rekreasi, hiburan, dan edukasi keluarga di 
                        Surabaya Timur.
                    </p>
                </div>
            </div>

            <!-- Location -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Lokasi</h5>
                    <div class="row">
                        <div class="col-12">
                            <!-- Map placeholder - you can integrate with Google Maps -->
                            <div style="height: 300px; background-color: #e9ecef; border-radius: 8px; position: relative;">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.234!2d112.7694!3d-7.3164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb91b2b5b9b1%3A0x1234567890abcdef!2sPakuwon%20City%20Mall!5e0!3m2!1sen!2sid!4v1635000000000!5m2!1sen!2sid" 
                                    width="100%" 
                                    height="300" 
                                    style="border:0; border-radius: 8px;" 
                                    allowfullscreen="" 
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Policies -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Kebijakan Acara</h5>
                    <ol>
                        <li class="mb-3">
                            <strong>Keamanan Pengunjung</strong><br>
                            Demi kenyamanan bersama, seluruh pengunjung wajib menjjalani pemeriksaan barang bawaan. 
                            Dilarang membawa senjata tajam, obat terlarang, atau makanan dan minuman dari luar.
                        </li>
                        <li class="mb-3">
                            <strong>Dokumentasi Acara</strong><br>
                            Penyelenggara berhak mengambil foto dan video selama acara untuk keperluan promosi. Dengan 
                            menghadiri acara, pengunjung dianggap menyetujui penggunaan dokumentasi tanpa kompensasi.
                        </li>
                        <li class="mb-3">
                            <strong>Perubahan Jadwal</strong><br>
                            Penyelenggara dapat mengubah jadwal atau membatalkan acara sewaktu-waktu karena alasan 
                            tertentu. Informasi terbaru akan diumumkan melalui media sosial resmi dan situs web.
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Event Organizer -->
            <div class="card mb-4 w-100 h-auto rounded-3">
                <div class="card-body">
                    <h5 class="card-title">Tentang Penyelenggara</h5>
                    <div class="row align-items-center mb-3">
                        <div class="col-md-2 py-3">
                            <img src="{{ asset('images/welcome/cat.jpg') }}" class="img-fluid rounded" alt="Larasati" style="object-fit: cover;">
                        </div>
                        <div class="col-md-10">
                            <h6 class="mb-1">Larasati</h6>
                            <p class="text-muted mb-2">Kreatif, profesional, terpercaya, inovatif, berkesan.</p>
                            <p class="text-muted mb-3">Jl. Melati Indah No. 12, Surabaya, Jawa Timur 60123</p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-gradient btn-sm">Hubungi Penyelenggara</button>
                                <button class="btn btn-outline-gradient btn-sm">Lihat Penyelenggara</button>
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
                        <span class="small card-category">Expo</span>
                    </div>
                    <h4 class="card-title">Atrium Eastcoast 2025</h4>
                    
                    <!-- Event Details -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                            <span>Pakuwon City Mall, Surabaya</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar text-muted me-2"></i>
                            <span>2 Juli 2025</span>
                        </div>
                    </div>

                    <!-- Ticket Selection -->
                    <div class="mb-3">
                        <div class="border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <div class="fw-bold">Rp 35.000,-</div>
                                    <small class="text-muted">130 Tiket</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity()">-</button>
                                    <input type="number" id="quantity" class="form-control mx-2 text-center" value="1" min="1" style="width: 60px;">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Total</span>
                            <span class="fw-bold">Rp <span id="total">35.000</span>,-</span>
                        </div>
                        <small class="text-muted">1 Tiket</small>
                    </div>

                    <!-- Book Button -->
                    <button class="btn btn-gradient w-100 mb-3" onclick="bookTicket()">Pesan Tiket</button>
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
        margin-bottom: 2px;
    }

    .card-img-top {
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
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
        const currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        updateTotal();
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
        const pricePerTicket = 35000;
        const total = quantity * pricePerTicket;
        document.getElementById('total').textContent = total.toLocaleString('id-ID');
    }

    function bookTicket() {
        const quantity = document.getElementById('quantity').value;
        // Add your booking logic here
        alert(`Memesan ${quantity} tiket untuk Atrium Eastcoast 2025`);
    }

    // Update total when quantity input changes
    document.getElementById('quantity').addEventListener('input', updateTotal);
</script>

@endsection