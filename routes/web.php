<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookSearchController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


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

Route::get('/', function () {
    return view('user.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/books', [App\Http\Controllers\BookController::class, 'index'])->name('admin.books.index');
    Route::post('/admin/books', [App\Http\Controllers\BookController::class, 'store'])->name('admin.books.store');
    Route::get('/admin/books/{book}', [App\Http\Controllers\BookController::class, 'show'])->name('admin.books.show');
    Route::put('/admin/books/{book}', [App\Http\Controllers\BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/admin/books/{book}', [App\Http\Controllers\BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/admin/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

use App\Models\Book;

Route::get('/user/books/{id}', function ($id) {
    $book = Book::with('category')->findOrFail($id);
    return view('user.show', compact('book'));
})->name('user.show');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', function () {
    return view('user.index');
})->name('user.index');

Route::get('/search-books', [App\Http\Controllers\BookSearchController::class, 'search'])->name('search.books');
});
