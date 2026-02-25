<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User (akun admin dedicated)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('admin123456'),
            'role' => 'admin',
        ]);

        // Create Sample User (akun user biasa)
        User::create([
            'name' => 'User Test',
            'email' => 'user@test.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

        $this->call(BukuSeeder::class);
    }
}
