<?php $__env->startSection('title', 'Verifikasi Email'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .verification-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }
    
    .verification-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 2rem;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .code-inputs {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        margin: 1.5rem 0;
    }
    
    .code-input {
        width: 50px;
        height: 60px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 600;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .code-input:focus {
        border-color: #2D5F3F;
        outline: none;
        box-shadow: 0 0 0 3px rgba(45,95,63,0.1);
    }
    
    .resend-section {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 6px;
        text-align: center;
        margin-top: 1.5rem;
    }
    
    #resendBtn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    @media (max-width: 576px) {
        .code-input {
            width: 45px;
            height: 55px;
            font-size: 1.3rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="verification-container">
    <div class="container">
        <div class="verification-card">
            <div class="text-center mb-4">
                <i class="bi bi-envelope-check" style="font-size: 3rem; color: #2D5F3F;"></i>
                <h2 class="mt-3 mb-2">Verifikasi Email</h2>
                <p class="text-muted mb-0">Masukkan kode 6 digit yang dikirim ke:</p>
                <p class="fw-bold"><?php echo e($email); ?></p>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            
            <?php if(session('warning')): ?>
                <div class="alert alert-warning"><?php echo e(session('warning')); ?></div>
            <?php endif; ?>
            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('verification.verify')); ?>" method="POST" id="verificationForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="email" value="<?php echo e($email); ?>">
                <input type="hidden" name="code" id="combinedCode">
                
                <div class="code-inputs">
                    <?php for($i = 0; $i < 6; $i++): ?>
                        <input type="text" 
                               class="code-input" 
                               maxlength="1" 
                               pattern="[0-9]"
                               inputmode="numeric"
                               autocomplete="off"
                               data-index="<?php echo e($i); ?>">
                    <?php endfor; ?>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="bi bi-check-circle me-2"></i>Verifikasi
                </button>
            </form>
            
            <div class="resend-section">
                <button type="button" class="btn btn-link" id="resendBtn" style="color: #2D5F3F; font-weight: 600;">
                    <i class="bi bi-arrow-clockwise me-1"></i>Kirim Ulang Kode <span id="timerDisplay" class="text-muted">(<span id="timer">60</span>s)</span>
                </button>
            </div>
            
            <div class="text-center mt-3">
                <a href="<?php echo e(route('login')); ?>" class="text-muted">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    // Auto-focus & navigation between inputs
    $('.code-input').on('input', function() {
        const $this = $(this);
        const val = $this.val();
        
        // Only allow numbers
        if (!/^\d*$/.test(val)) {
            $this.val('');
            return;
        }
        
        if (val.length === 1) {
            const nextInput = $this.next('.code-input');
            if (nextInput.length) {
                nextInput.focus();
            }
        }
    });
    
    $('.code-input').on('keydown', function(e) {
        const $this = $(this);
        
        // Backspace
        if (e.key === 'Backspace' && !$this.val()) {
            const prevInput = $this.prev('.code-input');
            if (prevInput.length) {
                prevInput.focus();
            }
        }
        
        // Arrow keys
        if (e.key === 'ArrowLeft') {
            $this.prev('.code-input').focus();
        }
        if (e.key === 'ArrowRight') {
            $this.next('.code-input').focus();
        }
    });
    
    // Paste handler
    $('.code-input').first().on('paste', function(e) {
        e.preventDefault();
        const pastedData = e.originalEvent.clipboardData.getData('text').replace(/\D/g, '');
        const inputs = $('.code-input');
        
        for (let i = 0; i < Math.min(pastedData.length, 6); i++) {
            $(inputs[i]).val(pastedData[i]);
        }
        
        if (pastedData.length >= 6) {
            $(inputs[5]).focus();
        }
    });
    
    // Form submit
    $('#verificationForm').on('submit', function(e) {
        e.preventDefault();
        
        let code = '';
        $('.code-input').each(function() {
            code += $(this).val();
        });
        
        if (code.length !== 6) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Masukkan kode 6 digit lengkap',
                confirmButtonColor: '#2D5F3F'
            });
            return;
        }
        
        $('#combinedCode').val(code);
        this.submit();
    });
    
    // ======================================
    // PERSISTENT TIMER - Tidak Reset Saat Refresh
    // ======================================
    const resendBtn = $('#resendBtn');
    const timerElement = $('#timer');
    const timerDisplay = $('#timerDisplay');
    let countdownInterval;
    
    function getTimeLeft() {
        const savedTime = localStorage.getItem('resend_timer_<?php echo e($email); ?>');
        if (savedTime) {
            const timeLeft = Math.max(0, Math.floor((parseInt(savedTime) - Date.now()) / 1000));
            return timeLeft > 0 ? timeLeft : 0;
        }
        return 60;
    }
    
    function saveTimerEnd(seconds) {
        const endTime = Date.now() + (seconds * 1000);
        localStorage.setItem('resend_timer_<?php echo e($email); ?>', endTime);
    }
    
    function startCountdown(initialTime) {
        let timeLeft = initialTime;
        timerElement.text(timeLeft);
        resendBtn.prop('disabled', true);
        timerDisplay.show();
        
        if (initialTime > 0) {
            saveTimerEnd(initialTime);
        }
        
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
        
        countdownInterval = setInterval(function() {
            timeLeft--;
            timerElement.text(timeLeft);
            
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                resendBtn.prop('disabled', false);
                timerDisplay.hide();
                localStorage.removeItem('resend_timer_<?php echo e($email); ?>');
            }
        }, 1000);
    }
    
    // Initialize timer
    const initialTime = getTimeLeft();
    if (initialTime > 0) {
        startCountdown(initialTime);
    } else {
        resendBtn.prop('disabled', false);
        timerDisplay.hide();
    }
    
    // Resend handler
    resendBtn.click(function() {
        if ($(this).prop('disabled')) return;
        
        $(this).prop('disabled', true);
        const originalHtml = $(this).html();
        $(this).html('<i class="bi bi-hourglass-split me-1"></i>Mengirim...');
        
        $.ajax({
            url: '<?php echo e(route("verification.resend")); ?>',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                email: '<?php echo e($email); ?>'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message || 'Kode verifikasi baru telah dikirim',
                    timer: 3000,
                    showConfirmButton: false
                });
                
                resendBtn.html(originalHtml);
                startCountdown(60);
            },
            error: function(xhr) {
                let errorMsg = 'Gagal mengirim email. Silakan coba lagi.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: errorMsg,
                    confirmButtonColor: '#2D5F3F'
                });
                
                resendBtn.prop('disabled', false);
                resendBtn.html(originalHtml);
            }
        });
    });
    
    // Focus first input
    $('.code-input').first().focus();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umkm/resources/views/auth/verification.blade.php ENDPATH**/ ?>