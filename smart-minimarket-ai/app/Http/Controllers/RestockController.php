<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class RestockController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Halaman Analisis Restock
     */
    public function index()
    {
        // Ambil seluruh data analisis dari DashboardService
        $data = $this->dashboardService->getRestockAnalysis();

        // Kirim data ke halaman restock
        return view('restock.index', $data);
    }
}