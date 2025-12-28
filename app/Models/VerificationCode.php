<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'expires_at',
        'is_used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Generate a random 6-digit verification code
     */
    public static function generateCode(): string
    {
        return str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new verification code for an email
     */
    public static function createForEmail(string $email): self
    {
        // Delete old codes for this email
        self::where('email', $email)->delete();

        return self::create([
            'email' => $email,
            'code' => self::generateCode(),
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);
    }

    /**
     * Check if the code is valid
     */
    public function isValid(): bool
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }

    /**
     * Mark the code as used
     */
    public function markAsUsed(): void
    {
        $this->update(['is_used' => true]);
    }

    /**
     * Verify a code for an email
     */
    public static function verify(string $email, string $code): bool
    {
        $verificationCode = self::where('email', $email)
            ->where('code', $code)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($verificationCode) {
            $verificationCode->markAsUsed();
            return true;
        }

        return false;
    }
}
