<aside class="w-64 h-screen bg-[#f8f0e5] border-r border-gray-400 flex flex-col">
    {{-- ================= LOGO ================= --}}
    <div class="px-6 pt-8 pb-6">

        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            Mart<span class="text-yellow-400">In</span>
        </h1>

    </div>


    {{-- ================= MENU ================= --}}
    <nav class="flex-1 px-5">

        {{-- MENU UTAMA --}}
        <div class="mb-6">

            <h3 class="text-sm font-bold text-gray-900 mb-2">
                menu utama
            </h3>


            {{-- Dashboard --}}
            <a href="{{ url('/dashboard') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition
                {{ request()->is('dashboard') ? 'bg-yellow-100 font-semibold' : '' }}">

                <span class="w-4 text-gray-400">
                    ▦
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- Kasir --}}
            <a href="{{ route('kasir.index') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition">

                <span class="w-4 text-gray-400">
                    🛒
                </span>

                <span>
                    Transaksi
                </span>

            </a>

        </div>


        {{-- MENU BARANG --}}
        <div class="mb-8">

            <h3 class="text-sm font-bold text-gray-900 mb-2">
                menu barang
            </h3>


            {{-- Riwayat Restock --}}
            <a href="{{ url('/history') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition">

                <span class="w-4 text-gray-400">
                    ◴
                </span>

                <span>
                    Riwayat_Restock
                </span>

            </a>


            {{-- Restock --}}
            <a href="{{ route('restock.index') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition
                {{ request()->is('restock*') ? 'bg-yellow-100 font-semibold' : '' }}">

                <span class="w-4 text-gray-400">
                    ◴
                </span>

                <span>
                    Restock
                </span>

            </a>


            {{-- Produk --}}
            <a href="{{ url('/produk.index') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition">

                <span class="w-4 text-gray-400">
                    ◆
                </span>

                <span>
                    Produk
                </span>

            </a>


            {{-- Kategori --}}
            <a href="{{ url('/kategori') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition">

                <span class="w-4 text-gray-400">
                    ▦
                </span>

                <span>
                    Kategori
                </span>

            </a>

        </div>


        {{-- LAPORAN --}}
        <div class="mb-8">

            <h3 class="text-sm font-bold text-gray-900 mb-2">
                Laporan
            </h3>

            <a href="{{ url('/laporan') }}"
                class="flex items-center gap-3 px-2 py-2 rounded-lg
                text-sm text-gray-800
                hover:bg-yellow-100 transition">

                <span class="w-4 text-gray-400">
                    ◈
                </span>

                <span>
                    Laporan
                </span>

            </a>

        </div>


        {{-- PENGATURAN --}}
        <div>

            <h3 class="text-sm font-bold text-gray-900 mb-2">
                Pengaturan
            </h3>

        </div>

    </nav>


    {{-- ================= LOGOUT ================= --}}
    <div class="px-5 pb-8">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-3 px-2 py-2
                text-sm text-red-500
                hover:bg-red-50 rounded-lg transition">

                <span class="w-4">
                    ↪
                </span>

                <span>
                    Keluar
                </span>

            </button>

        </form>

    </div>

</aside>