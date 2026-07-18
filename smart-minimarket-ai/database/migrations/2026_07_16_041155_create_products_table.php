<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('kode_produk')->unique();

            $table->string('nama_produk');

            $table->foreignId('kategori_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->decimal('harga_beli', 12, 2);

            $table->decimal('harga_jual', 12, 2);

            $table->integer('stock');

            $table->integer('minimum_stock');

            $table->integer('rata_penjualan')->default(0);

            $table->string('gambar')->nullable();

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
