<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@disperindagkop.asahan.go.id',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Create sample admin account for testing
        User::create([
            'name' => 'Admin Disperindagkop',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567891',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Create sample user account for testing
        $user = User::create([
            'name' => 'Pelaku Usaha Demo',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081298765432',
            'nik' => '1201234567890123',
            'address' => 'Jl. Contoh No. 123, Kisaran',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Create sample business data
        $this->call(BusinessSeeder::class);
    }
}
