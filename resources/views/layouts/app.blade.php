<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Moeeket - Temukan Event Terbaik')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --gradient-start: #6366F1;
            --gradient-end: #3B82F6;
            --bg-default: #F1F7FE;
        }

        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

        html {
        scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            margin: 0;
            padding: 0;
            z-index: 1000;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
        }

        .navbar-brand:hover .gradient-icon {
            transform: rotate(5deg);
            background: linear-gradient(45deg, var(--gradient-end), var(--gradient-start));
        }

        .brand-name {
            font-family: 'Josefin Sans', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            margin-top: 1px;
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gradient-icon {
            width: 30px;
            height: 30px;
            mask: url('{{ asset('images/navbar/nav-icon.png') }}') no-repeat center;
            -webkit-mask: url('{{ asset('images/navbar/nav-icon.png') }}') no-repeat center;
            mask-size: contain;
            -webkit-mask-size: contain;
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            transform: rotate(20deg);
        }

        .nav-link:hover {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: black;
        }

        .btn-login {
            width: 90px;
        }

        .btn-signup {
            width: 90px;
        }

        /* Tombol Hover Kinclong */
        .btn {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
            z-index: 2;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn span, .btn i {
            position: relative;
            z-index: 3;
        }

        .btn-outline-light:hover {
            color: var(--gradient-end);
        }

        /* Tombol Outline Gradient */
        .btn-outline-gradient {
            color: var(--gradient-start);
            background: 
                linear-gradient(white, white) padding-box,
                linear-gradient(45deg, var(--gradient-start), var(--gradient-end)) border-box;
            border: 2px solid transparent;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-gradient:hover {
            color: white;
            background: 
                linear-gradient(45deg, var(--gradient-start), var(--gradient-end)) border-box;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
        }

        /* Tombol Solid Gradient */
        .btn-gradient {
            color: white;
            background: linear-gradient(45deg, var(--gradient-end), var(--gradient-start));
            border: 2px solid transparent;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
        }
        
        /* Main Content */
        .hero-section {
            background: linear-gradient(135deg, #714EF4 20%, #3B82F6 100%);
            color: white;
            padding-top: 180px;
            position: relative;
            overflow: hidden;
        }

        /* Shine overlay (white radial gradient) */
        .hero-section::before {
            background: radial-gradient(
                circle at 70% 30%,
                rgba(0, 0, 0, 0.3) 0%,
                rgba(255, 255, 255, 0) 60%
            );
            animation: pulseShine 5s infinite;
            z-index: 0;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.2) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: skewX(-20deg);
            animation: slideShine 5s infinite 1s;
        }

        @keyframes pulseShine {
            0%, 100% { opacity: 0; }
            10%, 30% { opacity: 0.6; }
        }

        @keyframes slideShine {
            0% { left: -100%; }
            100% { left: 150%; }
        }

        .radius-top {
            border-radius: 30px 30px 0px 0px;
            padding-top: 70px;
            background: white;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: #333;
        }

        .card {
            width: 20rem;
            height: 28rem;
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }

        .overlay {
            position: absolute;
            height: fit-content;
            width: 100%;
            padding: 10px 20px;
            color: white;
            backdrop-filter: blur(8px);
            background-color: rgba(85, 85, 85, 0.4);
            box-sizing: border-box;
        }

        .card-category {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.7rem;
        }

        .card-actions {
            display: flex;
            gap: 15px;
            align-items: center;
            text-decoration: none;
        }

        .card-actions a {
            text-decoration: none;
        }

        .btn-detail {
            flex: 1;
            background: white;
            color: #333;
            border: none;
            padding: 8px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-detail:hover {
            background: linear-gradient(135deg, var(--gradient-start) 30%, var(--gradient-end) 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-favorite {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .btn-favorite:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            color: #ff6b6b;
        }
        
        .btn-favorite.favorited {
            background: #ff6b6b;
            border-color: #ff6b6b;
            color: white;
        }
        
        /* Footer */
        .link-hover:hover {
            color: #3B82F6 !important;
            transform: translateX(3px);
            transition: all 0.3s ease;
        }
        
        /* Social media icons hover */
        .social-icon:hover {
            transform: translateY(-3px);
            color: #3B82F6 !important;
            transition: all 0.3s ease;
        }
        
        /* Made with love hover */
        .love-hover:hover {
            color: #e84393 !important;
            transition: color 0.3s ease;
        }
        
        /* Gradient icon animation */
        .gradient-icon {
            background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
            transition: all 0.5s ease;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @include('layouts.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleFavorite(button, eventId, isFavorited) {
            const icon = button.querySelector('i');
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const url = isFavorited 
                ? `/events/${eventId}/unfavorite` 
                : `/events/${eventId}/favorite`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    icon.classList.toggle('far');
                    icon.classList.toggle('fas');
                    button.classList.toggle('favorited');
                    button.setAttribute('onclick', `toggleFavorite(this, ${eventId}, ${!isFavorited})`);

                    // Animasi kecil
                    button.style.transform = 'scale(1.2)';
                    setTimeout(() => button.style.transform = '', 200);
                } else {
                    alert('Gagal mengupdate favorit.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan saat memproses favorit.');
            });
        }
    </script>


    @stack('scripts')
</body>
</html>