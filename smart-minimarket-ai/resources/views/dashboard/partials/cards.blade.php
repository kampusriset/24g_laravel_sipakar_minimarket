<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    {{-- Penjualan --}}
    <div class="bg-white rounded-2xl p-6 shadow border hover:-translate-y-1 transition">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    Total Penjualan

                </p>

                <h2 class="text-3xl font-bold mt-3">

                    Rp {{ number_format($totalPenjualan,0,',','.') }}

                </h2>

            </div>

            <div class="w-14 h-14 rounded-xl bg-green-500 flex items-center justify-center text-white text-2xl">

                💰

            </div>

        </div>

    </div>

    {{-- Transaksi --}}
    <div class="bg-white rounded-2xl p-6 shadow border hover:-translate-y-1 transition">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    Total Transaksi

                </p>

                <h2 class="text-3xl font-bold mt-3">

                    {{ $totalTransaksi }}

                </h2>

            </div>

            <div class="w-14 h-14 rounded-xl bg-blue-500 flex items-center justify-center text-white text-2xl">

                🧾

            </div>

        </div>

    </div>

    {{-- Produk --}}
    <div class="bg-white rounded-2xl p-6 shadow border hover:-translate-y-1 transition">

        <div class="flex justify-between">

            <div>

                <p class="text-gray-500">

                    Total Produk

                </p>

                <h2 class="text-3xl font-bold mt-3">

                    {{ $totalProduk }}

                </h2>

            </div>

            <div class="w-14 h-14 rounded-xl bg-yellow-500 flex items-center justify-center text-white text-2xl">

                📦

            </div>

        </div>

    </div>

    {{-- AI --}}
    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl p-6 text-white shadow">

        <p>

            Smart AI

        </p>

        <h2 class="text-3xl font-bold mt-2">

            {{ $jumlahRestock }}

        </h2>

        <p class="mt-3">

            Produk Prioritas Restock

        </p>

    </div>

</div>