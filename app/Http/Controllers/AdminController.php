<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Download;
use App\Services\DashboardService;

class AdminController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $data = $this->dashboardService->getDashboardData();
        $adminName = auth()->user()->name;
        return view('admin.dashboard', array_merge($data, compact('adminName')));
    }
}