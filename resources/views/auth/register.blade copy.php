<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            height: 100vh;
        }

        .full-height {
            height: 100vh;
        }

        /* Animasi untuk efek floating */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s infinite ease-in-out;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
            animation-duration: 4s;
        }

        .floating-element:nth-child(2) {
            top: 40%;
            left: 70%;
            animation-delay: 1s;
            animation-duration: 5s;
        }

        .floating-element:nth-child(3) {
            top: 70%;
            left: 30%;
            animation-delay: 2s;
            animation-duration: 6s;
        }

        .floating-element:nth-child(4) {
            top: 80%;
            left: 80%;
            animation-delay: 3s;
            animation-duration: 4.5s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) scale(1);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20px) scale(1.2);
                opacity: 0.8;
            }
        }

        /* Hover effects */
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.3);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }

        /* Custom scrollbar for form */
        .form-container::-webkit-scrollbar {
            width: 6px;
        }

        .form-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .form-container::-webkit-scrollbar-thumb {
            background: #764ba2;
            border-radius: 10px;
        }

        .image-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .form-section {
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .image-section {
                display: none !important;
            }
            
            .form-section {
                width: 100% !important;
            }
            
            body {
                background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
            }
        }

        @media (min-width: 769px) {
            .row {
                height: 100vh;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 full-height">
        <div class="row g-0 full-height">
            <!-- Gambar bagian kiri - Full height -->
            <div class="col-md-6 image-section d-flex align-items-center justify-content-center">
                <!-- Background image -->
                <div class="position-absolute w-100 h-100" 
                     style="background-image: url('{{ asset('images/register-image.jpg') }}'); 
                            background-size: cover; 
                            background-position: center;
                            opacity: 0.9;">
                </div>

                <!-- Overlay untuk efek gelap -->
                <div class="position-absolute w-100 h-100" 
                     style="background: linear-gradient(45deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));">
                </div>

                <!-- Konten di atas gambar -->
                <div class="position-relative text-center text-white p-4">
                    <div class="mb-4">
                        <!-- Icon untuk registrasi -->
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 200px; height: 200px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                            <i class="fas fa-user-plus" style="font-size: 4rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                    
                    <h1 class="fw-bold mb-4 display-5">Bergabunglah dengan Kami!</h1>
                    <p class="fs-5 mb-0" style="opacity: 0.9;">Mulai perjalanan Anda bersama platform terbaik</p>
                    
                    <!-- Efek floating elements -->
                    <div class="floating-elements">
                        <div class="floating-element"></div>
                        <div class="floating-element"></div>
                        <div class="floating-element"></div>
                        <div class="floating-element"></div>
                    </div>
                </div>
            </div>

            <!-- Form bagian kanan - Full height -->
            <div class="col-md-6 form-section">
                <div class="w-100" style="max-width: 500px;">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-2" style="color: #2c3e50;">Create Account</h2>
                        <p class="text-muted">Isi informasi di bawah untuk membuat akun</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium" style="color: #2c3e50;">{{ __('Name') }}</label>
                            <input id="name" type="text" 
                                class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 16px;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium" style="color: #2c3e50;">{{ __('Email Address') }}</label>
                            <input id="email" type="email" 
                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 16px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium" style="color: #2c3e50;">{{ __('Password') }}</label>
                            <input id="password" type="password" 
                                class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="new-password"
                                style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 16px;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label fw-medium" style="color: #2c3e50;">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" 
                                class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password"
                                style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 16px;">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-medium" style="color: #2c3e50;">Daftar sebagai</label>
                            <select name="role" id="role" class="form-select form-select-lg" required
                                style="border-radius: 10px; border: 2px solid #e9ecef; padding: 12px 16px;">
                                <option value="">Pilih peran Anda</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                                <option value="organizer" {{ old('role') == 'organizer' ? 'selected' : '' }}>Penyelenggara</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-lg w-100 mb-4 fw-medium btn-register" 
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                   border: none; border-radius: 10px; color: white; padding: 12px;">
                            {{ __('Register') }}
                        </button>

                        <div class="text-center">
                            <span class="text-muted">Sudah punya akun? </span>
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-decoration-none fw-medium" style="color: #764ba2;">Login ></a>
                            @else
                                <a href="#" class="text-decoration-none fw-medium" style="color: #764ba2;">Login ></a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>