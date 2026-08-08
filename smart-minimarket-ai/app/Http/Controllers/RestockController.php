<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class RestockController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $data = $this->dashboardService->getRestockAnalysis();

        return view('restock.index', $data);
    }
}