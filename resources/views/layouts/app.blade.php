<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Peta Digital UMKM') - Dinas Koperasi, Perdagangan dan Perindustrian Kabupaten Asahan</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-asahan.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Asahan Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/asahan-theme.css') }}">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    @stack('styles')
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0066cc;
            --primary-dark: #004d99;
            --secondary-color: #0080ff;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #0ea5e9;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }
        
        .main-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f8f9fa 100%);
            border-top: 3px solid var(--asahan-gold);
            border-bottom: 3px solid var(--asahan-green);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 2rem 0 !important;
            position: relative;
            overflow: hidden;
        }
        
        .main-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(26,77,46,0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(244,196,48,0.03) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .main-header .container {
            position: relative;
            z-index: 1;
        }
        
        .header-text-wrapper {
            background: linear-gradient(135deg, rgba(26,77,46,0.05) 0%, rgba(244,196,48,0.05) 100%);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            border: 3px solid transparent;
            background-image: 
                linear-gradient(white, white),
                linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-gold) 100%);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: -0.5px;
        }

        .navbar-custom {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-bottom: 3px solid #0066cc;
        }

        .navbar-custom .navbar-brand {
            color: #0066cc !important;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .navbar-custom .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #0066cc !important;
        }
        
        .logo-dinas {
            height: 90px;
            width: auto;
            background: white;
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background: #0066cc;
            border: none;
            font-weight: 600;
            padding: 0.65rem 1.5rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #0052a3;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 102, 204, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-success {
            background: #28a745;
            border: none;
        }
        
        .btn-success:hover {
            background: #218838;
        }
        
        .btn-warning {
            background: #ffc107;
            border: none;
            color: #333;
        }
        
        .btn-warning:hover {
            background: #e0a800;
        }
        
        .btn-danger {
            background: #dc3545;
            border: none;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
            background: white;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        
        .card-header {
            background: #f8f9fa;
            border-bottom: 2px solid #0066cc;
            font-weight: 600;
            color: #333;
        }

        .footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .stat-card {
            background: white;
            border: 2px solid #0066cc;
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0,102,204,0.2);
        }

        .stat-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0066cc;
        }
        
        .stat-card i {
            font-size: 2.5rem;
            color: #0066cc;
        }
        
        .stat-card p {
            color: #666;
            margin: 0;
        }

        .badge-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .logo-header {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }
        
        .logo-img {
            background: white;
            padding: 5px;
            border-radius: 8px;
        }

        .page-header {
            background: linear-gradient(135deg, #0066cc 0%, #0080ff 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-bottom: 4px solid #004d99;
        }

        .page-header h1 {
            font-weight: 700;
            font-size: 2rem;
        }

        .alert {
            border: none;
            border-radius: 15px;
            border-left: 4px solid;
            box-shadow: var(--shadow-md);
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease;
        }

        #map {
            height: 600px;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            border: 3px solid white;
            overflow: hidden;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f3f4f6;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 10px;
        }

        input.form-control, select.form-select, textarea.form-control {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        input.form-control:focus, select.form-select:focus, textarea.form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
            transform: translateY(-2px);
        }

        .leaflet-popup-content-wrapper {
            border-radius: 10px;
        }

        .business-marker {
            background: var(--secondary-color);
            border: 3px solid white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .business-marker:hover {
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            #map {
                height: 400px;
            }
            
            .logo-header {
                height: 30px;
            }
            
            .navbar-brand {
                font-size: 0.9rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Main Header -->
    <div class="main-header py-3">
        <div class="container">
            <div class="header-text-wrapper">
                <div class="row align-items-center">
                    <div class="col-auto">
                        @if(file_exists(public_path('images/logo-asahan.png')))
                            <img src="{{ asset('images/logo-asahan.png') }}" alt="Logo Kabupaten Asahan" class="logo-dinas">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Coat_of_arms_of_Asahan_Regency.svg/150px-Coat_of_arms_of_Asahan_Regency.svg.png" alt="Logo Kabupaten Asahan" class="logo-dinas">
                        @endif
                    </div>
                    <div class="col-auto">
                        <div style="width: 4px; height: 90px; background: linear-gradient(to bottom, var(--asahan-green), var(--asahan-gold)); border-radius: 2px;"></div>
                    </div>
                    <div class="col">
                        <h3 class="mb-1 fw-bold" style="color: var(--asahan-green); font-size: 1.6rem; line-height: 1.2; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                            DINAS KOPERASI, PERDAGANGAN DAN PERINDUSTRIAN
                        </h3>
                        <h4 class="mb-2 fw-bold" style="color: #0066cc; font-size: 1.4rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                            KABUPATEN ASAHAN
                        </h4>
                        <div class="row g-2 mt-1">
                            <div class="col-auto">
                                <div class="d-flex align-items-center" style="background: rgba(26,77,46,0.1); padding: 6px 12px; border-radius: 8px;">
                                    <i class="bi bi-geo-alt-fill me-2" style="color: var(--asahan-green); font-size: 0.95rem;"></i>
                                    <span style="font-size: 0.85rem; color: #495057; font-weight: 500;">Jl. Prof. H. M. Yamin, Kisaran</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex align-items-center" style="background: rgba(26,77,46,0.1); padding: 6px 12px; border-radius: 8px;">
                                    <i class="bi bi-telephone-fill me-2" style="color: var(--asahan-green); font-size: 0.95rem;"></i>
                                    <span style="font-size: 0.85rem; color: #495057; font-weight: 500;">(0623) 41xxx</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex align-items-center" style="background: rgba(26,77,46,0.1); padding: 6px 12px; border-radius: 8px;">
                                    <i class="bi bi-envelope-fill me-2" style="color: var(--asahan-green); font-size: 0.95rem;"></i>
                                    <span style="font-size: 0.85rem; color: #495057; font-weight: 500;">dispkopdagin@asahankab.go.id</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div style="width: 4px; height: 90px; background: linear-gradient(to bottom, var(--asahan-green), var(--asahan-gold)); border-radius: 2px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <!-- Navbar Asahan -->
    <nav class="navbar navbar-expand-lg navbar-asahan">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: rgba(255,255,255,0.3);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door me-1"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-gold" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>Daftar Sekarang
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door me-1"></i>Beranda
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard Admin
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" style="gap: 0.5rem;">
                                <div style="width: 32px; height: 32px; background: rgba(244,196,48,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-fill" style="color: #F4C430;"></i>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                <li>
                                    <a class="dropdown-item" href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Asahan -->
    <footer class="footer-asahan">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo">
                        @if(file_exists(public_path('images/logo-asahan.png')))
                            <img src="{{ asset('images/logo-asahan.png') }}" alt="Logo Asahan">
                        @endif
                        @if(file_exists(public_path('images/logo-disperindagkop.png')))
                            <img src="{{ asset('images/logo-disperindagkop.png') }}" alt="Logo Disperindagkop">
                        @endif
                    </div>
                    <h5 class="mb-3">Peta Digital UMKM Asahan</h5>
                    <p style="color: var(--gray-300); line-height: 1.6;">
                        Sistem Informasi Pemetaan Digital Pelaku Usaha Mikro, Kecil, dan Menengah 
                        Kabupaten Asahan - Sumatera Utara
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" title="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}">
                                <i class="bi bi-chevron-right me-2"></i>Beranda
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('register') }}">
                                <i class="bi bi-chevron-right me-2"></i>Daftar UMKM
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('login') }}">
                                <i class="bi bi-chevron-right me-2"></i>Login
                            </a>
                        </li>
                        @auth
                        <li class="mb-2">
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}">
                                <i class="bi bi-chevron-right me-2"></i>Dashboard
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
                
                <div class="col-lg-5 col-md-6 mb-4">
                    <h5>Kontak Kami</h5>
                    <div class="mb-3">
                        <p style="color: var(--gray-300); margin-bottom: 0.5rem;">
                            <i class="bi bi-building me-2" style="color: var(--asahan-gold);"></i>
                            <strong style="color: var(--white);">Dinas Koperasi, Perdagangan dan Perindustrian</strong>
                        </p>
                        <p style="color: var(--gray-300); margin-bottom: 0.5rem; padding-left: 1.75rem;">
                            Kabupaten Asahan
                        </p>
                    </div>
                    <p style="color: var(--gray-300); margin-bottom: 0.5rem;">
                        <i class="bi bi-geo-alt-fill me-2" style="color: var(--asahan-gold);"></i>
                        Kabupaten Asahan, Sumatera Utara
                    </p>
                    <p style="color: var(--gray-300); margin-bottom: 0.5rem;">
                        <i class="bi bi-envelope-fill me-2" style="color: var(--asahan-gold);"></i>
                        <a href="mailto:disperindagkop@asahankab.go.id" style="color: var(--gray-300);">
                            disperindagkop@asahankab.go.id
                        </a>
                    </p>
                    <p style="color: var(--gray-300); margin-bottom: 0;">
                        <i class="bi bi-telephone-fill me-2" style="color: var(--asahan-gold);"></i>
                        (0623) XXXXXX
                    </p>
                </div>
            </div>
            
            <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0 1.5rem;">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0" style="color: var(--gray-300); font-size: 0.9rem;">
                        &copy; {{ date('Y') }} Disperindagkop Kabupaten Asahan. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0" style="color: var(--gray-300); font-size: 0.9rem;">
                        Powered by <span style="color: var(--asahan-gold); font-weight: 600;">Laravel & Leaflet.js</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        // Show flash messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error!',
                html: '<ul class="text-start">' +
                    @foreach($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
                showConfirmButton: true
            });
        @endif
    </script>
    
    @stack('scripts')
</body>
</html>
