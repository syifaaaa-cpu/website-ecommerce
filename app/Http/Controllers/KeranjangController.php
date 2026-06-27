<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // 1. Fungsi Tambah ke Keranjang
    public function tambah(Request $request, $id_produk)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('loginError', 'Silakan login terlebih dahulu untuk memesan!');
        }

        $userId = Auth::id();
        $jumlah = $request->input('jumlah', 1);

        // Langsung tembak nama kolom 'id_produk' pasca migrate:fresh
        $cek = DB::table('keranjangs')
            ->where('user_id', $userId)
            ->where('id_produk', $id_produk)
            ->first();

        if ($cek) {
            DB::table('keranjangs')
                ->where('user_id', $userId)
                ->where('id_produk', $id_produk)
                ->update(['jumlah' => $cek->jumlah + $jumlah]);
        } else {
            DB::table('keranjangs')->insert([
                'user_id'   => $userId,
                'id_produk' => $id_produk,
                'jumlah'    => $jumlah,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Brownies berhasil dimasukkan ke keranjang!');
    }

   // 2. Tampilkan Halaman Keranjang
    public function index()
    {
        $userId = Auth::id();

        // Query join disesuaikan menggunakan produk.foto_produk
        $keranjang = DB::table('keranjangs')
            ->join('produk', 'keranjangs.id_produk', '=', 'produk.id_produk')
            ->where('keranjangs.user_id', $userId)
            ->select('keranjangs.*', 'produk.nama_produk', 'produk.harga', 'produk.foto_produk')
            ->get();

       return view('auth.keranjang', compact('keranjang'));
    }

    // 3. Fungsi Update Jumlah Item (Plus/Minus via Ajax)
    public function update(Request $request, $id_keranjang)
    {
        $jumlahBaru = $request->input('jumlah');

        // Pastikan jumlah minimal adalah 1
        if ($jumlahBaru < 1) {
            return response()->json(['success' => false, 'message' => 'Jumlah minimal 1'], 400);
        }

        DB::table('keranjangs')
            ->where('id_keranjang', $id_keranjang)
            ->update(['jumlah' => $jumlahBaru]);

        return response()->json(['success' => true]);
    }

    // 4. Fungsi Hapus Item dari Keranjang
    public function hapus($id_keranjang)
    {
        DB::table('keranjangs')->where('id_keranjang', $id_keranjang)->delete();
        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
