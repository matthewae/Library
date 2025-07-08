<?php

namespace App\Services;

use App\Models\User;
use App\Models\Book;
use App\Models\Download;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardData()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalBooks = Book::count();
        $latestDownloads = Download::with(['user', 'book'])->latest()->take(5)->get();

        $bookDownloads = Download::select('book_id', DB::raw('count(*) as total_downloads'))
                                ->groupBy('book_id')
                                ->with('book')
                                ->orderByDesc('total_downloads')
                                ->get();

        $chartLabels = $bookDownloads->pluck('book.title');
        $chartData = $bookDownloads->pluck('total_downloads');

        $totalCategories = \App\Models\Category::count();
        return compact('totalUsers', 'totalBooks', 'latestDownloads', 'chartLabels', 'chartData', 'bookDownloads', 'totalCategories');
    }
}