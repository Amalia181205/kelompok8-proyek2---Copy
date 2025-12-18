<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@fanesya.com',
            'password' => Hash::make('password123'),
        ]);

        // Tambahkan admin lain jika perlu
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@fanesya.com',
            'password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'name' => 'Administrator',
            'email' => 'mimin@fanesya.com',
            'password' => Hash::make('password123'),
        ]);
    }
}