<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        dd($books); // Temporarily dump data to check
        return view('admin.books', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:819200',
            'pdf_file_path' => 'nullable|file|mimes:pdf|max:819200',
            'pages' => 'nullable|integer',
        ]);

        $coverImageData = null;
        $originalCoverName = null;
        if ($request->hasFile('cover_image')) {
            $coverFile = $request->file('cover_image');
            $originalCoverName = $coverFile->getClientOriginalName();
            $coverFileName = time() . '_' . $originalCoverName;
            $coverFile->storeAs('public/covers', $coverFileName);
            $coverImageData = $coverFileName;
        }

        $pdfFilePath = null;
        $originalPdfName = null;
        if ($request->hasFile('pdf_file_path')) {
            $pdfFile = $request->file('pdf_file_path');
            $originalPdfName = $pdfFile->getClientOriginalName();
            $pdfFileName = time() . '_' . $originalPdfName;
            Storage::disk('public')->putFileAs('pdfs', $pdfFile, $pdfFileName);
            $pdfFilePath = $pdfFileName;
        }

        $book = Book::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
            'cover_image_data' => $coverImageData,
            'original_cover_name' => $originalCoverName,
            'pdf_file_path' => $pdfFilePath,
            'original_pdf_name' => $originalPdfName,
            'pages' => $request->pages ? ['count' => (int)$request->pages] : null,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('user.show', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:819200',
            'pdf_file_path' => 'nullable|file|mimes:pdf|max:819200',
            'pages' => 'nullable|integer',
        ]);

        $coverImageData = $book->cover_image_data;
        $originalCoverName = $book->original_cover_name;

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image_data && Storage::disk('public')->exists('covers/' . $book->cover_image_data)) {
                Storage::disk('public')->delete('covers/' . $book->cover_image_data);
            }

            $coverFile = $request->file('cover_image');
            $originalCoverName = $coverFile->getClientOriginalName();
            $coverFileName = time() . '_' . $originalCoverName;
            $coverFile->storeAs('public/covers', $coverFileName);
            $coverImageData = $coverFileName;
        }

        $pdfFilePath = $book->pdf_file_path;
        $originalPdfName = $book->original_pdf_name;

        if ($request->hasFile('pdf_file_path')) {
            if ($book->pdf_file_path && Storage::disk('public')->exists('pdfs/' . $book->pdf_file_path)) {
                Storage::disk('public')->delete('pdfs/' . $book->pdf_file_path);
            }

            $pdfFile = $request->file('pdf_file_path');
            $originalPdfName = $pdfFile->getClientOriginalName();
            $pdfFileName = time() . '_' . $originalPdfName;
            Storage::disk('public')->putFileAs('pdfs', $pdfFile, $pdfFileName);
            $pdfFilePath = $pdfFileName;
        }

        $book->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
            'cover_image_data' => $coverImageData,
            'original_cover_name' => $originalCoverName,
            'pdf_file_path' => $pdfFilePath,
            'original_pdf_name' => $originalPdfName,
            'pages' => $request->pages ? ['count' => (int)$request->pages] : null,
        ]);

        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image_data && Storage::disk('public')->exists('covers/' . $book->cover_image_data)) {
            Storage::disk('public')->delete('covers/' . $book->cover_image_data);
        }

        if ($book->pdf_file_path && Storage::disk('public')->exists('pdfs/' . $book->pdf_file_path)) {
            Storage::disk('public')->delete('pdfs/' . $book->pdf_file_path);
        }

        $book->delete();
        return response()->json(null, 204);
    }

    public function showPdf($id)
    {
        $book = Book::findOrFail($id);

        Log::info('Book ID: ' . $book->id . ', PDF file path from DB: ' . $book->pdf_file_path);

        if (!$book->pdf_file_path) {
            Log::error('No PDF file path found for book ID: ' . $book->id);
            abort(404, 'PDF not found.');
        }

        if (auth()->check()) {
            auth()->user()->update(['last_read_book_id' => $book->id]);
        }

        $pdfFileName = $book->pdf_file_path;
        $storagePath = 'pdfs/' . $pdfFileName;

        if (Storage::disk('public')->exists($storagePath)) {
            return Storage::disk('public')->response($storagePath);
        }

        $fallbackPath = public_path('storage/pdfs/' . $pdfFileName);
        if (file_exists($fallbackPath)) {
            return response()->file($fallbackPath);
        }

        Log::error('PDF file not found: ' . $storagePath);
        abort(404, 'PDF file not found.');
    }

    public function showCover($id)
    {
        $book = Book::findOrFail($id);

        Log::info('Book ID: ' . $book->id . ', Cover image path from DB: ' . $book->cover_image_data);

        if (!$book->cover_image_data) {
            Log::error('No cover image data found for book ID: ' . $book->id);
            abort(404, 'Cover image not found.');
        }

        $coverFileName = $book->cover_image_data;
        $storagePath = 'covers/' . $coverFileName;

        if (Storage::disk('public')->exists($storagePath)) {
            return Storage::disk('public')->response($storagePath);
        }

        $fallbackPath = public_path('storage/covers/' . $coverFileName);
        if (file_exists($fallbackPath)) {
            return response()->file($fallbackPath);
        }

        Log::error('Cover image file not found: ' . $storagePath);
        abort(404, 'Cover image file not found.');
    }

    public function favorite(Book $book)
    {
        $user = auth()->user();

        if ($user->favorites()->where('book_id', $book->id)->exists()) {
            return back()->with('error', 'Book is already in your favorites.');
        }

        $user->favorites()->attach($book->id);

        return back()->with('success', 'Book added to favorites!');
    }

        if (Storage::disk('public')->exists($storagePath)) {
            return Storage::disk('public')->response($storagePath);
        }

        $fallbackPath = public_path('storage/covers/' . $coverFileName);
        if (file_exists($fallbackPath)) {
            return response()->file($fallbackPath);
        }

        Log::error('Cover image file not found: ' . $storagePath);
        abort(404, 'Cover image file not found.');
    }

    public function favorite(Request $request, Book $book)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to add favorites.');
        }

        if ($user->favorites()->where('book_id', $book->id)->exists()) {
            return redirect()->back()->with('info', 'Book is already in your favorites.');
        }

        $user->favorites()->create(['book_id' => $book->id]);

        return redirect()->back()->with('success', 'Book added to favorites successfully!');
    }

}
