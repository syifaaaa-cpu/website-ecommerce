<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('keranjangs', function (Blueprint $table) {
        $table->integer('id_keranjang')->primary(); // Menyamakan primary key agar rapi
        $table->foreignId('user_id')->constrained('users', 'id_user')->onDelete('cascade'); // Diarahkan ke id_user di tabel users
        $table->foreignId('id_produk')->constrained('produk', 'id_produk')->onDelete('cascade'); // Diarahkan ke id_produk di tabel produk (tanpa s)
        $table->integer('jumlah')->default(1);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
