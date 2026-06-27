<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan semua produk di katalog
    public function index()
    
    {
        $produk = Produk::all();
        return view('auth.orders.index', compact('produk'));
    }

    // Menampilkan detail satu produk (Gaya Hokben)
    public function show($id)
    {
        // 1. Cari produk berdasarkan ID
        // findOrFail berfungsi agar jika ID tidak ada, otomatis muncul halaman 404
        $produk = Produk::findOrFail($id);

        // 2. Kirim data ke view detail (show.blade.php)
        return view('auth.orders.show', compact('produk'));
    }
}
