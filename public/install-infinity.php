<?php
/**
 * InfinityFree Installer Script
 * 
 * PENTING: DELETE FILE INI SETELAH INSTALASI SELESAI!
 * 
 * File ini akan:
 * 1. Install Composer dependencies
 * 2. Run migrations
 * 3. Seed database
 * 4. Create storage link
 * 5. Cache configuration
 */

// Security: Only allow from localhost or specific IP
$allowed_ips = ['127.0.0.1', '::1'];
// Comment line below to allow from any IP (use with caution!)
// $allowed_ips = [];

if (!empty($allowed_ips) && !in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
    die('Access denied. Please run this from localhost or update $allowed_ips in the script.');
}

// Set time limit
set_time_limit(600); // 10 minutes

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfinityFree Installer - UMKM Asahan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 2em;
        }
        .subtitle {
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .alert-danger {
            background: #fee;
            color: #c00;
            border: 2px solid #fcc;
        }
        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 2px solid #ffc107;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 2px solid #28a745;
        }
        .step {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
        }
        .step h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .step pre {
            background: #2c3e50;
            color: #0f0;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 0.9em;
        }
        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9em;
        }
        .status-success {
            background: #28a745;
            color: white;
        }
        .status-error {
            background: #dc3545;
            color: white;
        }
        .status-running {
            background: #ffc107;
            color: #000;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #667eea;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 InfinityFree Installer</h1>
        <p class="subtitle">Peta Digital UMKM Kabupaten Asahan</p>

        <div class="alert alert-warning">
            <strong>⚠️ PERINGATAN:</strong> File ini harus DIHAPUS setelah instalasi selesai untuk keamanan!
        </div>

<?php
if (!isset($_GET['run'])) {
    // Show start screen
    ?>
        <div class="alert alert-danger">
            <strong>🔒 PASTIKAN:</strong>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>File <code>.env</code> sudah dikonfigurasi dengan benar</li>
                <li>Database sudah dibuat di cPanel</li>
                <li>Semua file sudah di-upload ke <code>/htdocs/</code></li>
                <li>Folder <code>vendor/</code> belum ada (akan di-install oleh script ini)</li>
            </ul>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="?run=1" class="btn">▶️ Mulai Instalasi</a>
        </div>

        <div style="background: #e9ecef; padding: 20px; border-radius: 8px; margin-top: 30px;">
            <h3 style="margin-bottom: 15px;">📋 Checklist Sebelum Instalasi:</h3>
            <ul style="margin-left: 20px; line-height: 2;">
                <li>✅ Akun InfinityFree sudah dibuat</li>
                <li>✅ Website sudah provisioning</li>
                <li>✅ Files sudah di-upload via FTP</li>
                <li>✅ Database MySQL sudah dibuat di cPanel</li>
                <li>✅ File <code>.env</code> sudah dikonfigurasi</li>
                <li>✅ APP_KEY sudah di-generate</li>
            </ul>
        </div>
    <?php
    exit;
}

// Run installation
echo '<div class="loader"></div>';
echo '<h2 style="text-align: center; margin: 20px 0;">⏳ Proses Instalasi Sedang Berjalan...</h2>';

$base_path = dirname(__DIR__); // Go up one level from public/
$errors = [];
$success = [];

// Helper function to run command
function runCommand($command, $label) {
    global $errors, $success, $base_path;
    
    echo '<div class="step">';
    echo '<h3>' . $label . ' <span class="status status-running">⏳ Running...</span></h3>';
    
    $full_command = "cd {$base_path} && {$command} 2>&1";
    $output = shell_exec($full_command);
    
    echo '<pre>' . htmlspecialchars($output) . '</pre>';
    
    // Check if command was successful
    if (stripos($output, 'error') !== false || stripos($output, 'failed') !== false) {
        $errors[] = $label;
        echo '<span class="status status-error">❌ Error</span>';
    } else {
        $success[] = $label;
        echo '<span class="status status-success">✅ Success</span>';
    }
    
    echo '</div>';
    flush();
    ob_flush();
}

// Check if shell_exec is available
if (!function_exists('shell_exec')) {
    echo '<div class="alert alert-danger">';
    echo '<strong>❌ ERROR:</strong> shell_exec() function is disabled on this server.';
    echo '<br><br><strong>Alternative:</strong> Upload folder <code>vendor/</code> manually via FTP.';
    echo '</div>';
    exit;
}

// Start installation
ob_start();

echo '<div style="margin: 30px 0;">';

// Step 1: Install Composer Dependencies
runCommand('composer install --no-dev --optimize-autoloader --no-interaction', '📦 Installing Composer Dependencies');

// Step 2: Run Migrations
runCommand('php artisan migrate --force', '🗄️ Running Database Migrations');

// Step 3: Seed Database
runCommand('php artisan db:seed --force --class=DatabaseSeeder', '🌱 Seeding Database');

// Step 4: Create Storage Link
runCommand('php artisan storage:link', '🔗 Creating Storage Link');

// Step 5: Cache Configuration
runCommand('php artisan config:cache', '⚡ Caching Configuration');

// Step 6: Cache Routes
runCommand('php artisan route:cache', '🛣️ Caching Routes');

// Step 7: Cache Views
runCommand('php artisan view:cache', '👁️ Caching Views');

echo '</div>';

// Summary
echo '<div style="margin-top: 40px; padding: 30px; background: #f8f9fa; border-radius: 12px;">';
echo '<h2 style="margin-bottom: 20px;">📊 Installation Summary</h2>';

if (count($errors) > 0) {
    echo '<div class="alert alert-danger">';
    echo '<strong>❌ Some steps failed:</strong><br>';
    echo '<ul style="margin-left: 20px; margin-top: 10px;">';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="alert alert-success">';
    echo '<strong>🎉 All steps completed successfully!</strong>';
    echo '</div>';
}

echo '<div style="margin: 20px 0;">';
echo '<strong>✅ Successful steps:</strong> ' . count($success) . '<br>';
echo '<strong>❌ Failed steps:</strong> ' . count($errors);
echo '</div>';

echo '<h3 style="margin-top: 30px; margin-bottom: 15px;">🔐 Next Steps:</h3>';
echo '<ol style="margin-left: 20px; line-height: 2;">';
echo '<li><strong>DELETE this file immediately!</strong> (<code>public/install-infinity.php</code>)</li>';
echo '<li>Access your website: <a href="/" target="_blank">Open Website</a></li>';
echo '<li>Login as admin:<br>';
echo '   Email: <code>admin@disperindagkop.asahan.go.id</code><br>';
echo '   Password: <code>Admin123!</code></li>';
echo '<li>Change admin password immediately</li>';
echo '<li>Test all features (form, map, upload, etc.)</li>';
echo '</ol>';

echo '<div style="text-align: center; margin-top: 30px;">';
echo '<a href="?delete=1" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this installer?\');">🗑️ Delete This Installer Now</a>';
echo '</div>';

echo '</div>';

ob_end_flush();

?>
    </div>
</body>
</html>

<?php
// Handle delete request
if (isset($_GET['delete']) && $_GET['delete'] == '1') {
    if (unlink(__FILE__)) {
        echo '<script>alert("Installer deleted successfully!"); window.location.href = "/";</script>';
    } else {
        echo '<script>alert("Failed to delete installer. Please delete manually: public/install-infinity.php");</script>';
    }
}
?>
