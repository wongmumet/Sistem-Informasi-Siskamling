<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Siskamling',
            'email' => 'admin@siskamling.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Siskamling No. 1',
        ]);

        User::create([
            'name' => 'Ketua RT',
            'email' => 'ketua@siskamling.com',
            'password' => Hash::make('password'),
            'role' => 'ketua',
            'phone' => '081234567891',
            'address' => 'Jl. Siskamling No. 2',
        ]);

        User::create([
            'name' => 'Warga Biasa',
            'email' => 'warga@siskamling.com',
            'password' => Hash::make('password'),
            'role' => 'warga',
            'phone' => '081234567892',
            'address' => 'Jl. Siskamling No. 3',
        ]);
    }
}