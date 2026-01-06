<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash; // HAPUS INI (Tidak perlu jika Model pakai casts hashed)
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // 1. Buat Admin
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Cek apakah email ini ada?
            [
                'name' => 'Administrator',
                // PENTING: Jangan pakai Hash::make() atau bcrypt()
                // karena Model User kamu sudah otomatis melakukan hashing.
                'password' => 'admin123',
                'role' => 'admin',
            ]
        );

        // 2. Buat User Biasa
        User::firstOrCreate(
            ['email' => 'user@gmail.com'], // Cek apakah email ini ada?
            [
                'name' => 'User Biasa',
                'password' => 'user123', // Tulis password polos saja
                'role' => 'user',
            ]
        );
    }
}
