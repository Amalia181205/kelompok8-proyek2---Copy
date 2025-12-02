<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Paket Wedding Premium',
                'description' => 'Paket foto pernikahan lengkap dengan 2 fotografer dan video shooting',
                'price' => 5000000,
                'duration' => 8,
                'photo_count' => 300,
                'features' => ['2 Fotografer', 'Video Shooting', 'Album Premium', 'Editing Profesional', 'Cetak 20R'],
                'category' => 'wedding',
                'is_active' => true,
            ],
            [
                'name' => 'Paket Family Portrait',
                'description' => 'Paket foto keluarga dengan konsep indoor/outdoor',
                'price' => 1500000,
                'duration' => 3,
                'photo_count' => 50,
                'features' => ['1 Fotografer', '2 Background', '10 Foto Cetak', 'Softcopy All File'],
                'category' => 'family',
                'is_active' => true,
            ],
            [
                'name' => 'Paket Graduation',
                'description' => 'Paket foto wisuda di kampus atau lokasi pilihan',
                'price' => 1200000,
                'duration' => 2,
                'photo_count' => 40,
                'features' => ['1 Fotografer', 'Lokasi Kampus', '10 Foto Cetak', 'Digital File'],
                'category' => 'graduation',
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}