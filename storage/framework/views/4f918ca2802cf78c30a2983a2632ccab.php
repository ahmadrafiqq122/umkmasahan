<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .verification-box {
            background: #f8fafc;
            border: 2px dashed #3b82f6;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .verification-code {
            font-size: 36px;
            font-weight: bold;
            color: #1e40af;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .info-text {
            color: #6b7280;
            font-size: 14px;
            margin-top: 10px;
        }
        .instructions {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🗺️ Peta Digital UMKM Asahan</h1>
            <p>Dinas Koperasi Perdagangan dan Perindustrian</p>
            <p>Kabupaten Asahan</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Halo, <strong><?php echo e($userName); ?></strong>
            </div>
            
            <p>
                Terima kasih telah mendaftar di Sistem Informasi Peta Digital Usaha Mikro Kabupaten Asahan.
                Untuk menyelesaikan pendaftaran akun Anda, silakan gunakan kode verifikasi berikut:
            </p>
            
            <div class="verification-box">
                <p style="margin: 0; font-size: 14px; color: #6b7280;">Kode Verifikasi Anda:</p>
                <div class="verification-code"><?php echo e($verificationCode); ?></div>
                <p class="info-text">Kode ini berlaku selama 15 menit</p>
            </div>
            
            <div class="instructions">
                <strong>⚠️ Penting:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>Jangan bagikan kode ini kepada siapa pun</li>
                    <li>Kode verifikasi hanya berlaku satu kali</li>
                    <li>Jika Anda tidak melakukan pendaftaran, abaikan email ini</li>
                </ul>
            </div>
            
            <p>
                Setelah verifikasi berhasil, Anda dapat login dan mendaftarkan usaha Anda untuk ditampilkan
                di peta digital Kabupaten Asahan.
            </p>
            
            <p style="margin-top: 30px;">
                Salam hormat,<br>
                <strong>Tim Disperindagkop Kabupaten Asahan</strong>
            </p>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">
                Email ini dikirim secara otomatis, mohon tidak membalas email ini.
            </p>
            <p style="margin: 10px 0 0 0;">
                © <?php echo e(date('Y')); ?> Dinas Koperasi Perdagangan dan Perindustrian Kabupaten Asahan
            </p>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/umkm/resources/views/emails/verification-code.blade.php ENDPATH**/ ?>