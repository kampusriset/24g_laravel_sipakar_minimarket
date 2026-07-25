@extends('layouts.kasir')

@section('content')

<div class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-[#F7F0E6] border-b shadow-sm">

        <div class="max-w-7xl mx-auto px-8 py-4 flex items-center justify-between">

            <div class="flex items-center gap-8">

                <h1 class="text-4xl font-extrabold">
                    Mart<span class="text-yellow-400">In</span>
                </h1>

                <select
                    id="kategoriFilter"
                    class="border rounded-lg px-4 py-2 bg-white">

                    <option value="">Semua Kategori</option>

                </select>

                <div class="relative">

                    <input
                        id="searchProduct"
                        type="text"
                        placeholder="Cari nama atau kode produk..."
                        autocomplete="off"
                        class="w-[520px] rounded-lg border px-5 py-2 focus:ring-2 focus:ring-yellow-400 outline-none">

                    <div
                        id="searchResult"
                        class="hidden absolute left-0 right-0 bg-white rounded-xl shadow-lg border mt-2 max-h-80 overflow-y-auto z-50">
                    </div>

                </div>

            </div>

            <div class="flex items-center gap-5">

                <button class="text-2xl">
                    🛒
                </button>

                <div class="font-semibold">

                    {{ auth()->user()->name }}

                </div>

            </div>

        </div>

    </nav>

    <div class="max-w-7xl mx-auto px-8 py-8">

        <div class="grid grid-cols-12 gap-8">

            {{-- ========================= --}}
            {{-- KERANJANG --}}
            {{-- ========================= --}}
            <div class="col-span-8">

                <h2 class="text-2xl font-bold mb-5">

                    Keranjang Belanja

                </h2>

                <div class="bg-white rounded-2xl shadow border">

                    <div
                        id="cartContainer"
                        class="p-6 min-h-[500px]">

                        <div class="text-center text-gray-400 py-32">

                            Belum ada produk.

                        </div>

                    </div>

                </div>

            </div>

            {{-- ========================= --}}
            {{-- SIDEBAR --}}
            {{-- ========================= --}}
            <div class="col-span-4">

                <div class="space-y-5 sticky top-5">

                    {{-- Invoice --}}
                    <div class="bg-white rounded-2xl shadow border p-5">

                        <div class="flex justify-between">

                            <span>No Invoice</span>

                            <span class="font-semibold">
                                {{ $invoice }}
                            </span>

                        </div>

                        <div class="flex justify-between mt-4">

                            <span>Kasir</span>

                            <span class="font-semibold">

                                {{ auth()->user()->name }}

                            </span>

                        </div>

                    </div>

                    {{-- Pembayaran --}}
                    <div class="bg-white rounded-2xl shadow border p-6">

                        <div class="flex justify-between mb-3">

                            <span>Total Barang</span>

                            <span id="totalItem">

                                0 Barang

                            </span>

                        </div>

                        <div class="flex justify-between mb-5">

                            <span>Total</span>

                            <span
                                id="totalHarga"
                                class="font-bold text-xl">

                                Rp 0

                            </span>

                        </div>

                        <hr>

                        <div class="mt-6">

                            <label class="font-semibold">

                                Jumlah Bayar

                            </label>

                            <input
                                id="cash"
                                type="number"
                                min="0"
                                step="1"
                                placeholder="Masukkan uang"
                                class="mt-2 w-full rounded-lg border px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">

                        </div>

                        <div class="flex justify-between mt-6">

                            <span>

                                Kembalian

                            </span>

                            <span
                                id="kembalian"
                                class="font-bold text-green-600">

                                Rp 0

                            </span>

                        </div>

                        <button
                            id="btnCheckout"
                            disabled
                            class="w-full mt-8 py-3 rounded-xl bg-gray-300 text-gray-500 font-bold cursor-not-allowed">

                            BELI

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection