@extends('layouts.dashboard')

@section('title', 'Smart Restock AI')

@section('page-title', 'Smart Restock AI')

@section('page-description', 'Analisis dan rekomendasi stok produk')


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
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Pie Chart --}}
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-lg font-bold mb-4">
            Distribusi Status AI
        </h2>

        <div class="flex justify-center items-center h-72">

            <canvas
                id="statusChart"
                class="max-w-[220px] max-h-[220px]">
            </canvas>

        </div>

    </div>

    {{-- Trend Penjualan --}}
    <div class="bg-white rounded-2xl shadow-lg p-6 lg:col-span-2">

        <h2 class="text-lg font-bold mb-4">
            Trend Penjualan
        </h2>

        <canvas id="trendChart"></canvas>

    </div>

</div>

<div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

    <h2 class="text-2xl font-bold mb-6">

        Top 10 Prioritas Restock

    </h2>

    <canvas id="priorityChart"></canvas>

    @endsection 