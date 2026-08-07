@extends('layouts.kasir')

@section('content')

<div class="max-w-7xl mx-auto py-8 container">

    <h1 class="text-3xl font-bold mb-6">
        AI Rekomendasi Restock
    </h1>

    {{-- Dashboard --}}
    @include('restock.dashboard')

    {{-- Tabel --}}
    @include('restock.table')

</div>

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold">
            AI Rekomendasi Restock
        </h1>

        <p class="text-gray-500">
            Dashboard Prediksi Restock Menggunakan Fuzzy Mamdani
        </p>
    </div>

    <a href="{{ route('kasir.index') }}"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow transition">

        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L5.4 5M7 13l-1.5 7M17 13l1.5 7M9 20h6" />

        </svg>

        Buka Kasir

    </a>

</div>

{{-- Modal --}}
@include('restock.modal')

{{-- Data dari Laravel ke JavaScript --}}
<div
    id="restock-data"
    data-products='@json($fuzzyData)'>
</div>
<div
    id="chart-data"
    data-chart='@json($chartData)'>
</div>
<div
    id="bar-chart-data"
    data-chart='@json($barChartData)'>
</div>
<div
    id="trend-chart-data"
    data-chart='@json($trendChart)'>
</div>

@vite('resources/js/restock.js')

@endsection