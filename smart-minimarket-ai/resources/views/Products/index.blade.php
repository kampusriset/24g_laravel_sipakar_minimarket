@extends('layouts.dashboard')

@section('dashboard-content')

<div class="min-h-screen bg-gray-100 p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Produk
            </h1>

            <p class="text-gray-500 mt-1">
                Daftar produk dan informasi stock
            </p>
        </div>

    </div>


    {{-- STATISTIC CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- TOTAL PRODUK --}}
        <div class="bg-white rounded-2xl shadow-md border p-6">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-100
                            flex items-center justify-center">

                    <span class="text-2xl">
                        📦
                    </span>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Total Produk
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $totalProduk }}
                    </h2>

                </div>

            </div>

        </div>


        {{-- STOCK AMAN --}}
        <div class="bg-white rounded-2xl shadow-md border p-6">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-green-100
                            flex items-center justify-center">

                    <span class="text-2xl">
                        ✓
                    </span>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Stock Aman
                    </p>

                    <h2 class="text-2xl font-bold text-green-600">
                        {{ $stockAman }}
                    </h2>

                </div>

            </div>

        </div>


        {{-- STOCK MENIPIS --}}
        <div class="bg-white rounded-2xl shadow-md border p-6">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-red-100
                            flex items-center justify-center">

                    <span class="text-2xl">
                        ⚠️
                    </span>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Stock Menipis
                    </p>

                    <h2 class="text-2xl font-bold text-red-500">
                        {{ $stockMenipis }}
                    </h2>

                </div>

            </div>

        </div>

    </div>


    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl shadow-md border">

        {{-- SEARCH & FILTER --}}
        <div class="p-6 border-b">

            <form
                action="{{ route('products.index') }}"
                method="GET"
                class="flex flex-col lg:flex-row gap-4"
            >

                {{-- SEARCH --}}
                <div class="flex-1">

                    <label class="block text-sm font-medium
                                  text-gray-600 mb-2">

                        Cari Produk

                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau kode produk..."

                        class="w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-4 py-3"
                    >

                </div>


                {{-- KATEGORI --}}
                <div class="lg:w-64">

                    <label class="block text-sm font-medium
                                  text-gray-600 mb-2">

                        Kategori

                    </label>

                    <select
                        name="kategori"

                        class="w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-4 py-3"
                    >

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(request('kategori') == $category->id)
                            >

                                {{ $category->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="flex items-end">

                    <button
                        type="submit"

                        class="w-full lg:w-auto
                               bg-blue-600
                               hover:bg-blue-700
                               text-white
                               px-6 py-3
                               rounded-xl
                               font-semibold
                               transition"
                    >

                        Cari

                    </button>

                </div>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">

                            Kode

                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">

                            Produk

                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">

                            Kategori

                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">

                            Harga

                        </th>

                        <th class="px-6 py-4 text-center text-sm
                                   font-semibold text-gray-600">

                            Stock

                        </th>

                        <th class="px-6 py-4 text-center text-sm
                                   font-semibold text-gray-600">

                            Status

                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($products as $product)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- KODE --}}
                            <td class="px-6 py-4">

                                <span class="font-medium text-gray-700">

                                    {{ $product->kode_produk }}

                                </span>

                            </td>


                            {{-- PRODUK --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    @if($product->gambar)

                                        <img
                                            src="{{ asset('storage/' . $product->gambar) }}"
                                            alt="{{ $product->nama_produk }}"

                                            class="w-10 h-10 rounded-lg
                                                   object-cover"
                                        >

                                    @else

                                        <div class="w-10 h-10 rounded-lg
                                                    bg-gray-100
                                                    flex items-center
                                                    justify-center">

                                            📦

                                        </div>

                                    @endif

                                    <div>

                                        <p class="font-semibold text-gray-800">

                                            {{ $product->nama_produk }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- KATEGORI --}}
                            <td class="px-6 py-4">

                                <span
                                    class="px-3 py-1 rounded-full
                                           bg-blue-100
                                           text-blue-700
                                           text-xs font-semibold"
                                >

                                    {{ $product->category->nama_kategori ?? '-' }}

                                </span>

                            </td>


                            {{-- HARGA --}}
                            <td class="px-6 py-4">

                                <span class="font-medium text-gray-800">

                                    Rp
                                    {{ number_format(
                                        $product->harga_jual,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </td>


                            {{-- STOCK --}}
                            <td class="px-6 py-4 text-center">

                                <span class="font-bold
                                    {{ $product->stock <= $product->minimum_stock
                                        ? 'text-red-500'
                                        : 'text-gray-800' }}"
                                >

                                    {{ $product->stock }}

                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-6 py-4 text-center">

                                @if($product->stock <= $product->minimum_stock)

                                    <span
                                        class="inline-flex
                                               items-center
                                               px-3 py-1
                                               rounded-full
                                               bg-red-100
                                               text-red-600
                                               text-xs
                                               font-semibold"
                                    >

                                        Stock Menipis

                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               items-center
                                               px-3 py-1
                                               rounded-full
                                               bg-green-100
                                               text-green-600
                                               text-xs
                                               font-semibold"
                                    >

                                        Stock Aman

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-4xl mb-3">
                                    📦
                                </div>

                                <h3 class="text-lg font-semibold
                                           text-gray-700">

                                    Produk tidak ditemukan

                                </h3>

                                <p class="text-gray-500 mt-1">

                                    Coba gunakan kata pencarian
                                    atau kategori lain.

                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($products->hasPages())

            <div class="px-6 py-5 border-t">

                {{ $products->links() }}

            </div>

        @endif

    </div>

</div>

@endsection