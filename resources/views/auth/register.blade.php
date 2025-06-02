<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }
        .full-height {
            height: 100vh;
        }
        .left-section {
            background-image: url('{{ asset('images/register-image.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* overlay warna gelap tipis */
            position: relative;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
        }
        .left-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 0;
        }
        .left-section > * {
            position: relative;
            z-index: 1;
        }
        .left-section h2 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .left-section p {
            font-size: 1.2rem;
            opacity: 0.85;
        }
        .right-section {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            overflow-y: auto;
        }
        form {
            width: 100%;
            max-width: 400px;
        }
        form h2 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        form p {
            margin-bottom: 2rem;
            color: #6c757d;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid #ced4da;
            padding: 10px 14px;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #764ba2;
            box-shadow: 0 0 5px rgba(118, 75, 162, 0.5);
            outline: none;
        }
        button.btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        button.btn-register:hover {
            box-shadow: 0 5px 20px rgba(118, 75, 162, 0.4);
            transform: translateY(-2px);
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        .login-link a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 991.98px) {
            .left-section {
                display: none;
            }
            .right-section {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex full-height">
        <div class="left-section col-lg-6 d-none d-lg-flex">
            <div>
                <h2>E-Ticketing</h2>
                <p>Mulai perjalanan Anda bersama platform terbaik</p>
            </div>
        </div>
        <div class="right-section col-12 col-lg-6">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h2>Create Account</h2>
                <p>Isi informasi di bawah untuk membuat akun</p>

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" />
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" />
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Daftar sebagai</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Pilih peran Anda</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                        <option value="organizer" {{ old('role') == 'organizer' ? 'selected' : '' }}>Penyelenggara</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-register mb-3">{{ __('Register') }}</button>

                <div class="login-link">
                    <span>Sudah punya akun? </span>
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                    @else
                    <a href="#">Login</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
