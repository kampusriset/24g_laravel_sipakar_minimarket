    @extends('layouts.dashboard')

    @section('dashboard-content')

    <div class="min-h-screen bg-gray-100 p-8">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-4xl font-bold">
                Dashboard Penjualan
            </h1>

            <a href="{{ route('kasir.index') }}"
                class="bg-yellow-400 hover:bg-yellow-500 px-5 py-3 rounded-xl font-semibold">

                ← Kembali ke Kasir

            </a>

        </div>


        {{-- ================= TOP CARD ================= --}}
        <div class="grid grid-cols-12 gap-6 mb-8">

            {{-- Total Penjualan --}}
            <div class="col-span-12 lg:col-span-2">

                <div class="bg-white border rounded-2xl shadow-sm h-full p-5 hover:shadow-lg transition">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-lg bg-green-600 flex items-center justify-center text-white">

                            💰

                        </div>

                        <span class="font-semibold text-sm">

                            Total Penjualan

                        </span>

                    </div>

                    <h2 class="text-2xl font-bold mt-6">

                        Rp {{ number_format($totalPenjualan,0,',','.') }}

                    </h2>

                </div>

            </div>

            {{-- Total Transaksi --}}
            <div class="col-span-12 lg:col-span-2">

                <div class="bg-white border rounded-2xl shadow-sm h-full p-5 hover:shadow-lg transition">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-lg bg-blue-600 flex items-center justify-center text-white">

                            🧾

                        </div>

                        <span class="font-semibold text-sm">

                            Total Transaksi

                        </span>

                    </div>

                    <h2 class="text-2xl font-bold mt-6">

                        {{ $totalTransaksi }}

                    </h2>

                </div>

            </div>

            {{-- Produk Hampir Habis --}}
            <div class="col-span-12 lg:col-span-5">

                <div class="relative bg-white border rounded-2xl shadow-sm h-full">

                    <div class="absolute -top-3 left-5 bg-yellow-400 px-6 py-2 rounded-t-xl border font-bold">

                        Produk Hampir Habis

                    </div>

                    <div class="pt-10 pb-5 px-6">

                        @forelse($stokMenipis->take(5) as $produk)

                        <div class="py-2 border-b last:border-0 flex justify-between">

                            <span>

                                {{ $produk->nama_produk }}

                            </span>

                            <span class="font-bold text-red-500">

                                {{ $produk->stock }}

                            </span>

                        </div>

                        @empty

                        <div class="text-gray-400">

                            Tidak ada produk.

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

            {{-- Tombol AI --}}
            <div class="col-span-12 lg:col-span-3">

                <a href="{{ route('restock.index') }}">

                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl text-white p-6 shadow-lg h-full hover:scale-105 transition">

                        <p class="text-sm opacity-80">

                            Smart Restock

                        </p>

                        <h2 class="text-3xl font-bold mt-2">

                            AI

                        </h2>

                        <p class="mt-4">

                            {{ $jumlahRestock }} Produk Prioritas

                        </p>

                        <div class="mt-5 text-sm">

                            Klik untuk melihat analisis →

                        </div>

                    </div>

                </a>

            </div>

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

            {{-- Grafik --}}
            <div class="xl:col-span-2 bg-white rounded-2xl shadow-md border p-6">

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl font-bold">

                        Trend Penjualan

                    </h2>

                </div>

                <canvas id="salesChart" height="120"></canvas>

            </div>

            {{-- Ringkasan AI --}}
            <div class="bg-white rounded-2xl shadow-md border p-6">

                <h2 class="text-xl font-bold mb-5">

                    Smart Restock AI

                </h2>

                <div class="space-y-5">

                    <div class="flex justify-between">

                        <span>🔴 Segera Restock</span>

                        <span class="font-bold text-red-500">

                            {{ $jumlahRestock }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>🟡 Perlu Dipantau</span>

                        <span class="font-bold text-yellow-500">

                            {{ $jumlahPantau }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>🟢 Stock Aman</span>

                        <span class="font-bold text-green-600">

                            {{ $jumlahAman }}

                        </span>

                    </div>

                </div>

                <a href="{{ route('restock.index') }}"
                    class="block mt-8 text-center bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-3">

                    Lihat Analisis AI

                </a>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="grid grid-cols-2 gap-8 mt-8">

            {{-- Produk Terlaris --}}
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-2xl font-bold mb-5">

                    Produk Terlaris

                </h2>

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="text-left pb-3">

                                Produk

                            </th>

                            <th>

                                Terjual

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($produkTerlaris as $produk)

                        <tr class="border-b">

                            <td class="py-3">

                                {{ $produk->nama_produk }}

                            </td>

                            <td class="text-center">

                                {{ $produk->total }}

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- Stock Menipis --}}
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-2xl font-bold mb-5">

                    Produk Hampir Habis

                </h2>

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="text-left pb-3">

                                Produk

                            </th>

                            <th>

                                Stock

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($stokMenipis as $produk)

                        <tr class="border-b">

                            <td class="py-3">

                                {{ $produk->nama_produk }}

                            </td>

                            <td class="text-center text-red-500 font-bold">

                                {{ $produk->stock }}

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @endsection