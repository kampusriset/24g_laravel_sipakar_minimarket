    @extends('layouts.dashboard')

    @section('dashboard-content')


    {{-- ================= CARD UTAMA ================= --}}
    <div class="grid grid-cols-12 gap-6 mb-8">

        {{-- TOTAL PENJUALAN --}}
        <div class="col-span-3 bg-white rounded-2xl shadow-md border
        hover:shadow-xl transition p-6 overflow-hidden">

            <div class="flex items-start gap-4">

                <div class="w-12 h-12 shrink-0 rounded-xl bg-green-600
                        flex items-center justify-center text-white text-xl">
                    💰
                </div>

                <div class="min-w-0">

                    <p class="text-gray-500 text-sm">
                        Total Penjualan
                    </p>

                    <h2 class="text-xl font-bold mt-4 whitespace-nowrap">
                        Rp {{ number_format($totalPenjualan,0,',','.') }}
                    </h2>

                </div>

            </div>

        </div>


        {{-- TOTAL TRANSAKSI --}}
        <div class="col-span-3 bg-white rounded-2xl shadow-md border
                hover:shadow-xl transition p-6">

            <div class="flex items-start gap-4">

                <div class="w-12 h-12 shrink-0 rounded-xl bg-blue-600
                        flex items-center justify-center text-white text-xl">
                    🧾
                </div>

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Transaksi
                    </p>

                    <h2 class="text-3xl font-bold mt-4">

                        {{ $totalTransaksi }}

                    </h2>

                </div>

            </div>

        </div>


        {{-- PRODUK HAMPIR HABIS --}}
        <div class="col-span-6 bg-white rounded-2xl shadow-md border
                hover:shadow-xl transition overflow-hidden">

            {{-- Header --}}
            <div class="bg-yellow-400 px-6 py-3 inline-block
                    rounded-br-xl">

                <h2 class="font-bold text-lg text-gray-900">
                    Produk Hampir Habis
                </h2>

            </div>


            {{-- List Produk --}}
            <div class="px-6 py-3">

                @forelse($stokMenipis->take(5) as $produk)

                <div class="flex justify-between items-center
                            py-3 border-b last:border-b-0">

                    <span class="text-gray-800">
                        {{ $produk->nama_produk }}
                    </span>

                    <span class="font-bold text-red-500">
                        {{ $produk->stock }}
                    </span>

                </div>

                @empty

                <div class="py-6 text-center text-gray-500">
                    Tidak ada produk yang hampir habis.
                </div>

                @endforelse

            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

        {{-- Grafik --}}
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-md border p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">
                    Trend Penjualan 7 Hari Terakhir
                </h2>
            </div>

            <div class="relative h-[350px]">
                <canvas id="salesTrendChart"></canvas>
            </div>

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

    <<script>

        window.salesChartLabels = {{ Js::from($chartLabels) }};

        window.salesChartData = {{ Js::from($chartData) }};

        </script>




        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite('resources/js/dashboard.js')

        @endsection