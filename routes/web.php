<?php

use App\Http\Controllers\BookController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books', [BookController::class, 'getBooks'])->name('books.table');
    Route::get('/books/create', [BookController::class, 'createBook'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'storeBook'])->name('books.store');
    Route::get('/books/{book:id}/edit', [BookController::class, 'editBookById'])->name('books.edit');
    Route::put('/books/{book:id}/update', [BookController::class, 'updateBookById'])->name('books.update');
    Route::delete('/books/{book:id}/delete', [BookController::class, 'deleteBookById'])->name('books.delete');
});

require __DIR__ . '/auth.php';
