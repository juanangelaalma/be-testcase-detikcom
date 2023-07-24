<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect(route('books.table'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'getBooks'])->name('books.table');
    Route::post('/books/export', [BookController::class, 'export'])->name('books.export');
    Route::middleware('can:create book')->group(function () {
        Route::get('/books/create', [BookController::class, 'createBook'])->name('books.create');
        Route::post('/books/store', [BookController::class, 'storeBook'])->name('books.store');
    });
    Route::middleware('user_book')->group(function () {
        Route::middleware('can:update book')->group(function () {
            Route::get('/books/{book:id}/edit', [BookController::class, 'editBookById'])->name('books.edit');
            Route::put('/books/{book:id}/update', [BookController::class, 'updateBookById'])->name('books.update');
        });
        Route::middleware('can:delete book')->group(function () {
            Route::delete('/books/{book:id}/delete', [BookController::class, 'deleteBookById'])->name('books.delete');
        });
    });

    Route::get('/categories', [CategoryController::class, 'getCategories'])->name('categories.table');
    Route::get('/categories/create', [CategoryController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{category:id}/edit', [CategoryController::class, 'editCategoryById'])->name('categories.edit');
    Route::put('/categories/{category:id}/update', [CategoryController::class, 'updateCategoryById'])->name('categories.update');
    Route::delete('/categories/{category:id}/delete', [CategoryController::class, 'deleteCategoryById'])->name('categories.delete');
});

require __DIR__ . '/auth.php';
