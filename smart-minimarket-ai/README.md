# Minimarket - Smart Minimarket AI

## Kelompok

**Kelompok TG**

| No | Nama | NIM |
| :--- | :--- | :--- |
| 1 | Aprian Adi Prasetyo | 2413010714 |
| 2 | Ady Teguh Imam P | 2413010710 |
| 3 | Bagas Arif Waseso | 2413010713 |
| 4 | Restu Prasetyo N | 2413010711 |

## Deskripsi

Next Market merupakan aplikasi berbasis web yang dikembangkan menggunakan framework Laravel untuk membantu pengguna dalam melakukan manajemen restock barang secara efisien. Sistem Smart Restock AI pada aplikasi ini menerapkan metode Fuzzy Logic Mamdani dalam menganalisis kebutuhan restock berdasarkan jumlah stok saat ini dan rata-rata penjualan mingguan. Hasil analisis disajikan dalam bentuk tabel prioritas restock yang terbagi menjadi tiga kategori, yaitu Stock Aman, Perlu Dipantau, dan Segera Restock, sehingga dapat membantu pengguna dalam mengambil keputusan pengadaan barang yang tepat dan akurat.

Selain menyediakan fitur rekomendasi restock, aplikasi juga dilengkapi dengan sistem autentikasi pengguna, dashboard pengguna(kasir), transaksi pembayaran, serta dashboard administrator untuk mengelola data produk dan stok.


## Fitur Utama

### Pengguna
* Landing Page
* Login dan Registrasi (Google Authentication)
* Dashboard Smart Restock AI
* Hasil Analisis AI
* Transaksi Kasir
* Hasil Rekomendasi Komputer
* Restock
* Product

### Administrator
* Dashboard Admin
* Payments
* Sales
* Stock Histories
* Suppliers
* Kategori
* Products
* Restock Produk

## Metode Sistem Pakar

* Fuzzy Logic: Mamdani

## Teknologi yang Digunakan

* Laravel
* PHP
* MySQL
* Tailwind CSS
* Livewire
* JavaScript

## Cara Menjalankan Project

```bash
git clone https://github.com/kampusriset/24g_laravel_sipakar_minimarket.git
cd smart-minimarket-ai
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```
## Mata Kuliah

Pemrograman Web

STMIK AMIKOM Surakarta