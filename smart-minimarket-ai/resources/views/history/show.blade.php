@extends('layouts.kasir')

@section('content')

<div class="max-w-5xl mx-auto py-8">

    <div class="bg-white rounded-xl shadow p-8">

        <h1 class="text-3xl font-bold mb-6">
            Detail Transaksi
        </h1>

        <div class="grid grid-cols-2 gap-4 mb-8">

            <div>
                <p class="text-gray-500">Invoice</p>
                <p class="font-semibold">{{ $sale->invoice_number }}</p>
            </div>

            <div>
                <p class="text-gray-500">Kasir</p>
                <p class="font-semibold">{{ $sale->user->name }}</p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal</p>
                <p>{{ \Carbon\Carbon::parse($sale->tanggal)->format('d/m/Y H:i') }}</p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <p>{{ ucfirst($sale->status) }}</p>
            </div>

        </div>

        <table class="w-full border">

            <thead class="bg-gray-100">

                <tr>
                    <th class="p-3 text-left">Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>

            </thead>

            <tbody>

                @foreach($sale->saleDetails as $detail)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $detail->product->nama_produk }}
                    </td>

                    <td class="text-center">
                        {{ $detail->qty }}
                    </td>

                    <td class="text-center">
                        Rp {{ number_format($detail->harga,0,',','.') }}
                    </td>

                    <td class="text-center">
                        Rp {{ number_format($detail->subtotal,0,',','.') }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-8 text-right">

            <h2 class="text-2xl font-bold">

                Total :
                Rp {{ number_format($sale->total_harga,0,',','.') }}

            </h2>

        </div>

        <div class="mt-6">

            <a href="{{ route('history.index') }}"
                class="bg-gray-700 text-white px-6 py-3 rounded-lg">

                Kembali

            </a>

            <a
                href="{{ route('history.pdf',$sale) }}"
                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded">

                Download PDF

            </a>

        </div>

    </div>

</div>

@endsection