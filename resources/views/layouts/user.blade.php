<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }} - User Dashboard</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-nav .nav-link.active {
            font-weight: 600;
            color: #0d6efd !important;
        }

        /* Posisikan menu tengah */
        .navbar-nav.mx-auto {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-relative">
            <div class="container">
                {{-- Logo kiri --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    E-Ticketing
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="userNavbar">
                    {{-- Menu tengah --}}
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Daftar Event</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Tiket Saya</a>
                        </li>
                    </ul>

                    {{-- Profil & Logout dropdown kanan --}}
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    Profil Saya
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
</body>
</html>
