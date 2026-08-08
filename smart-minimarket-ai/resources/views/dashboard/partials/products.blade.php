<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    <div class="bg-white rounded-2xl shadow border p-6">

        <h2 class="text-xl font-bold mb-5">

            🔥 Produk Terlaris

        </h2>

        @foreach($produkTerlaris as $produk)

            <div class="flex justify-between py-3 border-b">

                <span>{{ $produk->nama_produk }}</span>

                <span class="font-bold">

                    {{ $produk->total }} pcs

                </span>

            </div>

        @endforeach

    </div>

    <div class="bg-white rounded-2xl shadow border p-6">

        <h2 class="text-xl font-bold mb-5">

            ⚠ Produk Hampir Habis

        </h2>

        @foreach($stokMenipis as $produk)

            <div class="flex justify-between py-3 border-b">

                <span>{{ $produk->nama_produk }}</span>

                <span class="text-red-500 font-bold">

                    {{ $produk->stock }}

                </span>

            </div>

        @endforeach

    </div>

</div>  