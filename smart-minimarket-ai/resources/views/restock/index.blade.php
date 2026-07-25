@extends('layouts.kasir')

@section('content')

<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6">
        AI Rekomendasi Restock
    </h1>

    <div class="bg-white rounded-xl shadow overflow-x-auto">

        <table class="w-full">

            <thead class="bg-yellow-400">

                <tr>

                    <th class="p-4 text-left">
                        Produk
                    </th>

                    <th>
                        Kategori
                    </th>

                    <th>
                        Stock
                    </th>

                    <th>
                        Minimum
                    </th>

                    <th>
                        Terjual
                    </th>

                    <th>
                        Score
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Detail Fuzzy
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($products as $product)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 font-semibold">

                        {{ $product->nama_produk }}

                    </td>

                    <td class="text-center">

                        {{ $product->category->nama_kategori }}

                    </td>

                    <td class="text-center">

                        {{ $product->stock }}

                    </td>

                    <td class="text-center">

                        {{ $product->minimum_stock }}

                    </td>

                    <td class="text-center">

                        {{ $product->penjualan }}

                    </td>

                    <td class="text-center font-bold">

                        {{ $product->score }}

                    </td>

                    <td class="text-center">

                        @if($product->status == 'Segera Restock')

                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full font-semibold">

                                🔴 {{ $product->status }}

                            </span>

                        @elseif($product->status == 'Perlu Dipantau')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-semibold">

                                🟡 {{ $product->status }}

                            </span>

                        @else

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">

                                🟢 {{ $product->status }}

                            </span>

                        @endif

                    </td>

                    <td class="text-xs p-3">

                        <div class="space-y-2">

                            <div>

                                <b>Stock</b><br>

                                Sedikit :
                                {{ $product->membership['stock']['sedikit'] }}<br>

                                Sedang :
                                {{ $product->membership['stock']['sedang'] }}<br>

                                Banyak :
                                {{ $product->membership['stock']['banyak'] }}

                            </div>

                            <hr>

                            <div>

                                <b>Penjualan</b><br>

                                Rendah :
                                {{ $product->membership['penjualan']['rendah'] }}<br>

                                Sedang :
                                {{ $product->membership['penjualan']['sedang'] }}<br>

                                Tinggi :
                                {{ $product->membership['penjualan']['tinggi'] }}

                            </div>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection