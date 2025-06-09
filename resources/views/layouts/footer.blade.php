<footer class="border-top pt-5" style="background: var(--bg-default);">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="gradient-icon me-2"></div>
                    <span class="brand-name hover-effect">moeket</span>
                </a>
                <p class="text-muted small">
                    Platform pemesanan tiket event terbesar di Indonesia. Temukan event impianmu dengan mudah!
                </p>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">Menu</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-muted text-decoration-none small link-hover">Home</a></li>
                    <li><a href="{{ route('events.index') }}" class="text-muted text-decoration-none small link-hover">Cari Event</a></li>
                    <li><a href="{{ url('/tentang-kami') }}" class="text-muted text-decoration-none small link-hover">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">Bantuan</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted text-decoration-none small link-hover">FAQ</a></li>
                    <li><a href="#" class="text-muted text-decoration-none small link-hover">Kontak</a></li>
                    <li><a href="#" class="text-muted text-decoration-none small link-hover">Kebijakan</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                <div class="d-flex">
                    <a href="#" class="text-muted me-3 social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-muted me-3 social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-muted me-3 social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-muted small mb-0">&copy; {{ date('Y') }} Moeket. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <small class="text-muted love-hover">Made with ❤️ in Indonesia</small>
            </div>
        </div>
    </div>
</footer>