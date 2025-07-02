<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END, id ASC")->get();
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.users', compact('users', 'totalUsers'));
    }

    // You can add more methods here for create, store, edit, update, delete
}