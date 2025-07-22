<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class BookCollectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Book::query();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $books = $query->paginate(10); // Mengambil semua buku dengan paginasi 10 per halaman

        return view('user.books', compact('books'));
    }

    public function homeIndex(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $books = Book::where('title', 'like', '%' . $search . '%')->get();
            $otherBooks = collect(); // Kosongkan otherBooks jika ada pencarian
        } else {
            $books = Book::all(); // Mengambil semua buku
            $otherBooks = Book::all(); 
        }   
        return view('user.index', compact('books', 'otherBooks'));  
    }
}
