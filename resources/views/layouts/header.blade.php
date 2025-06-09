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
                    <a class="nav-link" href="{{ route('events.index') }}">Cari Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                </li>
                @auth
                    <!-- My Event - Tampilkan hanya untuk role 'organizer' -->
                    @if(auth()->user()->role === 'organizer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('organizer.dashboard') }}">My Event</a>
                        </li>
                    @endif

                    <!-- My Admin - Tampilkan hanya untuk role 'admin' -->
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">My Admin</a>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <div class="d-flex align-items-center">
                {{-- <div class="input-group me-3" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Cari event..." style="border-right: none;">
                    <span class="input-group-text bg-white" style="border-left: none;">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                </div> --}}
                
                @auth
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-muted" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/profil-img.jpg') }}"
                                alt="Profile"
                                class="rounded-circle me-2"
                                style="width: 35px; height: 35px; object-fit: cover;">
                            <span class="fw-semibold px-1">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Lihat Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-gradient btn-login me-2">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-gradient btn-signup">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>