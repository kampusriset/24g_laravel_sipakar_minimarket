<div id="detailModal"
    class="fixed inset-0 z-50 hidden bg-black/60 overflow-y-auto">

    <div class="min-h-screen flex items-center justify-center p-3 md:p-6">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl">

            {{-- Header --}}
            <div class="flex justify-between items-center border-b p-4 md:p-6">

                <h2 class="text-lg md:text-2xl font-bold text-gray-800">
                    Detail Perhitungan AI Fuzzy
                </h2>

                <button
                    id="btnCloseModal"
                    class="text-3xl font-bold text-gray-500 hover:text-red-600">

                    &times;

                </button>

            </div>

            {{-- Body --}}
            <div class="p-4 md:p-6 space-y-6 max-h-[80vh] overflow-y-auto">

                {{-- Informasi Produk --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="bg-gray-50 rounded-xl p-5">

                        <h3 class="font-bold text-blue-600 mb-4">
                            Informasi Produk
                        </h3>

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
                            <span class="font-semibold">Rata-rata Penjualan :</span>
                            <span id="rataPenjualan"></span>
                        </p>

                    </div>

                    <div class="bg-blue-50 rounded-xl p-5">

                        <h3 class="font-bold text-blue-700 mb-4">
                            Hasil AI
                        </h3>

                        <p class="mb-4">

                            <span class="font-semibold">
                                Score AI :
                            </span>

                            <span
                                id="score"
                                class="font-bold text-xl text-red-600">
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

                {{-- Membership --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    {{-- Stock --}}
                    <div class="bg-gray-50 rounded-xl p-5">

                        <h3 class="font-bold text-blue-600 mb-5">

                            Membership Stock

                        </h3>

                        <div class="space-y-4">

                            <div>

                                <div class="flex justify-between mb-1">

                                    <span>Sedikit</span>

                                    <span id="stockSedikit"></span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">

                                    <div
                                        id="barStockSedikit"
                                        class="bg-red-500 h-2 md:h-3 rounded-full transition-all duration-700"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                            <div>

                                <div class="flex justify-between mb-1">

                                    <span>Sedang</span>

                                    <span id="stockSedang"></span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">

                                    <div
                                        id="barStockSedang"
                                        class="bg-yellow-500 h-2 md:h-3 rounded-full transition-all duration-700"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                            <div>

                                <div class="flex justify-between mb-1">

                                    <span>Banyak</span>

                                    <span id="stockBanyak"></span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">

                                    <div
                                        id="barStockBanyak"
                                        class="bg-green-500 h-2 md:h-3 rounded-full transition-all duration-700"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Penjualan --}}
                    <div class="bg-gray-50 rounded-xl p-5">

                        <h3 class="font-bold text-green-600 mb-5">

                            Membership Penjualan

                        </h3>

                        <div class="space-y-4">

                            <div>

                                <div class="flex justify-between mb-1">

                                    <span>Rendah</span>

                                    <span id="jualRendah"></span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">

                                    <div
                                        id="barJualRendah"
                                        class="bg-blue-500 h-2 md:h-3 rounded-full transition-all duration-700"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                            <div>

                                <div class="flex justify-between mb-1">

                                    <span>Sedang</span>

                                    <span id="jualSedang"></span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">

                                    <div
                                        id="barJualSedang"
                                        class="bg-yellow-500 h-2 md:h-3 rounded-full transition-all duration-700"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                            <div>

                                <div class="flex justify-between mb-1">

                                    <span>Tinggi</span>

                                    <span id="jualTinggi"></span>

                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2 md:h-3">

                                    <div
                                        id="barJualTinggi"
                                        class="bg-red-500 h-2 md:h-3 rounded-full transition-all duration-700"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Lead Time --}}
                    <div class="bg-gray-50 rounded-xl p-5">

                        <h3 class="font-bold text-purple-600 mb-5">

                            Membership Lead Time

                        </h3>

                        <p class="mb-2">

                            Cepat :
                            <span id="leadCepat"></span>

                        </p>

                        <p class="mb-2">

                            Sedang :
                            <span id="leadSedang"></span>

                        </p>

                        <p>

                            Lama :
                            <span id="leadLama"></span>

                        </p>

                    </div>

                </div>

                {{-- Rule Aktif --}}
                <div class="bg-blue-50 rounded-xl p-5">

                    <h3 class="font-bold text-blue-700 mb-4">

                        Rule Mamdani Aktif

                    </h3>

                    <div
                        id="ruleContainer"
                        class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    </div>

                </div>

                {{-- Kesimpulan --}}
                <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-xl p-5">

                    <h3 class="font-bold mb-3">

                        Kesimpulan AI

                    </h3>

                    <div class="bg-white rounded-lg p-4 mb-4">

                        <h4 class="font-semibold text-blue-700 mb-2">

                            Rule Dominan

                        </h4>

                        <pre
                            id="ruleAI"
                            class="text-sm whitespace-pre-wrap font-mono text-gray-700"></pre>

                    </div>

                    <p
                        id="kesimpulanAI"
                        class="leading-7 text-gray-700">

                    </p>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t p-4 md:p-5 flex justify-end">

                <button
                    id="btnTutup"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>