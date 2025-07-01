<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloads = Auth::user()->downloads()->with('book.category')->get();
        return response()->json($downloads);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $user = Auth::user();
        $book = Book::find($request->book_id);

        $download = Download::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'downloaded_at' => now(),
        ]);

        return response()->json($download->load('book.category'), 201);
    }
}
