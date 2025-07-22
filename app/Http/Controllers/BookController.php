<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('admin.books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        $pdfPath = null;
        if ($request->hasFile('pdf_file_path')) {
            try {
                $pdfFile = $request->file('pdf_file_path');
                $pdfPath = $pdfFile->store('pdfs', 'public');
                $originalPdfName = $pdfFile->getClientOriginalName();
            } catch (\Exception $e) {
                \Log::error('Error saving PDF file: ' . $e->getMessage());
                $pdfPath = null; // Ensure pdfPath is null if saving fails
                $originalPdfName = null;
            }
        } else {
            $originalPdfName = null;
        }

        $book = Book::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
            'cover_image_path' => $coverImagePath,
            'pdf_file_path' => $pdfPath,
            'original_pdf_name' => $originalPdfName,
            'pages' => $request->pages ? ['count' => (int)$request->pages] : null,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {

        return view('user.show', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        $coverImagePath = $book->cover_image_path;
        if ($request->hasFile('cover_image')) {
            if ($coverImagePath) {
                Storage::disk('public')->delete($coverImagePath);
            }
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        $pdfPath = $book->pdf_file_path;
        $originalPdfName = $book->original_pdf_name;
        if ($request->hasFile('pdf_file_path')) {
            if ($pdfPath) {
                Storage::disk('public')->delete($pdfPath);
            }
            $pdfFile = $request->file('pdf_file_path');
            $pdfPath = $pdfFile->store('pdfs', 'public');
            $originalPdfName = $pdfFile->getClientOriginalName();
        }

        $book->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'description' => $request->description,
            'cover_image_path' => $coverImagePath,
            'pdf_file_path' => $pdfPath,
            'original_pdf_name' => $originalPdfName,
            'pages' => $request->pages ? ['count' => (int)$request->pages] : null,
        ]);

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        if ($book->pdf_file_path) {
            Storage::disk('public')->delete($book->pdf_file_path);
        }
        $book->delete();
        return response()->json(null, 204);
    }
}
