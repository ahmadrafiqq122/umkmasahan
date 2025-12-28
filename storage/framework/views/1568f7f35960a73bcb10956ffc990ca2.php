<?php $__env->startSection('title', 'Daftar UMKM'); ?>

<?php $__env->startPush('styles'); ?>
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
        justify-content: center;
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
        text-align: center;
    }
    
    .logo-box {
        width: 120px;
        height: 120px;
        background: rgba(244,196,48,0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
    }
    
    .logo-box img {
        background: white;
        padding: 8px;
        border-radius: 12px;
    }
    
    .benefit-item {
        background: rgba(255,255,255,0.1);
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        text-align: left;
    }
    
    .benefit-item i {
        color: var(--asahan-gold);
        font-size: 1.25rem;
        margin-right: 0.75rem;
    }
    
    .auth-form {
        padding: 3rem 2.5rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--asahan-green);
        box-shadow: 0 0 0 3px rgba(45,95,63,0.1);
    }
    
    .password-strength {
        height: 4px;
        background: var(--gray-200);
        border-radius: 2px;
        margin-top: 0.5rem;
        overflow: hidden;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: all 0.3s ease;
    }
    
    .password-strength-bar.weak { width: 33%; background: #ef4444; }
    .password-strength-bar.medium { width: 66%; background: #f59e0b; }
    .password-strength-bar.strong { width: 100%; background: #10b981; }
    
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="row g-0 auth-card">
                    <!-- Left Side - Brand -->
                    <div class="col-md-5 d-none d-md-block">
                        <div class="auth-brand">
                            <div class="auth-brand-content">
                                <div class="logo-box">
                                    <?php if(file_exists(public_path('images/logo-asahan.png'))): ?>
                                        <img src="<?php echo e(asset('images/logo-asahan.png')); ?>" alt="Logo" style="max-width: 100px; max-height: 100px;">
                                    <?php else: ?>
                                        <i class="bi bi-shop" style="font-size: 4rem; color: var(--asahan-gold);"></i>
                                    <?php endif; ?>
                                </div>
                                <h3 class="fw-bold mb-3">Daftarkan UMKM Anda</h3>
                                <p class="mb-4 opacity-90">Bergabunglah dengan ekosistem digital UMKM Kabupaten Asahan</p>
                                
                                <div class="benefit-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Gratis & Mudah</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Promosi Digital</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Jangkauan Lebih Luas</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Data Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Form -->
                    <div class="col-md-7">
                        <div class="auth-form">
                            <div class="mb-4">
                                <h2 class="fw-bold mb-2" style="color: var(--asahan-green);">Buat Akun Baru</h2>
                                <p class="text-muted">Isi data dengan lengkap dan benar</p>
                            </div>
                            
                            <form method="POST" action="<?php echo e(route('register')); ?>" class="form-asahan">
                                <?php echo csrf_field(); ?>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" 
                                               class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="name" 
                                               name="name" 
                                               value="<?php echo e(old('name')); ?>" 
                                               required 
                                               autofocus
                                               placeholder="Nama lengkap">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" 
                                               class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="email" 
                                               name="email" 
                                               value="<?php echo e(old('email')); ?>" 
                                               required
                                               placeholder="nama@email.com">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon</label>
                                        <input type="text" 
                                               class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="phone" 
                                               name="phone" 
                                               value="<?php echo e(old('phone')); ?>" 
                                               required
                                               placeholder="08xxxxxxxxxx">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" 
                                               class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="nik" 
                                               name="nik" 
                                               value="<?php echo e(old('nik')); ?>" 
                                               required
                                               placeholder="16 digit NIK"
                                               maxlength="16">
                                        <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                              id="address" 
                                              name="address" 
                                              rows="2" 
                                              required
                                              placeholder="Alamat lengkap"><?php echo e(old('address')); ?></textarea>
                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" 
                                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="password" 
                                               name="password" 
                                               required
                                               placeholder="Minimal 8 karakter">
                                        <div class="password-strength">
                                            <div class="password-strength-bar" id="strengthBar"></div>
                                        </div>
                                        <small class="text-muted" id="strengthText">Minimal 8 karakter</small>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required
                                               placeholder="Ulangi password">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                                        <label class="form-check-label" for="agree">
                                            Saya setuju dengan syarat dan ketentuan yang berlaku
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-asahan-primary w-100 mb-3">
                                    <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                                </button>
                                
                                <div class="text-center">
                                    <p class="text-muted mb-2">
                                        Sudah punya akun? 
                                        <a href="<?php echo e(route('login')); ?>" style="color: var(--asahan-green); font-weight: 600;">
                                            Login
                                        </a>
                                    </p>
                                    <a href="<?php echo e(route('home')); ?>" class="text-muted small">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    // Password strength checker
    $('#password').on('input', function() {
        const password = $(this).val();
        const strengthBar = $('#strengthBar');
        const strengthText = $('#strengthText');
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        if (password.match(/[^a-zA-Z\d]/)) strength++;
        
        strengthBar.removeClass('weak medium strong');
        
        if (strength <= 1) {
            strengthBar.addClass('weak');
            strengthText.text('Password lemah').css('color', '#ef4444');
        } else if (strength <= 3) {
            strengthBar.addClass('medium');
            strengthText.text('Password sedang').css('color', '#f59e0b');
        } else {
            strengthBar.addClass('strong');
            strengthText.text('Password kuat').css('color', '#10b981');
        }
    });
    
    // NIK validation
    $('#nik').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Phone validation
    $('#phone').on('input', function() {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umkm/resources/views/auth/register.blade.php ENDPATH**/ ?>