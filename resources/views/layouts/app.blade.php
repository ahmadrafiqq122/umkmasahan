<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Peta Digital UMKM Kabupaten Asahan</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo-asahan.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Dinas Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/dinas-template.css') }}">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    @stack('styles')
</head>
<body>
    <!-- Header Dinas -->
    <header class="header-dinas">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('images/logo-asahan.png') }}" alt="Logo Kabupaten Asahan" class="logo" 
                         onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Coat_of_arms_of_Asahan_Regency.svg/150px-Coat_of_arms_of_Asahan_Regency.svg.png'">
                </div>
                <div class="col">
                    <h1 class="title mb-1">DINAS KOPERASI, PERDAGANGAN DAN PERINDUSTRIAN</h1>
                    <h2 class="subtitle mb-0">KABUPATEN ASAHAN</h2>
                </div>
            </div>
        </div>
    </header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dinas">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="background: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.businesses.*') ? 'active' : '' }}" href="{{ route('admin.businesses.index') }}">
                                    <i class="bi bi-building"></i> Kelola UMKM
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-people"></i> Kelola User
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.business.*') ? 'active' : '' }}" href="{{ route('user.business.create') }}">
                                    <i class="bi bi-plus-circle"></i> Daftar UMKM
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus"></i> Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    
    @if(session('warning'))
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-dinas">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>DISPERINDAGKOP Kab. Asahan</h5>
                    <p class="mb-2"><i class="bi bi-geo-alt"></i> Jl. Prof. H. M. Yamin, Kisaran</p>
                    <p class="mb-2"><i class="bi bi-telephone"></i> (0623) 41xxx</p>
                    <p class="mb-0"><i class="bi bi-envelope"></i> dispkopdagin@asahankab.go.id</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Link Terkait</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://asahankab.go.id" target="_blank">Website Kabupaten Asahan</a></li>
                        <li><a href="https://kemenkopukm.go.id" target="_blank">Kemenkop UKM</a></li>
                        <li><a href="https://oss.go.id" target="_blank">OSS Indonesia</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Tentang Aplikasi</h5>
                    <p>Sistem Informasi Peta Digital UMKM Kabupaten Asahan untuk pendataan dan pemetaan usaha mikro, kecil, dan menengah.</p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Dinas Koperasi, Perdagangan dan Perindustrian Kabupaten Asahan</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @stack('scripts')
</body>
</html>
