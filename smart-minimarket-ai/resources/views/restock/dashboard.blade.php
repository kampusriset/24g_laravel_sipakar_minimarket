{{-- Dashboard AI Restock --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Segera Restock --}}
    <div class="bg-red-500 text-white rounded-2xl shadow-lg p-6">

        <h2 class="text-lg font-semibold">
            🔴 Segera Restock
        </h2>

        <p class="text-5xl font-bold mt-5">
            {{ $jumlahRestock }}
        </p>

        <p class="mt-2 text-sm">
            Produk
        </p>

    </div>

    {{-- Perlu Dipantau --}}
    <div class="bg-yellow-400 rounded-2xl shadow-lg p-6">

        <h2 class="text-lg font-semibold">
            🟡 Perlu Dipantau
        </h2>

        <p class="text-5xl font-bold mt-5">
            {{ $jumlahPantau }}
        </p>

        <p class="mt-2 text-sm">
            Produk
        </p>

    </div>

    {{-- Stock Aman --}}
    <div class="bg-green-500 text-white rounded-2xl shadow-lg p-6">

        <h2 class="text-lg font-semibold">
            🟢 Stock Aman
        </h2>

        <p class="text-5xl font-bold mt-5">
            {{ $jumlahAman }}
        </p>

        <p class="mt-2 text-sm">
            Produk
        </p>

    </div>

</div>

{{-- Pie Chart --}}
<div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

    <h2 class="text-2xl font-bold mb-6">

        📊 Distribusi Status AI Restock

    </h2>

    <div class="flex justify-center">

        <canvas
            id="statusChart"
            width="350"
            height="350">
        </canvas>

    </div>

</div>

<div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

    <h2 class="text-2xl font-bold mb-6">

        📈 Top 10 Prioritas Restock

    </h2>

    <canvas id="priorityChart"></canvas>

</div>
<div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

    <h2 class="text-2xl font-bold mb-6">

        📈 Trend Penjualan

    </h2>

    <canvas id="trendChart"></canvas>

</div>