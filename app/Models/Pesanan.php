<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

{
    class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $fillable = ['id_user', 'tgl_pesanan', 'total_harga', 'status'];

    // Relasi ke User (Pembeli)
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
}
