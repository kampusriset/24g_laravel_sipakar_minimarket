<div id="detailModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4">

        {{-- Header --}}
        <div class="flex justify-between items-center border-b p-6">

            <h2 class="text-2xl font-bold text-gray-800">
                Detail Perhitungan AI Fuzzy
            </h2>

            <button
                id="btnCloseModal"
                class="text-3xl font-bold text-gray-500 hover:text-red-600">

                &times;

            </button>

        </div>

        {{-- Body --}}
        <div class="p-6 space-y-6">

            {{-- Informasi Produk --}}
            <div class="grid grid-cols-2 gap-6">

                <div>

                    <p class="mb-2">
                        <span class="font-semibold">Produk :</span>
                        <span id="namaProduk"></span>
                    </p>

                    <p class="mb-2">
                        <span class="font-semibold">Kategori :</span>
                        <span id="kategoriProduk"></span>
                    </p>

                    <p class="mb-2">
                        <span class="font-semibold">Stock :</span>
                        <span id="stock"></span>
                    </p>

                    <p class="mb-2">
                        <span class="font-semibold">Minimum Stock :</span>
                        <span id="minimum"></span>
                    </p>

                    <p>
                        <span class="font-semibold">Terjual :</span>
                        <span id="penjualan"></span>
                    </p>

                </div>

                <div>

                    <div class="bg-blue-50 rounded-xl p-4">

                        <p class="mb-3">

                            <span class="font-semibold">
                                Score AI :
                            </span>

                            <span
                                id="score"
                                class="font-bold text-xl">
                            </span>

                        </p>

                        <p>

                            <span class="font-semibold">
                                Status :
                            </span>

                            <span id="status"></span>

                        </p>

                    </div>

                </div>

            </div>

            <hr>

            {{-- Membership --}}
            <div class="grid grid-cols-2 gap-6">

                <div class="bg-gray-50 rounded-xl p-5">

                    <h3 class="font-bold text-blue-600 mb-4">
                        Membership Stock
                    </h3>

                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Sedikit</span>
                            <span id="stockSedikit"></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                id="barStockSedikit"
                                class="bg-red-500 h-3 rounded-full transition-all duration-700"
                                style="width:0%">
                            </div>
                        </div>

                    </div>

                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Sedang</span>
                            <span id="stockSedang"></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                id="barStockSedang"
                                class="bg-yellow-500 h-3 rounded-full transition-all duration-700"
                                style="width:0%">
                            </div>
                        </div>

                    </div>

                    <div>

                        <div class="flex justify-between mb-1">
                            <span>Banyak</span>
                            <span id="stockBanyak"></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                id="barStockBanyak"
                                class="bg-green-500 h-3 rounded-full transition-all duration-700"
                                style="width:0%">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="bg-gray-50 rounded-xl p-5">

                    <h3 class="font-bold text-green-600 mb-4">
                        Membership Penjualan
                    </h3>

                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Rendah</span>
                            <span id="jualRendah"></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                id="barJualRendah"
                                class="bg-blue-500 h-3 rounded-full transition-all duration-700"
                                style="width:0%">
                            </div>
                        </div>

                    </div>

                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Sedang</span>
                            <span id="jualSedang"></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                id="barJualSedang"
                                class="bg-yellow-500 h-3 rounded-full transition-all duration-700"
                                style="width:0%">
                            </div>
                        </div>

                    </div>

                    <div>

                        <div class="flex justify-between mb-1">
                            <span>Tinggi</span>
                            <span id="jualTinggi"></span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div
                                id="barJualTinggi"
                                class="bg-red-500 h-3 rounded-full transition-all duration-700"
                                style="width:0%">
                            </div>
                        </div>

                    </div>

                </div>

                {{-- Kesimpulan --}}
                <div
                    class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-5">

                    <h3 class="font-bold mb-3">

                        Kesimpulan AI

                    </h3>

                    <div class="bg-gray-100 rounded-xl p-4 mb-4">

                        <h4 class="font-bold text-blue-700 mb-2">

                            Rule Fuzzy Aktif

                        </h4>

                        <pre
                            id="ruleAI"
                            class="text-sm whitespace-pre-wrap font-mono text-gray-700">
                    </pre>

                    </div>

                    <p
                        id="kesimpulanAI"
                        class="leading-7 text-gray-700">

                    </p>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t p-5 flex justify-end">

                <button
                    id="btnTutup"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg">

                    Tutup

                </button>

            </div>

        </div>

    </div>