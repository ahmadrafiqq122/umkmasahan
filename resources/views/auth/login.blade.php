@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        padding: 3rem 0;
        background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
    }
    
    .auth-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        background: white;
    }
    
    .auth-brand {
        background: linear-gradient(135deg, var(--asahan-green) 0%, var(--asahan-green-light) 100%);
        color: white;
        padding: 3rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .auth-brand::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }
    
    .auth-brand-content {
        position: relative;
        z-index: 1;
    }
    
    .logo-box {
        width: 100px;
        height: 100px;
        background: rgba(244,196,48,0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
    }
    
    .logo-box img {
        background: white;
        padding: 8px;
        border-radius: 12px;
    }
    
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 2rem 0 0 0;
    }
    
    .feature-list li {
        background: rgba(255,255,255,0.1);
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .feature-list li i {
        font-size: 1.5rem;
        color: var(--asahan-gold);
    }
    
    .auth-form {
        padding: 3rem 2.5rem;
    }
    
    .form-control:focus {
        border-color: var(--asahan-green);
        box-shadow: 0 0 0 3px rgba(45,95,63,0.1);
    }
    
    @media (max-width: 768px) {
        .auth-brand {
            padding: 2rem 1.5rem;
            min-height: auto;
        }
        
        .auth-form {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="row g-0 auth-card">
                    <!-- Left Side - Brand -->
                    <div class="col-md-5 d-none d-md-block">
                        <div class="auth-brand">
                            <div class="auth-brand-content">
                                <div class="logo-box">
                                    @if(file_exists(public_path('images/logo-asahan.png')))
                                        <img src="{{ asset('images/logo-asahan.png') }}" alt="Logo" style="max-width: 80px; max-height: 80px;">
                                    @else
                                        <i class="bi bi-geo-alt-fill" style="font-size: 3rem; color: var(--asahan-gold);"></i>
                                    @endif
                                </div>
                                <h3 class="fw-bold mb-2">UMKM Asahan</h3>
                                <p class="mb-0 opacity-90">Peta Digital UMKM Kabupaten Asahan</p>
                                
                                <ul class="feature-list">
                                    <li>
                                        <i class="bi bi-shield-check"></i>
                                        <span>Data Terverifikasi</span>
                                    </li>
                                    <li>
                                        <i class="bi bi-map"></i>
                                        <span>Peta Interaktif</span>
                                    </li>
                                    <li>
                                        <i class="bi bi-speedometer2"></i>
                                        <span>Dashboard Lengkap</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <p class="mb-0 opacity-75" style="font-size: 0.85rem; position: relative; z-index: 1;">
                                © {{ date('Y') }} Disperindagkop Kab. Asahan
                            </p>
                        </div>
                    </div>
                    
                    <!-- Right Side - Form -->
                    <div class="col-md-7">
                        <div class="auth-form">
                            <div class="mb-4">
                                <h2 class="fw-bold mb-2" style="color: var(--asahan-green);">Selamat Datang!</h2>
                                <p class="text-muted">Silakan login untuk melanjutkan</p>
                            </div>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}" class="form-asahan">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: var(--gray-100); border-color: var(--gray-200);">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               required 
                                               autofocus
                                               placeholder="nama@email.com">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: var(--gray-100); border-color: var(--gray-200);">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               required
                                               placeholder="Masukkan password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">
                                            Ingat Saya
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-asahan-primary w-100 mb-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </button>
                                
                                <div class="text-center">
                                    <p class="text-muted mb-2">
                                        Belum punya akun? 
                                        <a href="{{ route('register') }}" style="color: var(--asahan-green); font-weight: 600;">
                                            Daftar Sekarang
                                        </a>
                                    </p>
                                    <a href="{{ route('home') }}" class="text-muted small">
                                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
