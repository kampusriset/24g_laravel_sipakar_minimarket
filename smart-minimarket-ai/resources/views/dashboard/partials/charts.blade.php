<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <div class="xl:col-span-2 bg-white rounded-2xl shadow border p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-bold">

                Trend Penjualan

            </h2>

        </div>

        <canvas id="salesChart"></canvas>

    </div>

    <div class="bg-white rounded-2xl shadow border p-6">

        <h2 class="font-bold text-xl mb-6">

            Ringkasan AI

        </h2>

        <div class="space-y-5">

            <div class="flex justify-between">

                <span>🔴 Segera Restock</span>

                <b>{{ $jumlahRestock }}</b>

            </div>

            <div class="flex justify-between">

                <span>🟡 Perlu Dipantau</span>

                <b>{{ $jumlahPantau }}</b>

            </div>

            <div class="flex justify-between">

                <span>🟢 Stock Aman</span>

                <b>{{ $jumlahAman }}</b>

            </div>

        </div>

        <hr class="my-6">

        <canvas id="pieChart"></canvas>

    </div>

</div>