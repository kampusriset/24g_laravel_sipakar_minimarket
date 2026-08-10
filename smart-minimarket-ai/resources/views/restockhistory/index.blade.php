@extends('layouts.dashboard')

@section('content')
@section('dashboard-content')

<div class="max-w-7xl mx-auto py-8">

<h1 class="text-3xl font-bold mb-6">
    Riwayat Restock
</h1>


<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-yellow-400">

<tr>

<th class="p-4 text-left">
Produk
</th>

<th>
Jumlah
</th>

<th>
Stock Sebelum
</th>

<th>
Stock Sesudah
</th>

<th>
Tanggal
</th>

</tr>

</thead>


<tbody>


@forelse($histories as $history)

<tr class="border-b">

<td class="p-4">
{{ $history->product->nama_produk }}
</td>


<td class="text-center">
{{ $history->jumlah }}
</td>


<td class="text-center">
{{ $history->stock_sebelum }}
</td>


<td class="text-center">
{{ $history->stock_sesudah }}
</td>


<td class="text-center">

{{ $history->created_at->format('d M Y H:i') }}

</td>


</tr>


@empty

<tr>

<td colspan="5" class="text-center py-8 text-gray-400">

Belum ada riwayat restock

</td>

</tr>

@endforelse


</tbody>


</table>

</div>


</div>


@endsection