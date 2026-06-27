<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menghapus data admin lama di email ini jika ada agar tidak bentrok/duplicate
        DB::table('users')->where('email', 'admin@crazybites.com')->delete();

        // Memasukkan akun admin resmi yang sudah di-hash otomatis oleh Laravel
        DB::table('users')->insert([
            'name' => 'Admin Crazy Bites',
            'email' => 'admin@crazybites.com',
            'password' => Hash::make('admin123'), // Ini mengenkripsi password dengan aman
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
