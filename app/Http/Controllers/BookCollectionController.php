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

        if ($search) {
            $books = Book::where('title', 'like', '%' . $search . '%')->get();
            $otherBooks = collect(); // Kosongkan otherBooks jika ada pencarian
        } else {
            $books = Cache::remember('recommended_books', now()->addDays(2), function () {
                return Book::inRandomOrder()->take(6)->get(); // Ambil 6 buku acak
            });

            $recommendedBookIds = $books->pluck('id')->toArray();

            $otherBooks = Cache::remember('other_books', now()->addDays(2), function () use ($recommendedBookIds) {
                $availableBooks = Book::all();
                if ($availableBooks->count() < 6) {
                    return Book::inRandomOrder()->take(6)->get();
                } else {
                    return Book::whereNotIn('id', $recommendedBookIds)->inRandomOrder()->take(6)->get();
                }
            });
        }
        return view('user.index', compact('books', 'otherBooks'));
    }
}
