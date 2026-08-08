<nav class="h-20 bg-[#f8f0e5] border-b border-gray-300 px-8 flex items-center justify-between">

    <div>

        {{-- Judul Menu --}}
        <h2 class="text-2xl font-bold text-gray-900">
            @yield('page-title', 'Dashboard')
        </h2>

        {{-- Deskripsi Menu --}}
        <p class="text-sm text-gray-500">
            @yield('page-description', 'Smart Minimarket AI')
        </p>

    </div>


    {{-- Bagian kanan --}}
    <div class="flex items-center gap-4">

        <a href="{{ route('kasir.index') }}"
            class="px-5 py-2.5 bg-yellow-400 hover:bg-yellow-500 rounded-xl font-semibold transition">

            Kasir

        </a>

        <div class="flex items-center gap-3">

            <div class="text-right">

                <p class="font-semibold text-sm">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-xs text-gray-500">
                    {{ auth()->user()->role }}
                </p>

            </div>

            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                👤
            </div>

        </div>

    </div>

</nav>