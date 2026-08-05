<div class="bg-white rounded-xl shadow overflow-x-auto">

    <table class="w-full">

        <thead class="bg-yellow-400">

            <tr>

                <th class="text-center w-20">
                    Ranking
                </th>

                <th class="p-4 text-left">
                    Produk
                </th>

                <th class="text-center">
                    Kategori
                </th>

                <th class="text-center">
                    Stock
                </th>

                <th class="text-center">
                    Minimum
                </th>

                <th class="text-center">
                    Terjual
                </th>

                <th class="text-center">
                    Score AI
                </th>

                <th class="text-center">
                    Status
                </th>

                <th class="text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($products as $product)

            <tr class="border-b hover:bg-gray-50 @if($loop->iteration <=3) bg-red-50 @endif">

                <td class="text-center">

                    @if($loop->iteration == 1)

                    🥇

                    @elseif($loop->iteration == 2)

                    🥈

                    @elseif($loop->iteration == 3)

                    🥉

                    @else

                    {{ $loop->iteration }}

                    @endif

                </td>

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

                <td class="text-center">

                    @if($product->score >= 80)

                    <span class="font-bold text-red-600">

                        {{ $product->score }}

                    </span>

                    @elseif($product->score >= 40)

                    <span class="font-bold text-yellow-600">

                        {{ $product->score }}

                    </span>

                    @else

                    <span class="font-bold text-green-600">

                        {{ $product->score }}

                    </span>

                    @endif

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

                <td class="text-center">

                    <button
                        class="btn-detail bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition"
                        data-index="{{ $loop->index }}">

                        Detail AI

                    </button>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9" class="text-center py-10 text-gray-500">

                    Belum ada data produk.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>