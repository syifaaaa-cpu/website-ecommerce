<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Users (Untuk Admin, Petugas, Pembeli)[cite: 1, 2]
        Schema::create('users', function (Blueprint $table) {
    $table->id('id_user');
    $table->string('nama_user');
    $table->string('username')->unique();
    $table->string('password');
    // Pastikan baris ini ada agar role berfungsi
    $table->enum('role', ['admin', 'petugas', 'pembeli'])->default('pembeli');
    $table->timestamps();
});

        // 2. Tabel Produk (Katalog Crazy Bite's)
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->string('kategori');
            $table->string('varian_ukuran')->nullable();
            $table->decimal('harga', 10, 2);
            $table->integer('stok')->default(0);
            $table->string('foto_produk')->nullable();
            $table->timestamps();
        });

        // 3. Tabel Pesanan (Header Transaksi)
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->date('tanggal_pesanan')->default(now());
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pesanan', ['Pending', 'Diproses', 'Selesai', 'Dibatalkan'])->default('Pending');
            $table->timestamps();
        });

        // 4. Tabel Detail Pesanan (Relasi Pesanan ke Produk - Sesuai Catatanmu)
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_pesanan')->constrained('pesanan', 'id_pesanan')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('produk', 'id_produk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->timestamps();
        });

        // 5. Tabel Pembayaran (Untuk Verifikasi Bukti Bayar)[cite: 1, 2]
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_pesanan')->constrained('pesanan', 'id_pesanan')->onDelete('cascade');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran');
            $table->enum('status_pembayaran', ['Pending', 'Lunas', 'Gagal'])->default('Pending');
            $table->timestamps();
        });

        // 6. Tabel Laporan (Relasi Pembayaran ke Laporan - Sesuai Catatanmu)[cite: 1]
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_pesanan')->constrained('pesanan', 'id_pesanan')->onDelete('cascade');
            $table->text('catatan_laporan')->nullable();
            $table->date('tanggal_laporan')->default(now());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('users');
    }
};
