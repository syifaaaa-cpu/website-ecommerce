<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Penting: Import model User agar tidak merah
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus data user lama agar tidak duplikat saat dijalankan ulang
        User::truncate();

        // Akun Admin[cite: 1, 2]
        User::create([
            'nama_user' => 'Syifa Admin',
            'username'  => 'admin',
            'password'  => Hash::make('123'), // Menggunakan Hash::make lebih standar Laravel
            'role'      => 'admin',
        ]);

        // Akun Petugas[cite: 1, 2]
        User::create([
            'nama_user' => 'Petugas Crazy Bites',
            'username'  => 'petugas',
            'password'  => Hash::make('123'),
            'role'      => 'petugas',
        ]);

        // Akun Pembeli (Untuk testing)
        User::create([
            'nama_user' => 'Pembeli Demo',
            'username'  => 'pembeli',
            'password'  => Hash::make('123'),
            'role'      => 'pembeli',
        ]);
    }
}
