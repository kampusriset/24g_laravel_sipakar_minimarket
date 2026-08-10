<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{

    protected $dashboardService;


    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }



    public function index()
    {

        $data = $this->dashboardService->getDashboardData();


        return view('dashboard.index', $data);

    }

}