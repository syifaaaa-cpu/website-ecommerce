<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Nama tabel di database
    protected $table = 'produk';

    // Primary key di tabel
    protected $primaryKey = 'id_produk';

    // Daftar kolom yang diizinkan untuk diisi massal
    protected $fillable = [
        'nama_produk',
        'kategori',
        'varian_ukuran',
        'harga',
        'stok',
        'foto_produk',
        'deskripsi'
    ];
}
