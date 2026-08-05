@extends('layouts.kasir')

@section('content')

<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-3xl font-bold mb-6">
        AI Rekomendasi Restock
    </h1>

    {{-- Dashboard --}}
    @include('restock.dashboard')

    {{-- Tabel --}}
    @include('restock.table')

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