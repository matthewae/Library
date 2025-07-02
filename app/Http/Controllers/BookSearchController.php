<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('title');

        $books = Book::where('title', 'LIKE', '%' . $query . '%')->get();

        return view('user.search_results', compact('books', 'query'));
    }
}