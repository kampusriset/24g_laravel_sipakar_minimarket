@extends('layouts.dashboard')

@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('page-description', 'Ringkasan penjualan dan transaksi minimarket')

@section('dashboard-content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Laporan Penjualan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Lihat transaksi berdasarkan periode dan unduh laporan.
            </p>
        </div>

        {{-- BUTTON EXPORT --}}
        <div class="flex flex-wrap gap-2">

            {{-- PDF --}}
            <a href="{{ route('laporan.pdf', request()->query()) }}"
               class="px-4 py-2.5 rounded-lg bg-red-500 hover:bg-red-600 text-white font-semibold transition">

                PDF

            </a>

            {{-- EXCEL --}}
            <a href="{{ route('laporan.excel', request()->query()) }}"
               class="px-4 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition">

                Excel

            </a>

        </div>

    </div>


    {{-- FILTER LAPORAN --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">

        <form method="GET"
              action="{{ route('laporan.index') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            {{-- TANGGAL MULAI --}}
            <div>

                <label for="start_date"
                       class="block text-sm font-semibold text-gray-700 mb-2">

                    Tanggal Mulai

                </label>

                <input
                    id="start_date"
                    type="date"
                    name="start_date"
                    value="{{ $startDate->format('Y-m-d') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >

            </div>


            {{-- TANGGAL AKHIR --}}
            <div>

                <label for="end_date"
                       class="block text-sm font-semibold text-gray-700 mb-2">

                    Tanggal Akhir

                </label>

                <input
                    id="end_date"
                    type="date"
                    name="end_date"
                    value="{{ $endDate->format('Y-m-d') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >

            </div>


            {{-- BUTTON FILTER --}}
            <button
                type="submit"
                class="w-full px-5 py-2.5 rounded-lg bg-yellow-400 hover:bg-yellow-500 font-semibold transition">

                Terapkan Filter

            </button>


            {{-- RESET --}}
            <a
                href="{{ route('laporan.index') }}"
                class="w-full text-center px-5 py-2.5 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 font-semibold transition">

                Reset

            </a>

        </form>

    </div>


    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">


        {{-- TOTAL PENJUALAN --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Total Penjualan
            </p>

            <p class="text-2xl font-bold text-gray-900 mt-2">

                Rp {{ number_format(
                    $summary['totalPenjualan'],
                    0,
                    ',',
                    '.'
                ) }}

            </p>

        </div>


        {{-- TOTAL TRANSAKSI --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Total Transaksi
            </p>

            <p class="text-2xl font-bold text-gray-900 mt-2">

                {{ number_format(
                    $summary['totalTransaksi'],
                    0,
                    ',',
                    '.'
                ) }}

            </p>

        </div>


        {{-- BARANG TERJUAL --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Barang Terjual
            </p>

            <p class="text-2xl font-bold text-gray-900 mt-2">

                {{ number_format(
                    $summary['totalBarang'],
                    0,
                    ',',
                    '.'
                ) }}

            </p>

        </div>

    </div>


    {{-- TABLE TRANSAKSI --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">


        {{-- TABLE HEADER --}}
        <div class="px-5 py-4 border-b border-gray-200">

            <h2 class="font-bold text-gray-900">
                Daftar Transaksi
            </h2>

            <p class="text-sm text-gray-500">

                Periode
                {{ $startDate->format('d/m/Y') }}
                -
                {{ $endDate->format('d/m/Y') }}

            </p>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-yellow-400">

                    <tr>

                        <th class="text-left p-4">
                            No
                        </th>

                        <th class="text-left p-4">
                            Tanggal
                        </th>

                        <th class="text-left p-4">
                            Invoice
                        </th>

                        <th class="text-left p-4">
                            Kasir
                        </th>

                        <th class="text-center p-4">
                            Barang
                        </th>

                        <th class="text-right p-4">
                            Total
                        </th>

                        <th class="text-center p-4">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($sales as $sale)

                        <tr class="border-b border-gray-100 hover:bg-gray-50">

                            {{-- NOMOR --}}
                            <td class="p-4">

                                {{ $sales->firstItem() + $loop->index }}

                            </td>


                            {{-- TANGGAL --}}
                            <td class="p-4">

                                {{ $sale->tanggal->format('d/m/Y H:i') }}

                            </td>


                            {{-- INVOICE --}}
                            <td class="p-4 font-semibold">

                                {{ $sale->invoice_number }}

                            </td>


                            {{-- KASIR --}}
                            <td class="p-4">

                                {{ $sale->user?->name ?? '-' }}

                            </td>


                            {{-- JUMLAH BARANG --}}
                            <td class="p-4 text-center">

                                {{ $sale->saleDetails->sum('qty') }}

                            </td>


                            {{-- TOTAL --}}
                            <td class="p-4 text-right font-semibold">

                                Rp {{ number_format(
                                    $sale->total_harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            {{-- STATUS --}}
                            <td class="p-4 text-center">

                                @if($sale->status === 'selesai')

                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        Selesai

                                    </span>

                                @elseif($sale->status === 'pending')

                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                        Pending

                                    </span>

                                @else

                                    <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                        Dibatalkan

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-12 text-gray-500">

                                Tidak ada transaksi pada periode yang dipilih.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($sales->hasPages())

            <div class="px-5 py-4 border-t border-gray-200">

                {{ $sales->links() }}

            </div>

        @endif

    </div>

</div>

@endsection