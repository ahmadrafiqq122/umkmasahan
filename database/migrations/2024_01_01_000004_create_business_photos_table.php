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
        Schema::create('business_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->string('photo_path');
            $table->enum('photo_type', ['tempat_usaha', 'produk', 'lainnya'])->default('produk');
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            
            $table->index('business_id');
            $table->index('photo_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_photos');
    }
};
