<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <div class="gradient-icon me-2"></div>
            <span class="brand-name">moeket</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/event') }}">Cari Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center">
                <div class="input-group me-3" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Cari event..." style="border-right: none;">
                    <span class="input-group-text bg-white" style="border-left: none;">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                </div>
                
                <a href="{{ url('/login') }}" class="btn btn-outline-gradient btn-login me-2">Log In</a>
                <a href="{{ url('/register') }}" class="btn btn-gradient btn-signup">Sign Up</a>
            </div>
        </div>
    </div>
</nav>