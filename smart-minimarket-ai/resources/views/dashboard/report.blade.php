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
        

        {{-- CARD --}}
        <div class="grid grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Total Penjualan
                </p>

                <h2 class="text-3xl font-bold mt-3">

                    Rp {{ number_format($totalPenjualan,0,',','.') }}

                </h2>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Total Transaksi
                </p>

                <h2 class="text-3xl font-bold mt-3">

                    {{ $totalTransaksi }}

                </h2>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Total Produk
                </p>

                <h2 class="text-3xl font-bold mt-3">

                    {{ $totalProduk }}

                </h2>

            </div>

            <div class="bg-white rounded-2xl shadow p-6">

                <p class="text-gray-500">
                    Stock Menipis
                </p>

                <h2 class="text-3xl font-bold mt-3 text-red-500">

                    {{ $stokMenipis->count() }}

                </h2>

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