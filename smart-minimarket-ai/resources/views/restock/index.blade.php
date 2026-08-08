@extends('layouts.dashboard')

@section('title', 'Smart Restock AI')

@section('page-title', 'Smart Restock AI')

@section('page-description', 'Analisis dan rekomendasi stok produk')

@section('dashboard-content')

<div
    x-data="restockPage()"
    class="space-y-6">


    {{-- =========================================================
        RINGKASAN AI
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- Segera Restock --}}
        <div class="rounded-2xl border border-red-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Segera Restock
                    </p>

                    <p class="mt-2 text-3xl font-bold text-red-500">
                        {{ $jumlahRestock }}
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-red-100 text-2xl">
                    🔴
                </div>

            </div>

            <p class="mt-3 text-xs text-gray-400">
                Produk dengan prioritas tertinggi
            </p>

        </div>


        {{-- Perlu Dipantau --}}
        <div class="rounded-2xl border border-yellow-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Perlu Dipantau
                    </p>

                    <p class="mt-2 text-3xl font-bold text-yellow-500">
                        {{ $jumlahPantau }}
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-yellow-100 text-2xl">
                    🟡
                </div>

            </div>

            <p class="mt-3 text-xs text-gray-400">
                Produk yang perlu diperhatikan
            </p>

        </div>


        {{-- Stock Aman --}}
        <div class="rounded-2xl border border-green-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Stock Aman
                    </p>

                    <p class="mt-2 text-3xl font-bold text-green-600">
                        {{ $jumlahAman }}
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-green-100 text-2xl">
                    🟢
                </div>

            </div>

            <p class="mt-3 text-xs text-gray-400">
                Produk dengan kondisi stok aman
            </p>

        </div>

    </div>


    {{-- =========================================================
        TABEL RESTOCK
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        {{-- Header tabel --}}
        <div class="border-b border-gray-200 px-6 py-5">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <h2 class="text-xl font-bold text-gray-900">
                        Prioritas Restock
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Daftar produk berdasarkan score AI tertinggi.
                    </p>

                </div>

                <div class="rounded-xl bg-blue-50 px-4 py-2">

                    <span class="text-sm font-semibold text-blue-700">
                        {{ $products->count() }} Produk
                    </span>

                </div>

            </div>

        </div>


        {{-- Scroll hanya pada tabel --}}
        <div class="w-full overflow-x-auto">

            <table class="min-w-[1200px] w-full">

                <thead>

                    <tr class="bg-yellow-400 text-left text-sm font-bold text-gray-900">

                        <th class="px-5 py-4 text-center">
                            Ranking
                        </th>

                        <th class="px-5 py-4">
                            Produk
                        </th>

                        <th class="px-5 py-4">
                            Kategori
                        </th>

                        <th class="px-5 py-4 text-center">
                            Stock
                        </th>

                        <th class="px-5 py-4 text-center">
                            Minimum
                        </th>

                        <th class="px-5 py-4 text-center">
                            Rata Penjualan/Minggu
                        </th>

                        <th class="px-5 py-4 text-center">
                            Score AI
                        </th>

                        <th class="px-5 py-4 text-center">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($products as $index => $product)

                    <tr class="transition hover:bg-gray-50">

                        {{-- Ranking --}}
                        <td class="px-5 py-4 text-center">

                            @if($index === 0)

                            <span class="text-2xl">
                                🥇
                            </span>

                            @elseif($index === 1)

                            <span class="text-2xl">
                                🥈
                            </span>

                            @elseif($index === 2)

                            <span class="text-2xl">
                                🥉
                            </span>

                            @else

                            <span class="font-semibold text-gray-500">
                                {{ $index + 1 }}
                            </span>

                            @endif

                        </td>


                        {{-- Produk --}}
                        <td class="px-5 py-4">

                            <div class="font-semibold text-gray-900">
                                {{ $product->nama_produk }}
                            </div>

                        </td>


                        {{-- Kategori --}}
                        <td class="px-5 py-4 text-gray-600">

                            {{ $product->category->nama_kategori ?? '-' }}

                        </td>


                        {{-- Stock --}}
                        <td class="px-5 py-4 text-center">

                            <span
                                class="
                                    inline-flex min-w-[45px]
                                    justify-center rounded-lg px-3 py-1
                                    font-semibold

                                    {{ $product->stock <= $product->minimum_stock
                                        ? 'bg-red-100 text-red-600'
                                        : 'bg-gray-100 text-gray-700'
                                    }}
                                ">
                                {{ $product->stock }}
                            </span>

                        </td>


                        {{-- Minimum --}}
                        <td class="px-5 py-4 text-center font-medium">

                            {{ $product->minimum_stock }}

                        </td>


                        {{-- Rata Penjualan --}}
                        <td class="px-5 py-4 text-center">

                            {{ number_format($product->rata_penjualan, 2, ',', '.') }}

                        </td>


                        {{-- Score --}}
                        <td class="px-5 py-4 text-center">

                            <span
                                class="
                                    inline-flex min-w-[55px]
                                    justify-center rounded-xl px-3 py-2
                                    font-bold

                                    @if($product->score >= 80)
                                        bg-red-100 text-red-600
                                    @elseif($product->score >= 50)
                                        bg-yellow-100 text-yellow-600
                                    @else
                                        bg-green-100 text-green-600
                                    @endif
                                ">
                                {{ number_format($product->score, 0) }}
                            </span>

                        </td>


                        {{-- Status --}}
                        <td class="px-5 py-4 text-center">

                            @if($product->status === 'Segera Restock')

                            <span class="inline-flex items-center gap-2
                                             rounded-full bg-red-100 px-4 py-2
                                             text-sm font-semibold text-red-600">

                                <span class="h-3 w-3 rounded-full bg-red-500"></span>

                                Segera Restock

                            </span>

                            @elseif($product->status === 'Perlu Dipantau')

                            <span class="inline-flex items-center gap-2
                                             rounded-full bg-yellow-100 px-4 py-2
                                             text-sm font-semibold text-yellow-700">

                                <span class="h-3 w-3 rounded-full bg-yellow-400"></span>

                                Perlu Dipantau

                            </span>

                            @else

                            <span class="inline-flex items-center gap-2
                                             rounded-full bg-green-100 px-4 py-2
                                             text-sm font-semibold text-green-600">

                                <span class="h-3 w-3 rounded-full bg-green-500"></span>

                                Stock Aman

                            </span>

                            @endif

                        </td>


                        {{-- Aksi --}}
                        <td class="px-5 py-4 text-center">

                            <button
                                type="button"
                                @click="openDetail({{ $index }})"
                                class="rounded-xl bg-blue-600 px-4 py-2.5
                                       text-sm font-semibold text-white
                                       transition hover:bg-blue-700">
                                Detail AI
                            </button>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="9"
                            class="px-6 py-12 text-center text-gray-500">
                            Belum ada data produk.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================================
    MODAL DETAIL AI
========================================================== --}}
<div
    x-show="showModal"
    x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center
           bg-black/50 p-4"
    @keydown.escape.window="closeDetail()">

    <div
        x-show="showModal"
        x-transition
        @click.outside="closeDetail()"
        class="max-h-[90vh] w-full max-w-5xl overflow-y-auto
               rounded-2xl bg-white shadow-2xl">

        {{-- Header Modal --}}
        <div class="sticky top-0 z-10 flex items-center justify-between
                    border-b bg-white px-6 py-5">

            <div>

                <p class="text-sm font-medium text-blue-600">
                    ANALISIS FUZZY AI
                </p>

                <h2
                    class="mt-1 text-2xl font-bold text-gray-900"
                    x-text="selected?.nama"></h2>

            </div>

            <button
                type="button"
                @click="closeDetail()"
                class="flex h-10 w-10 items-center justify-center
                       rounded-full bg-gray-100 text-xl
                       hover:bg-gray-200">
                ×
            </button>

        </div>


        <div class="space-y-6 p-6">

            {{-- Input Utama --}}
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                <div class="rounded-xl bg-gray-50 p-4">

                    <p class="text-xs text-gray-500">
                        Stock Saat Ini
                    </p>

                    <p
                        class="mt-2 text-2xl font-bold"
                        x-text="selected?.stock"></p>

                </div>


                <div class="rounded-xl bg-gray-50 p-4">

                    <p class="text-xs text-gray-500">
                        Minimum Stock
                    </p>

                    <p
                        class="mt-2 text-2xl font-bold"
                        x-text="selected?.minimum"></p>

                </div>


                <div class="rounded-xl bg-gray-50 p-4">

                    <p class="text-xs text-gray-500">
                        Rata Penjualan/Minggu
                    </p>

                    <p
                        class="mt-2 text-2xl font-bold"
                        x-text="selected?.rataPenjualan"></p>

                </div>


                <div class="rounded-xl bg-blue-50 p-4">

                    <p class="text-xs text-blue-600">
                        Lead Time Supplier
                    </p>

                    <p
                        class="mt-2 text-2xl font-bold text-blue-700">
                        <span x-text="selected?.leadTime"></span>
                        <span class="text-sm font-medium">
                            hari
                        </span>
                    </p>

                </div>

            </div>


            {{-- Score --}}
            <div class="rounded-2xl border border-gray-200 p-5">

                <div class="flex flex-wrap items-center justify-between gap-4">

                    <div>

                        <p class="text-sm text-gray-500">
                            Score AI
                        </p>

                        <p
                            class="mt-1 text-4xl font-bold"
                            :class="{
                                'text-red-500': selected?.score >= 80,
                                'text-yellow-500': selected?.score >= 50 && selected?.score < 80,
                                'text-green-600': selected?.score < 50
                            }"
                            x-text="selected?.score"></p>

                    </div>


                    <div>

                        <template x-if="selected?.status === 'Segera Restock'">

                            <span class="rounded-full bg-red-100 px-5 py-3
                                         font-bold text-red-600">
                                🔴 Segera Restock
                            </span>

                        </template>


                        <template x-if="selected?.status === 'Perlu Dipantau'">

                            <span class="rounded-full bg-yellow-100 px-5 py-3
                                         font-bold text-yellow-700">
                                🟡 Perlu Dipantau
                            </span>

                        </template>


                        <template x-if="selected?.status === 'Stock Aman'">

                            <span class="rounded-full bg-green-100 px-5 py-3
                                         font-bold text-green-600">
                                🟢 Stock Aman
                            </span>

                        </template>

                    </div>

                </div>

            </div>


            {{-- Membership --}}
            <div>

                <h3 class="mb-4 text-xl font-bold">
                    Hasil Fuzzifikasi
                </h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                    {{-- Stock --}}
                    <div class="rounded-2xl border p-5">

                        <h4 class="mb-4 font-bold">
                            Stock
                        </h4>

                        <div class="space-y-3">

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Sedikit
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.stockSedikit"></span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Sedang
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.stockSedang"></span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Banyak
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.stockBanyak"></span>

                            </div>

                        </div>

                    </div>


                    {{-- Penjualan --}}
                    <div class="rounded-2xl border p-5">

                        <h4 class="mb-4 font-bold">
                            Penjualan
                        </h4>

                        <div class="space-y-3">

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Rendah
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.jualRendah"></span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Sedang
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.jualSedang"></span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Tinggi
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.jualTinggi"></span>

                            </div>

                        </div>

                    </div>


                    {{-- Lead Time --}}
                    <div class="rounded-2xl border p-5">

                        <h4 class="mb-4 font-bold">
                            Lead Time
                        </h4>

                        <div class="space-y-3">

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Cepat
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.leadCepat"></span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Sedang
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.leadSedang"></span>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-gray-500">
                                    Lama
                                </span>

                                <span
                                    class="font-bold"
                                    x-text="selected?.leadLama"></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Rule --}}
            <div>

                <h3 class="mb-4 text-xl font-bold">
                    Inferensi Rule
                </h3>

                <div class="overflow-x-auto rounded-xl border">

                    <table class="min-w-[800px] w-full text-sm">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Rule
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Stock
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Penjualan
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Lead Time
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Alpha
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Hasil
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            <template
                                x-for="rule in (selected?.rule || [])"
                                :key="rule.nama">

                                <tr>

                                    <td
                                        class="px-4 py-3 font-semibold"
                                        x-text="rule.nama"></td>

                                    <td
                                        class="px-4 py-3"
                                        x-text="rule.stock"></td>

                                    <td
                                        class="px-4 py-3"
                                        x-text="rule.penjualan"></td>

                                    <td
                                        class="px-4 py-3"
                                        x-text="rule.leadTime"></td>

                                    <td
                                        class="px-4 py-3 text-center font-bold"
                                        x-text="rule.alpha"></td>

                                    <td class="px-4 py-3 text-center">

                                        <span
                                            class="rounded-full px-3 py-1 text-xs font-semibold"
                                            :class="{
                                                'bg-red-100 text-red-600': rule.status === 'Restock',
                                                'bg-yellow-100 text-yellow-700': rule.status === 'Pantau',
                                                'bg-green-100 text-green-600': rule.status === 'Aman'
                                            }"
                                            x-text="rule.status"></span>

                                    </td>

                                </tr>

                            </template>

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Rumus --}}
            <div class="rounded-2xl bg-blue-50 p-5">

                <h3 class="font-bold text-blue-900">
                    Metode Perhitungan
                </h3>

                <p class="mt-2 text-sm leading-6 text-blue-800">

                    Sistem menggunakan metode Fuzzy Mamdani dengan
                    operator MIN pada proses inferensi dan
                    metode weighted average pada proses defuzzifikasi.

                </p>

                <div class="mt-3 rounded-xl bg-white p-4 font-mono text-sm">

                    Score =
                    Σ (α × z) / Σ α

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex justify-end border-t bg-gray-50 px-6 py-4">

            <button
                type="button"
                @click="closeDetail()"
                class="rounded-xl bg-gray-800 px-5 py-2.5
                       font-semibold text-white
                       hover:bg-gray-900">
                Tutup
            </button>

        </div>

    </div>

</div>
{{-- =========================================================
    DATA FUZZY
========================================================== --}}

<div
    id="restock-data"
    data-fuzzy='@json($fuzzyData)'></div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

@endsection


<style>
    [x-cloak] {
        display: none !important;
    }
</style>
