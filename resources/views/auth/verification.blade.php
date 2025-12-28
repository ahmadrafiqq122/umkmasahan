@extends('layouts.app')

@section('title', 'Verifikasi Email')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 76px);
        display: flex;
        align-items: center;
        padding: 4rem 0;
        background: linear-gradient(135deg, rgba(26,77,46,0.03) 0%, rgba(244,196,48,0.03) 100%);
        position: relative;
    }
    
    .auth-wrapper::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(244,196,48,0.1) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        right: -100px;
        animation: float 8s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    .verification-card {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1;
    }
    
    /* Left Side - Brand */
    .auth-brand {
        background: linear-gradient(135deg, var(--asahan-green) 0%, #2d6a4f 100%);
        padding: 3rem 2.5rem;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 600px;
        position: relative;
        overflow: hidden;
    }
    
    .auth-brand::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }
    
    .auth-brand::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(244,196,48,0.2) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }
    
    .auth-brand-content {
        position: relative;
        z-index: 1;
    }
    
    .logo-box {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        border: 2px solid rgba(255,255,255,0.2);
        animation: pulse 3s ease-in-out infinite;
    }
    
    .logo-box img {
        background: white;
        padding: 8px;
        border-radius: 12px;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,255,255,0.4); }
        50% { transform: scale(1.05); box-shadow: 0 0 20px 10px rgba(255,255,255,0); }
    }
    
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 2rem 0 0 0;
    }
    
    .feature-list li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        backdrop-filter: blur(5px);
    }
    
    .feature-list i {
        font-size: 1.5rem;
        color: var(--asahan-gold);
    }
    
    /* Right Side - Form */
    .auth-content {
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .verification-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .icon-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--asahan-green) 0%, #2d6a4f 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 30px rgba(26,77,46,0.3);
        animation: pulseIcon 2s ease-in-out infinite;
    }
    
    @keyframes pulseIcon {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
    }
    
    .verification-title {
        color: var(--asahan-green);
        font-weight: 800;
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .email-display {
        background: rgba(26,77,46,0.05);
        padding: 1rem;
        border-radius: 12px;
        margin: 1.5rem 0;
        border: 2px solid rgba(26,77,46,0.1);
    }
    
    .verification-code-inputs {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        margin: 2rem 0;
    }
    
    .verification-code-inputs input {
        width: 55px;
        height: 65px;
        text-align: center;
        font-size: 1.75rem;
        font-weight: 700;
        border: 3px solid #dee2e6;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        color: var(--asahan-green);
    }
    
    .verification-code-inputs input:focus {
        outline: none;
        border-color: var(--asahan-green);
        box-shadow: 0 0 0 4px rgba(26,77,46,0.1);
        transform: scale(1.05);
    }
    
    .verification-code-inputs input:not(:placeholder-shown) {
        border-color: var(--asahan-green);
        background: rgba(26,77,46,0.05);
    }
    
    .btn-verify {
        background: linear-gradient(135deg, var(--asahan-green) 0%, #2d6a4f 100%);
        border: none;
        color: white;
        padding: 0.9rem;
        font-size: 1.05rem;
        font-weight: 700;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(26,77,46,0.3);
    }
    
    .btn-verify:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26,77,46,0.4);
        background: linear-gradient(135deg, #2d6a4f 0%, var(--asahan-green) 100%);
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        animation: slideInDown 0.5s ease;
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .resend-section {
        background: rgba(26,77,46,0.03);
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
        margin-top: 1.5rem;
    }
    
    .resend-timer {
        opacity: 0.7;
        font-size: 0.9rem;
    }
    
    #resendBtn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    @media (max-width: 768px) {
        .auth-wrapper {
            padding: 2rem 0;
        }
        
        .auth-content {
            padding: 2rem 1.5rem;
        }
        
        .verification-title {
            font-size: 1.5rem;
        }
        
        .verification-code-inputs {
            gap: 0.5rem;
        }
        
        .verification-code-inputs input {
            width: 45px;
            height: 55px;
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="row g-0 verification-card">
                    <!-- Left Side - Brand -->
                    <div class="col-md-5 d-none d-md-block">
                        <div class="auth-brand">
                            <div class="auth-brand-content">
                                <div class="logo-box">
                                    @if(file_exists(public_path('images/logo-asahan.png')))
                                        <img src="{{ asset('images/logo-asahan.png') }}" alt="Logo" style="max-width: 80px; max-height: 80px;">
                                    @else
                                        <i class="bi bi-shield-check" style="font-size: 3rem; color: var(--asahan-gold);"></i>
                                    @endif
                                </div>
                                <h3 class="fw-bold mb-3">Verifikasi Email Anda</h3>
                                <p class="mb-4 opacity-90">Langkah terakhir untuk bergabung dengan ekosistem digital UMKM Kabupaten Asahan</p>
                                
                                <ul class="feature-list">
                                    <li>
                                        <i class="bi bi-envelope-check-fill"></i>
                                        <span>Verifikasi Cepat</span>
                                    </li>
                                    <li>
                                        <i class="bi bi-shield-lock-fill"></i>
                                        <span>Keamanan Terjamin</span>
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Data Terproteksi</span>
                                    </li>
                                </ul>
                                
                                <div class="mt-4 pt-4 border-top border-white border-opacity-25">
                                    <p class="mb-2 opacity-75" style="font-size: 0.9rem;">
                                        <i class="bi bi-info-circle me-2"></i>Kode verifikasi berlaku 10 menit
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Verification Form -->
                    <div class="col-md-7">
                        <div class="auth-content">
                            <div class="verification-header">
                                <div class="icon-circle">
                                    <i class="bi bi-envelope-check" style="font-size: 2.5rem; color: white;"></i>
                                </div>
                                
                                <h2 class="verification-title">Verifikasi Email</h2>
                                <p class="text-muted mb-2">
                                    Masukkan kode verifikasi 6 digit yang telah dikirim ke:
                                </p>
                                <div class="email-display text-center">
                                    <i class="bi bi-envelope-fill me-2" style="color: var(--asahan-gold);"></i>
                                    <strong style="color: var(--asahan-green); font-size: 1.05rem;">{{ $email ?? session('verification_email') }}</strong>
                                </div>
                            </div>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            @if(session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            @if(!session('success') && !session('error'))
                                <div class="alert alert-info" role="alert">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Cek email Anda!</strong> Kode verifikasi telah dikirim. Jika tidak ada di inbox, cek folder spam/junk.
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('verification.verify') }}" id="verificationForm">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email ?? session('verification_email') }}">
                                <input type="hidden" name="code" id="combinedCode" value="">
                                
                                <div class="verification-code-inputs">
                                    <input type="text" maxlength="1" class="code-input" data-index="1" required>
                                    <input type="text" maxlength="1" class="code-input" data-index="2" required>
                                    <input type="text" maxlength="1" class="code-input" data-index="3" required>
                                    <input type="text" maxlength="1" class="code-input" data-index="4" required>
                                    <input type="text" maxlength="1" class="code-input" data-index="5" required>
                                    <input type="text" maxlength="1" class="code-input" data-index="6" required>
                                </div>
                                
                                @error('code')
                                    <div class="text-danger text-center mb-3">{{ $message }}</div>
                                @enderror
                                
                                <button type="submit" class="btn btn-verify w-100 mb-3">
                                    <i class="bi bi-shield-check me-2"></i>Verifikasi Sekarang
                                </button>
                            </form>
                            
                            <div class="resend-section">
                                <p class="text-muted mb-2" style="font-size: 0.95rem;">
                                    <i class="bi bi-clock-history me-1"></i>Tidak menerima kode?
                                </p>
                                <button type="button" class="btn btn-link" id="resendBtn" style="color: var(--asahan-green); font-weight: 700; text-decoration: none; font-size: 1.05rem;">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Kirim Ulang Kode <span class="resend-timer">(<span id="timer">60</span>s)</span>
                                </button>
                                <p class="text-muted mt-2" style="font-size: 0.85rem;">
                                    Kode akan dikirim ulang ke email Anda
                                </p>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-muted">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto focus and move to next input
    $('.code-input').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        
        if (this.value.length === 1) {
            $(this).next('.code-input').focus();
        }
        
        // Auto submit when all fields filled
        let allFilled = true;
        $('.code-input').each(function() {
            if ($(this).val() === '') {
                allFilled = false;
                return false;
            }
        });
        
        if (allFilled) {
            // Combine all codes into hidden input
            let fullCode = '';
            $('.code-input').each(function() {
                fullCode += $(this).val();
            });
            $('#combinedCode').val(fullCode);
            $('#verificationForm').submit();
        }
    });
    
    // Handle backspace
    $('.code-input').on('keydown', function(e) {
        if (e.key === 'Backspace' && this.value === '') {
            $(this).prev('.code-input').focus();
        }
    });
    
    // Handle paste
    $('.code-input').first().on('paste', function(e) {
        e.preventDefault();
        const pasteData = e.originalEvent.clipboardData.getData('text');
        const digits = pasteData.replace(/[^0-9]/g, '').split('');
        
        $('.code-input').each(function(index) {
            if (digits[index]) {
                $(this).val(digits[index]);
            }
        });
        
        // Auto submit if all fields filled
        if (digits.length >= 6) {
            let fullCode = '';
            $('.code-input').each(function() {
                fullCode += $(this).val();
            });
            $('#combinedCode').val(fullCode);
            $('#verificationForm').submit();
        }
    });
    
    // Countdown timer for resend button
    let timeLeft = 60;
    const resendBtn = $('#resendBtn');
    const timerElement = $('#timer');
    
    const countdown = setInterval(function() {
        timeLeft--;
        timerElement.text(timeLeft);
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            resendBtn.prop('disabled', false);
            resendBtn.html('<i class="bi bi-arrow-clockwise me-2"></i>Kirim Ulang Kode');
        }
    }, 1000);
    
    // Resend code
    resendBtn.click(function() {
        if (timeLeft > 0) {
            return;
        }
        
        if ($(this).prop('disabled')) {
            return;
        }
        
        $.ajax({
            url: '{{ route("verification.resend") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: '{{ $email ?? session("verification_email") }}'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Kode verifikasi baru telah dikirim',
                    timer: 3000,
                    showConfirmButton: false
                });
                
                // Reset timer
                timeLeft = 60;
                resendBtn.prop('disabled', true);
                timerElement.parent().show();
                
                const newCountdown = setInterval(function() {
                    timeLeft--;
                    timerElement.text(timeLeft);
                    
                    if (timeLeft <= 0) {
                        clearInterval(newCountdown);
                        resendBtn.prop('disabled', false);
                        resendBtn.html('<i class="bi bi-arrow-clockwise me-2"></i>Kirim Ulang Kode');
                    }
                }, 1000);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan, silakan coba lagi'
                });
            }
        });
    });
    
    // Focus first input
    $('.code-input').first().focus();
});
</script>
@endpush
