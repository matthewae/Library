<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Download;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalBooks = Book::count();
        $latestDownloads = Download::with(['user', 'book'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalBooks', 'latestDownloads'));
    }
}