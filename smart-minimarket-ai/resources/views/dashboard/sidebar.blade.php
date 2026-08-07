<aside class="fixed left-0 top-0 w-64 h-screen bg-[#FFF8EF] border-r">

    <div class="p-8">

        <h1 class="text-5xl font-bold">

            Mart<span class="text-yellow-400">In</span>

        </h1>

    </div>

    <nav class="px-5 space-y-7">

        <div>

            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-3">

                Menu Utama

            </h3>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-yellow-100">

                📊 Dashboard

            </a>

            <a href="{{ route('kasir.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-yellow-100">

                🛒 Transaksi

            </a>

        </div>

        <div>

            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-3">

                Menu Barang

            </h3>

            <a href="{{ route('restock.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-yellow-100">

                🤖 Restock AI

            </a>

            <a href="{{ route('products.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-yellow-100">

                📦 Produk

            </a>

            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-yellow-100">

                📂 Kategori

            </a>

        </div>

        <div>

            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-3">

                Laporan

            </h3>

            <a href="#"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-yellow-100">

                📄 Laporan

            </a>

        </div>

        <div>

            <h3 class="text-gray-500 text-sm font-semibold uppercase mb-3">

                Pengaturan

            </h3>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full text-left flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-100">

                    🚪 Keluar

                </button>

            </form>

        </div>

    </nav>

</aside>