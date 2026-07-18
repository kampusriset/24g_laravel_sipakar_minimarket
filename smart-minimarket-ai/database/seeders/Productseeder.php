<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
{
    $products = [

        // ================= MAKANAN =================
        [
            'kode_produk'=>'PRD001',
            'nama_produk'=>'Indomie Goreng',
            'kategori_id'=>1,
            'supplier_id'=>1,
            'harga_beli'=>2800,
            'harga_jual'=>3500,
            'stock'=>50,
            'minimum_stock'=>10,
            'rata_penjualan'=>15,
            'gambar'=>null,
            'deskripsi'=>'Mi Instan Goreng'
        ],
        [
            'kode_produk'=>'PRD002',
            'nama_produk'=>'Indomie Soto',
            'kategori_id'=>1,
            'supplier_id'=>1,
            'harga_beli'=>2800,
            'harga_jual'=>3500,
            'stock'=>45,
            'minimum_stock'=>10,
            'rata_penjualan'=>13,
            'gambar'=>null,
            'deskripsi'=>'Mi Instan Soto'
        ],
        [
            'kode_produk'=>'PRD003',
            'nama_produk'=>'Mie Sedaap Goreng',
            'kategori_id'=>1,
            'supplier_id'=>2,
            'harga_beli'=>2700,
            'harga_jual'=>3400,
            'stock'=>40,
            'minimum_stock'=>10,
            'rata_penjualan'=>12,
            'gambar'=>null,
            'deskripsi'=>'Mi Sedaap'
        ],
        [
            'kode_produk'=>'PRD004',
            'nama_produk'=>'Supermi Ayam',
            'kategori_id'=>1,
            'supplier_id'=>1,
            'harga_beli'=>2600,
            'harga_jual'=>3300,
            'stock'=>35,
            'minimum_stock'=>10,
            'rata_penjualan'=>9,
            'gambar'=>null,
            'deskripsi'=>'Supermi'
        ],
        [
            'kode_produk'=>'PRD005',
            'nama_produk'=>'Pop Mie Ayam',
            'kategori_id'=>1,
            'supplier_id'=>1,
            'harga_beli'=>5500,
            'harga_jual'=>6500,
            'stock'=>25,
            'minimum_stock'=>5,
            'rata_penjualan'=>7,
            'gambar'=>null,
            'deskripsi'=>'Pop Mie'
        ],

        // ================= MINUMAN =================
        [
            'kode_produk'=>'PRD006',
            'nama_produk'=>'Aqua 600ml',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>2500,
            'harga_jual'=>3500,
            'stock'=>60,
            'minimum_stock'=>15,
            'rata_penjualan'=>20,
            'gambar'=>null,
            'deskripsi'=>'Air Mineral'
        ],
        [
            'kode_produk'=>'PRD007',
            'nama_produk'=>'Le Minerale 600ml',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>2400,
            'harga_jual'=>3300,
            'stock'=>55,
            'minimum_stock'=>15,
            'rata_penjualan'=>18,
            'gambar'=>null,
            'deskripsi'=>'Air Mineral'
        ],
        [
            'kode_produk'=>'PRD008',
            'nama_produk'=>'Teh Botol Sosro',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>4200,
            'harga_jual'=>5000,
            'stock'=>40,
            'minimum_stock'=>10,
            'rata_penjualan'=>14,
            'gambar'=>null,
            'deskripsi'=>'Teh Botol'
        ],
        [
            'kode_produk'=>'PRD009',
            'nama_produk'=>'Coca Cola',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>4800,
            'harga_jual'=>6000,
            'stock'=>35,
            'minimum_stock'=>10,
            'rata_penjualan'=>10,
            'gambar'=>null,
            'deskripsi'=>'Minuman Soda'
        ],
        [
            'kode_produk'=>'PRD010',
            'nama_produk'=>'Sprite',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>4800,
            'harga_jual'=>6000,
            'stock'=>30,
            'minimum_stock'=>10,
            'rata_penjualan'=>8,
            'gambar'=>null,
            'deskripsi'=>'Minuman Soda'
        ],

        // ================= SNACK =================
        [
            'kode_produk'=>'PRD011',
            'nama_produk'=>'Chitato',
            'kategori_id'=>3,
            'supplier_id'=>2,
            'harga_beli'=>8500,
            'harga_jual'=>10000,
            'stock'=>25,
            'minimum_stock'=>5,
            'rata_penjualan'=>8,
            'gambar'=>null,
            'deskripsi'=>'Keripik Kentang'
        ],
        [
            'kode_produk'=>'PRD012',
            'nama_produk'=>'Oreo',
            'kategori_id'=>3,
            'supplier_id'=>2,
            'harga_beli'=>7000,
            'harga_jual'=>8500,
            'stock'=>30,
            'minimum_stock'=>5,
            'rata_penjualan'=>10,
            'gambar'=>null,
            'deskripsi'=>'Biskuit Oreo'
        ],
        [
            'kode_produk'=>'PRD013',
            'nama_produk'=>'Roma Kelapa',
            'kategori_id'=>3,
            'supplier_id'=>2,
            'harga_beli'=>6500,
            'harga_jual'=>8000,
            'stock'=>28,
            'minimum_stock'=>5,
            'rata_penjualan'=>9,
            'gambar'=>null,
            'deskripsi'=>'Biskuit Roma'
        ],
        [
            'kode_produk'=>'PRD014',
            'nama_produk'=>'Tango Wafer',
            'kategori_id'=>3,
            'supplier_id'=>2,
            'harga_beli'=>7500,
            'harga_jual'=>9000,
            'stock'=>24,
            'minimum_stock'=>5,
            'rata_penjualan'=>7,
            'gambar'=>null,
            'deskripsi'=>'Wafer Tango'
        ],
        [
            'kode_produk'=>'PRD015',
            'nama_produk'=>'SilverQueen',
            'kategori_id'=>3,
            'supplier_id'=>2,
            'harga_beli'=>12000,
            'harga_jual'=>15000,
            'stock'=>18,
            'minimum_stock'=>5,
            'rata_penjualan'=>5,
            'gambar'=>null,
            'deskripsi'=>'Coklat'
        ],

        // ================= SEMBAKO =================
        [
            'kode_produk'=>'PRD016',
            'nama_produk'=>'Beras Ramos 5Kg',
            'kategori_id'=>4,
            'supplier_id'=>1,
            'harga_beli'=>72000,
            'harga_jual'=>78000,
            'stock'=>15,
            'minimum_stock'=>5,
            'rata_penjualan'=>4,
            'gambar'=>null,
            'deskripsi'=>'Beras'
        ],
        [
            'kode_produk'=>'PRD017',
            'nama_produk'=>'Gulaku 1Kg',
            'kategori_id'=>4,
            'supplier_id'=>1,
            'harga_beli'=>16000,
            'harga_jual'=>18000,
            'stock'=>20,
            'minimum_stock'=>5,
            'rata_penjualan'=>6,
            'gambar'=>null,
            'deskripsi'=>'Gula Pasir'
        ],
        [
            'kode_produk'=>'PRD018',
            'nama_produk'=>'Minyak Bimoli 1L',
            'kategori_id'=>4,
            'supplier_id'=>1,
            'harga_beli'=>18500,
            'harga_jual'=>21000,
            'stock'=>18,
            'minimum_stock'=>5,
            'rata_penjualan'=>5,
            'gambar'=>null,
            'deskripsi'=>'Minyak Goreng'
        ],
        [
            'kode_produk'=>'PRD019',
            'nama_produk'=>'Tepung Segitiga Biru',
            'kategori_id'=>4,
            'supplier_id'=>1,
            'harga_beli'=>12000,
            'harga_jual'=>14000,
            'stock'=>20,
            'minimum_stock'=>5,
            'rata_penjualan'=>5,
            'gambar'=>null,
            'deskripsi'=>'Tepung'
        ],
        [
            'kode_produk'=>'PRD020',
            'nama_produk'=>'Garam Dolpin',
            'kategori_id'=>4,
            'supplier_id'=>1,
            'harga_beli'=>2500,
            'harga_jual'=>3500,
            'stock'=>35,
            'minimum_stock'=>10,
            'rata_penjualan'=>9,
            'gambar'=>null,
            'deskripsi'=>'Garam'
        ],

        // ================= PERAWATAN =================
        [
            'kode_produk'=>'PRD021',
            'nama_produk'=>'Pepsodent',
            'kategori_id'=>5,
            'supplier_id'=>4,
            'harga_beli'=>9000,
            'harga_jual'=>11000,
            'stock'=>30,
            'minimum_stock'=>5,
            'rata_penjualan'=>8,
            'gambar'=>null,
            'deskripsi'=>'Pasta Gigi'
        ],
        [
            'kode_produk'=>'PRD022',
            'nama_produk'=>'Lifebuoy',
            'kategori_id'=>5,
            'supplier_id'=>4,
            'harga_beli'=>4500,
            'harga_jual'=>6000,
            'stock'=>35,
            'minimum_stock'=>5,
            'rata_penjualan'=>10,
            'gambar'=>null,
            'deskripsi'=>'Sabun'
        ],
        [
            'kode_produk'=>'PRD023',
            'nama_produk'=>'Rinso',
            'kategori_id'=>5,
            'supplier_id'=>4,
            'harga_beli'=>18000,
            'harga_jual'=>22000,
            'stock'=>18,
            'minimum_stock'=>5,
            'rata_penjualan'=>4,
            'gambar'=>null,
            'deskripsi'=>'Deterjen'
        ],
        [
            'kode_produk'=>'PRD024',
            'nama_produk'=>'Daia',
            'kategori_id'=>5,
            'supplier_id'=>2,
            'harga_beli'=>17000,
            'harga_jual'=>21000,
            'stock'=>16,
            'minimum_stock'=>5,
            'rata_penjualan'=>3,
            'gambar'=>null,
            'deskripsi'=>'Deterjen'
        ],
        [
            'kode_produk'=>'PRD025',
            'nama_produk'=>'Sunlight',
            'kategori_id'=>5,
            'supplier_id'=>4,
            'harga_beli'=>8000,
            'harga_jual'=>9500,
            'stock'=>22,
            'minimum_stock'=>5,
            'rata_penjualan'=>7,
            'gambar'=>null,
            'deskripsi'=>'Sabun Cuci Piring'
        ],

        // ================= TAMBAHAN =================
        [
            'kode_produk'=>'PRD026',
            'nama_produk'=>'Ultra Milk',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>5500,
            'harga_jual'=>7000,
            'stock'=>30,
            'minimum_stock'=>8,
            'rata_penjualan'=>10,
            'gambar'=>null,
            'deskripsi'=>'Susu UHT'
        ],
        [
            'kode_produk'=>'PRD027',
            'nama_produk'=>'Yakult',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>9000,
            'harga_jual'=>11000,
            'stock'=>20,
            'minimum_stock'=>5,
            'rata_penjualan'=>6,
            'gambar'=>null,
            'deskripsi'=>'Minuman Probiotik'
        ],
        [
            'kode_produk'=>'PRD028',
            'nama_produk'=>'Good Day Cappuccino',
            'kategori_id'=>2,
            'supplier_id'=>1,
            'harga_beli'=>1800,
            'harga_jual'=>2500,
            'stock'=>40,
            'minimum_stock'=>10,
            'rata_penjualan'=>12,
            'gambar'=>null,
            'deskripsi'=>'Kopi Sachet'
        ],
        [
            'kode_produk'=>'PRD029',
            'nama_produk'=>'Sari Roti Coklat',
            'kategori_id'=>1,
            'supplier_id'=>2,
            'harga_beli'=>6500,
            'harga_jual'=>8000,
            'stock'=>18,
            'minimum_stock'=>5,
            'rata_penjualan'=>7,
            'gambar'=>null,
            'deskripsi'=>'Roti'
        ],
        [
            'kode_produk'=>'PRD030',
            'nama_produk'=>'Pocari Sweat',
            'kategori_id'=>2,
            'supplier_id'=>3,
            'harga_beli'=>6500,
            'harga_jual'=>8000,
            'stock'=>25,
            'minimum_stock'=>8,
            'rata_penjualan'=>9,
            'gambar'=>null,
            'deskripsi'=>'Minuman Isotonik'
        ],
    ];  

    foreach ($products as $product) {
        \App\Models\Product::create($product);
    }
}
}
