<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookSearchController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BookCollectionController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', [BookCollectionController::class, 'homeIndex'])->name('user.index');
Route::get('/books', [BookCollectionController::class, 'index'])->name('user.books');
Route::get('/user/books/{id}', function ($id) {
    $book = Book::with('category')->findOrFail($id);
    return view('user.show', compact('book'));
})->name('user.show');

Route::get('/books/{id}/pdf', [BookController::class, 'showPdf'])->name('books.pdf');

// Authentication Routes
Auth::routes();

// Authenticated User Routes
Route::get('/search-books', [BookSearchController::class, 'search'])->name('search.books');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/my-library', [UserController::class, 'myLibrary'])->name('user.my_library');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin User Management
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Admin Book Management
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('admin.books.index');
        Route::get('/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/{book}', [BookController::class, 'show'])->name('admin.books.show');
        Route::put('/{book}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    });

    // Admin Category Management
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
});
