<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // 1. Checkout
    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $itemsTerpilih = $request->query('items_terpilih');

        if (!$itemsTerpilih) {
            return redirect()->route('keranjang.index')->with('error', 'Pilih produk terlebih dahulu!');
        }

        $arrayIdKeranjang = explode(',', $itemsTerpilih);
        $produkCheckout = DB::table('keranjangs')
            ->join('produk', 'keranjangs.id_produk', '=', 'produk.id_produk')
            ->whereIn('keranjangs.id_keranjang', $arrayIdKeranjang)
            ->where('keranjangs.user_id', $userId)
            ->select('keranjangs.id_keranjang', 'keranjangs.jumlah', 'produk.id_produk', 'produk.nama_produk', 'produk.harga', 'produk.foto_produk')
            ->get();

        if ($produkCheckout->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Data produk tidak ditemukan!');
        }

        $totalBayar = 0;
        foreach ($produkCheckout as $item) {
            $totalBayar += ($item->harga * $item->jumlah);
        }

        return view('auth.checkout', compact('produkCheckout', 'totalBayar', 'itemsTerpilih'));
    }

    // 2. Proses Pesanan (DIBENARKAN DI SINI)
   public function prosesPesanan(Request $request)
{
    // 1. Validasi input form
    $request->validate([
        'alamat'            => 'required',
        'metode_pembayaran' => 'required',
        'total_bayar'       => 'required',
        'items_terpilih'    => 'required'
    ]);

    try {
        DB::beginTransaction();

        // 2. Insert ke tabel pesanan
        $idPesanan = DB::table('pesanan')->insertGetId([
            'id_user'           => Auth::id(),
            'tanggal_pesanan'   => now(),
            'total_harga'       => $request->total_bayar,
            'status_pesanan'    => 'Pending',
            'alamat'            => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'created_at'        => now()
        ]);

        // 3. Proses detail_pesanan dan hapus keranjang (seperti kode Anda sebelumnya)
        $arrayIdKeranjang = explode(',', $request->items_terpilih);
        // ... (lanjutkan logika foreach insert ke detail_pesanan) ...

        DB::table('keranjangs')->whereIn('id_keranjang', $arrayIdKeranjang)->delete();

        DB::commit();

        // 4. KUNCI PERBAIKAN: Gunakan nama route yang benar sesuai web.php
        return redirect()->route('pesanan.nota', ['id' => $idPesanan]);

    } catch (\Exception $e) {
        DB::rollBack();
        // Jika ada error, Laravel akan menampilkan pesannya karena APP_DEBUG=true
        return "Terjadi kesalahan: " . $e->getMessage();
    }
}

    // 3. Nota
    public function nota($id)
    {
        $pesanan = DB::table('pesanan')->where('id_pesanan', $id)->first();

        if (!$pesanan) {
            return redirect()->route('home')->with('error', 'Nota tidak ditemukan.');
        }

        $detail = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
            ->where('detail_pesanan.id_pesanan', $id)
            ->get();

        // Pastikan file ada di resources/views/auth/nota.blade.php
        return view('auth.nota', compact('pesanan', 'detail'));
    }

    // 4. Riwayat
    public function riwayat()
    {
        $pesanan = DB::table('pesanan')
            ->where('id_user', Auth::id())
            ->orderBy('id_pesanan', 'desc')
            ->get();

        return view('auth.orders.riwayat', compact('pesanan'));
    }

    // 5. Admin
    public function adminDashboard()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/katalog')->with('loginError', 'Akses ditolak!');
        }
        $pesananMasuk = DB::table('pesanan')
            ->join('users', 'pesanan.id_user', '=', 'users.id_user')
            ->select('pesanan.*', 'users.nama_user as nama_pelanggan')
            ->orderBy('pesanan.id_pesanan', 'desc')
            ->get();
        return view('admin.dashboard', compact('pesananMasuk'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status_pesanan' => 'required']);
        DB::table('pesanan')->where('id_pesanan', $id)->update([
            'status_pesanan' => $request->status_pesanan,
            'updated_at' => now()
        ]);
        return redirect()->back()->with('success', 'Status diubah!');
    }
}
