<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Auth::user()->favoriteBooks()->with('category')->get();
        return response()->json($favorites);
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

        if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
            return response()->json(['message' => 'Book already in favorites'], 409);
        }

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        return response()->json($favorite->load('book.category'), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('book_id', $book->id)->first();

        if (!$favorite) {
            return response()->json(['message' => 'Book not found in favorites'], 404);
        }

        $favorite->delete();
        return response()->json(null, 204);
    }
}
