<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Informasi Dasar
            $table->string('business_name');
            $table->string('owner_name');
            $table->enum('business_type', [
                'kuliner',
                'fashion',
                'kerajinan',
                'pertanian',
                'perikanan',
                'jasa',
                'perdagangan',
                'lainnya'
            ]);
            $table->text('description');
            
            // Kontak
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            
            // Alamat
            $table->text('address');
            $table->string('village'); // Desa/Kelurahan
            $table->string('district'); // Kecamatan
            $table->string('postal_code', 5)->nullable();
            
            // Koordinat
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            // Informasi Usaha
            $table->year('established_year')->nullable();
            $table->integer('employee_count')->default(1);
            $table->enum('business_scale', ['mikro', 'kecil', 'menengah'])->default('mikro');
            $table->decimal('monthly_revenue', 15, 2)->nullable();
            
            // Produk/Layanan
            $table->text('products')->nullable(); // JSON array of products
            $table->string('main_product')->nullable();
            
            // Status & Legalitas
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->string('nib')->nullable(); // Nomor Induk Berusaha
            $table->string('pirt')->nullable(); // P-IRT (Pangan Industri Rumah Tangga)
            $table->string('halal_certificate')->nullable(); // Sertifikat Halal
            
            // Social Media
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            
            // Timestamps
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('user_id');
            $table->index('status');
            $table->index('business_type');
            $table->index('district');
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
