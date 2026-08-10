@extends('layouts.dashboard')

@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('page-description', 'Ringkasan penjualan dan transaksi minimarket')

@section('dashboard-content')

{{-- ========================================================= --}}
{{-- EXPORT --}}
{{-- ========================================================= --}}

<div class="flex items-center gap-3 mb-5">

    <a
        href="{{ route('laporan.pdf') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-red-500 px-5 py-2.5
               text-sm font-semibold text-white shadow-sm
               transition hover:bg-red-600">

       
        PDF

    </a>


    <a
        href="{{ route('laporan.excel') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-5 py-2.5
               text-sm font-semibold text-white shadow-sm
               transition hover:bg-green-600">

        
        Excel

    </a>

</div>


{{-- ========================================================= --}}
{{-- FILTER --}}
{{-- ========================================================= --}}

<div class="mb-6 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

    <form
        method="GET"
        action="{{ route('laporan.index') }}"
        class="flex flex-wrap items-end gap-4">


        {{-- TANGGAL MULAI --}}
        <div>

            <label class="mb-1 block text-sm font-medium text-gray-600">
                Tanggal Mulai
            </label>

            <input
                type="date"
                name="tanggal_mulai"
                value="{{ request('tanggal_mulai') }}"
                class="h-11 w-44 rounded-xl border border-gray-300
                       bg-white px-4 text-sm
                       outline-none transition
                       focus:border-yellow-400
                       focus:ring-2 focus:ring-yellow-100">

        </div>


        {{-- TANGGAL AKHIR --}}
        <div>

            <label class="mb-1 block text-sm font-medium text-gray-600">
                Tanggal Akhir
            </label>

            <input
                type="date"
                name="tanggal_akhir"
                value="{{ request('tanggal_akhir') }}"
                class="h-11 w-44 rounded-xl border border-gray-300
                       bg-white px-4 text-sm
                       outline-none transition
                       focus:border-yellow-400
                       focus:ring-2 focus:ring-yellow-100">

        </div>


        {{-- TERAPKAN --}}
        <button
            type="submit"
            class="h-11 rounded-xl bg-yellow-400 px-6
                   text-sm font-semibold text-gray-900
                   transition hover:bg-yellow-500">

            Terapkan

        </button>


        {{-- RESET --}}
        <a
            href="{{ route('laporan.index') }}"
            class="inline-flex h-11 items-center rounded-xl
                   border border-gray-300 px-6
                   text-sm font-semibold text-gray-700
                   transition hover:bg-gray-50">

            Reset

        </a>

    </form>

</div>


{{-- ========================================================= --}}
{{-- RINGKASAN --}}
{{-- ========================================================= --}}

<div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-3">


    {{-- TOTAL PENJUALAN --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Total Penjualan
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">

            Rp {{ number_format(
                $totalPenjualan,
                0,
                ',',
                '.'
            ) }}

        </p>

    </div>


    {{-- TOTAL TRANSAKSI --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Total Transaksi
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">

            {{ $totalTransaksi }}

        </p>

    </div>


    {{-- BARANG TERJUAL --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

        <p class="text-sm text-gray-500">
            Barang Terjual
        </p>

        <p class="mt-2 text-3xl font-bold text-gray-900">

            {{ $totalBarang }}

        </p>

    </div>

</div>


{{-- ========================================================= --}}
{{-- DAFTAR TRANSAKSI --}}
{{-- ========================================================= --}}

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">


    {{-- HEADER TABLE --}}
    <div class="border-b border-gray-200 px-6 py-5">

        <h2 class="text-xl font-bold text-gray-900">
            Daftar Transaksi
        </h2>

        <p class="mt-1 text-sm text-gray-500">

            Periode
            {{ $startDate->format('d/m/Y') }}
            -
            {{ $endDate->format('d/m/Y') }}

        </p>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[1000px]">


            {{-- HEADER --}}
            <thead>

                <tr class="bg-yellow-400 text-left text-sm font-semibold text-gray-900">


                    <th class="px-5 py-4 text-center">
                        No
                    </th>


                    <th class="px-5 py-4">
                        Tanggal
                    </th>


                    <th class="px-5 py-4">
                        Invoice
                    </th>


                    <th class="px-5 py-4">
                        Kasir
                    </th>


                    <th class="px-5 py-4">
                        Nama Barang
                    </th>


                    <th class="px-5 py-4 text-center">
                        Jumlah
                    </th>


                    <th class="px-5 py-4 text-right">
                        Total
                    </th>


                    <th class="px-5 py-4 text-center">
                        Status
                    </th>

                </tr>

            </thead>


            {{-- BODY --}}
            <tbody class="divide-y divide-gray-100">

                @forelse($sales as $sale)

                    <tr class="transition hover:bg-gray-50">


                        {{-- NO --}}
                        <td class="px-5 py-4 text-center text-sm text-gray-600">

                            {{ $sales->firstItem() + $loop->index }}

                        </td>


                        {{-- TANGGAL --}}
                        <td class="px-5 py-4 text-sm text-gray-600">

                            {{ $sale->tanggal->format('d/m/Y H:i') }}

                        </td>


                        {{-- INVOICE --}}
                        <td class="px-5 py-4">

                            <span class="font-semibold text-gray-900">

                                {{ $sale->invoice_number }}

                            </span>

                        </td>


                        {{-- KASIR --}}
                        <td class="px-5 py-4 text-sm text-gray-600">

                            {{ $sale->user?->name ?? '-' }}

                        </td>


                        {{-- NAMA BARANG --}}
                        <td class="px-5 py-4">

                            <div class="space-y-1">

                                @forelse($sale->saleDetails as $detail)

                                    <div class="text-sm font-medium text-gray-900">

                                        {{ $detail->product?->nama_produk ?? '-' }}

                                    </div>

                                @empty

                                    <span class="text-sm text-gray-400">
                                        Tidak ada barang
                                    </span>

                                @endforelse

                            </div>

                        </td>


                        {{-- JUMLAH --}}
                        <td class="px-5 py-4 text-center">

                            <span class="inline-flex min-w-[40px] items-center justify-center
                                         rounded-lg bg-gray-100 px-3 py-1
                                         text-sm font-semibold text-gray-700">

                                {{ $sale->saleDetails->sum('qty') }}

                            </span>

                        </td>


                        {{-- TOTAL --}}
                        <td class="px-5 py-4 text-right">

                            <span class="font-semibold text-gray-900">

                                Rp {{ number_format(
                                    $sale->total_harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 py-4 text-center">

                            @if($sale->status === 'selesai')

                                <span
                                    class="inline-flex items-center rounded-full
                                           bg-green-100 px-3 py-1
                                           text-xs font-semibold text-green-700">

                                    Selesai

                                </span>

                            @elseif($sale->status === 'pending')

                                <span
                                    class="inline-flex items-center rounded-full
                                           bg-yellow-100 px-3 py-1
                                           text-xs font-semibold text-yellow-700">

                                    Pending

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center rounded-full
                                           bg-red-100 px-3 py-1
                                           text-xs font-semibold text-red-700">

                                    Dibatalkan

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-5 py-16 text-center">

                            <div class="text-gray-400">

                                <div class="text-4xl mb-3">
                                    📋
                                </div>

                                <p class="font-medium text-gray-500">
                                    Tidak ada transaksi
                                </p>

                                <p class="mt-1 text-sm">
                                    Tidak ada transaksi pada periode yang dipilih.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if($sales->hasPages())

        <div class="border-t border-gray-200 px-5 py-4">

            {{ $sales->links() }}

        </div>

    @endif

</div>

@endsection