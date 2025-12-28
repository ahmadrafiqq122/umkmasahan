<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'business_name',
        'owner_name',
        'business_type',
        'description',
        'phone',
        'email',
        'whatsapp',
        'address',
        'village',
        'district',
        'postal_code',
        'latitude',
        'longitude',
        'established_year',
        'employee_count',
        'business_scale',
        'monthly_revenue',
        'products',
        'main_product',
        'status',
        'rejection_reason',
        'nib',
        'pirt',
        'halal_certificate',
        'facebook',
        'instagram',
        'website',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'monthly_revenue' => 'decimal:2',
        'employee_count' => 'integer',
        'established_year' => 'integer',
        'products' => 'array',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the user that owns the business
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved the business
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get all photos for the business
     */
    public function photos()
    {
        return $this->hasMany(BusinessPhoto::class);
    }

    /**
     * Get the primary photo
     */
    public function primaryPhoto()
    {
        return $this->hasOne(BusinessPhoto::class)->where('is_primary', true);
    }

    /**
     * Get business place photos
     */
    public function placePhotos()
    {
        return $this->hasMany(BusinessPhoto::class)->where('photo_type', 'tempat_usaha');
    }

    /**
     * Get product photos
     */
    public function productPhotos()
    {
        return $this->hasMany(BusinessPhoto::class)->where('photo_type', 'produk');
    }

    /**
     * Check if business is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if business is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if business is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve the business
     */
    public function approve(int $approvedBy): void
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $approvedBy,
            'rejection_reason' => null,
        ]);
    }

    /**
     * Reject the business
     */
    public function reject(string $reason): void
    {
        $this->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }

    /**
     * Get business type label in Indonesian
     */
    public function getBusinessTypeLabel(): string
    {
        $types = [
            'kuliner' => 'Kuliner',
            'fashion' => 'Fashion',
            'kerajinan' => 'Kerajinan',
            'pertanian' => 'Pertanian',
            'perikanan' => 'Perikanan',
            'jasa' => 'Jasa',
            'perdagangan' => 'Perdagangan',
            'lainnya' => 'Lainnya',
        ];

        return $types[$this->business_type] ?? 'Tidak Diketahui';
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'approved' => 'success',
            'pending' => 'warning',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'approved' => 'Disetujui',
            'pending' => 'Menunggu Persetujuan',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Scope to only approved businesses
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to only pending businesses
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to only rejected businesses
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope to filter by district
     */
    public function scopeByDistrict($query, string $district)
    {
        return $query->where('district', $district);
    }

    /**
     * Scope to filter by business type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('business_type', $type);
    }
}
