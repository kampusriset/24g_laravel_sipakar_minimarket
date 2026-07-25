@extends('layouts.kasir')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Riwayat Transaksi
        </h1>

        <a href="{{ route('kasir.index') }}"
            class="bg-yellow-400 hover:bg-yellow-500 px-5 py-2 rounded-lg font-semibold">

            ← Kembali ke Kasir

        </a>

    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-yellow-400">

                <tr>

                    <th class="text-left p-4">Invoice</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($sales as $sale)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 font-semibold">

                        {{ $sale->invoice_number }}

                    </td>

                    <td class="text-center">

                        {{ \Carbon\Carbon::parse($sale->tanggal)->format('d/m/Y H:i') }}

                    </td>

                    <td class="text-center">

                        {{ $sale->user->name }}

                    </td>

                    <td class="text-center">

                        Rp {{ number_format($sale->total_harga,0,',','.') }}

                    </td>

                    <td class="text-center">

                        @if($sale->status == 'selesai')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            Selesai

                        </span>

                        @elseif($sale->status == 'pending')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            Pending

                        </span>

                        @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            Dibatalkan

                        </span>

                        @endif

                    </td>

                    <td class="text-center">

                        <a href="{{ route('history.show', $sale->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

                            Detail

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-10 text-gray-500">

                        Belum ada transaksi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $sales->links() }}

    </div>

</div>

@endsection