<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Makanan', 'deskripsi' => 'Produk makanan'],
            ['nama_kategori' => 'Minuman', 'deskripsi' => 'Produk minuman'],
            ['nama_kategori' => 'Snack', 'deskripsi' => 'Makanan ringan'],
            ['nama_kategori' => 'Sembako', 'deskripsi' => 'Kebutuhan pokok'],
            ['nama_kategori' => 'Perawatan', 'deskripsi' => 'Produk perawatan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}