<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BusinessPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'photo_path',
        'photo_type',
        'caption',
        'order',
        'is_primary',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_primary' => 'boolean',
    ];

    /**
     * Get the business that owns the photo
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the full URL for the photo
     */
    public function getPhotoUrlAttribute(): string
    {
        return Storage::url($this->photo_path);
    }

    /**
     * Get photo type label
     */
    public function getPhotoTypeLabel(): string
    {
        return match($this->photo_type) {
            'tempat_usaha' => 'Tempat Usaha',
            'produk' => 'Produk',
            'lainnya' => 'Lainnya',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Delete photo file from storage when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            if (Storage::exists($photo->photo_path)) {
                Storage::delete($photo->photo_path);
            }
        });
    }
}
