<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Business;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'user@example.com')->first();
        
        if (!$user) {
            return;
        }

        // Sample businesses in different districts of Kabupaten Asahan
        $businesses = [
            [
                'user_id' => $user->id,
                'business_name' => 'Warung Makan Sederhana',
                'owner_name' => 'Budi Santoso',
                'business_type' => 'kuliner',
                'description' => 'Warung makan dengan menu masakan Padang dan nasi goreng spesial',
                'phone' => '081234567890',
                'whatsapp' => '081234567890',
                'address' => 'Jl. Asahan No. 45',
                'village' => 'Kisaran Kota',
                'district' => 'Kisaran Barat',
                'postal_code' => '21224',
                'latitude' => 2.9833,
                'longitude' => 99.6167,
                'established_year' => 2020,
                'employee_count' => 3,
                'business_scale' => 'mikro',
                'monthly_revenue' => 15000000,
                'products' => json_encode(['Nasi Goreng', 'Rendang', 'Ayam Pop']),
                'main_product' => 'Nasi Goreng Spesial',
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => 1,
            ],
            [
                'user_id' => $user->id,
                'business_name' => 'Kerajinan Tangan Asahan',
                'owner_name' => 'Siti Aminah',
                'business_type' => 'kerajinan',
                'description' => 'Produksi kerajinan tangan dari bambu dan rotan',
                'phone' => '082198765432',
                'whatsapp' => '082198765432',
                'address' => 'Dusun III',
                'village' => 'Sei Semayang',
                'district' => 'Sei Semayang',
                'postal_code' => '21256',
                'latitude' => 3.0500,
                'longitude' => 99.5500,
                'established_year' => 2018,
                'employee_count' => 5,
                'business_scale' => 'mikro',
                'monthly_revenue' => 8000000,
                'products' => json_encode(['Keranjang Rotan', 'Anyaman Bambu', 'Tas Rotan']),
                'main_product' => 'Keranjang Rotan',
                'status' => 'approved',
                'instagram' => '@kerajinan_asahan',
                'approved_at' => now(),
                'approved_by' => 1,
            ],
            [
                'user_id' => $user->id,
                'business_name' => 'Toko Kue Manis',
                'owner_name' => 'Dewi Lestari',
                'business_type' => 'kuliner',
                'description' => 'Kue kering dan basah untuk berbagai acara',
                'phone' => '085276543210',
                'email' => 'kue.manis@gmail.com',
                'whatsapp' => '085276543210',
                'address' => 'Jl. Ahmad Yani No. 12',
                'village' => 'Kisaran Timur',
                'district' => 'Kisaran Timur',
                'postal_code' => '21225',
                'latitude' => 2.9900,
                'longitude' => 99.6300,
                'established_year' => 2021,
                'employee_count' => 4,
                'business_scale' => 'mikro',
                'monthly_revenue' => 12000000,
                'products' => json_encode(['Kue Kering', 'Brownies', 'Bolu Kukus']),
                'main_product' => 'Kue Kering Lebaran',
                'status' => 'approved',
                'instagram' => '@kuemanis_asahan',
                'facebook' => 'kuemamisasahan',
                'approved_at' => now(),
                'approved_by' => 1,
            ],
            [
                'user_id' => $user->id,
                'business_name' => 'Tani Jaya Makmur',
                'owner_name' => 'Pak Joko',
                'business_type' => 'pertanian',
                'description' => 'Usaha pertanian padi dan jagung',
                'phone' => '081367890123',
                'whatsapp' => '081367890123',
                'address' => 'Desa Buntu Pane',
                'village' => 'Buntu Pane',
                'district' => 'Buntu Pane',
                'postal_code' => '21262',
                'latitude' => 2.8500,
                'longitude' => 99.5000,
                'established_year' => 2015,
                'employee_count' => 2,
                'business_scale' => 'mikro',
                'monthly_revenue' => 10000000,
                'products' => json_encode(['Padi', 'Jagung', 'Sayuran']),
                'main_product' => 'Beras Premium',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'business_name' => 'Fashion Hijab Modern',
                'owner_name' => 'Rani Permata',
                'business_type' => 'fashion',
                'description' => 'Menjual berbagai model hijab dan baju muslim modern',
                'phone' => '082145678901',
                'email' => 'fashion.hijab@gmail.com',
                'whatsapp' => '082145678901',
                'address' => 'Jl. Sisingamangaraja No. 88',
                'village' => 'Kisaran Naga',
                'district' => 'Kisaran Naga',
                'postal_code' => '21226',
                'latitude' => 2.9750,
                'longitude' => 99.6250,
                'established_year' => 2022,
                'employee_count' => 3,
                'business_scale' => 'mikro',
                'monthly_revenue' => 18000000,
                'products' => json_encode(['Hijab Segi Empat', 'Gamis', 'Khimar', 'Jilbab Instan']),
                'main_product' => 'Hijab Segi Empat Premium',
                'status' => 'approved',
                'instagram' => '@hijabmodern_asahan',
                'website' => 'www.hijabmodern.com',
                'approved_at' => now(),
                'approved_by' => 1,
            ],
        ];

        foreach ($businesses as $business) {
            Business::create($business);
        }
    }
}
