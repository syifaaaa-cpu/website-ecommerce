<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProdukController, AuthController, KeranjangController, PesananController
};

// 1. LANDING PAGE
Route::get('/', function () {
    return view('auth.index');
})->name('home');

// 2. KATALOG & DETAIL (Publik)
Route::get('/katalog', [ProdukController::class, 'index'])->name('orders.index');
Route::get('/katalog/{id_produk}', [ProdukController::class, 'show'])->name('orders.show');

// 3. AUTHENTICATION (Guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// 4. AREA USER (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // FITUR KERANJANG
    Route::post('/keranjang/tambah/{id_produk}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/update/{id_keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/hapus/{id_keranjang}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    // FITUR PESANAN
    Route::get('/checkout', [PesananController::class, 'checkout'])->name('pesanan.checkout');
    Route::post('/proses-pesanan', [PesananController::class, 'prosesPesanan'])->name('pesanan.proses');
    Route::get('/nota/{id}', [PesananController::class, 'nota'])->name('pesanan.nota');
    Route::get('/riwayat-pesanan', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
});

// 5. AREA KHUSUS ADMIN
// Tambahkan :admin setelah kata admin
Route::middleware(['auth', 'admin:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PesananController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/pesanan/update/{id}', [PesananController::class, 'updateStatus'])->name('admin.updateStatus');
});
