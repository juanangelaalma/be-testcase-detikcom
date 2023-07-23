<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function getBooks(Request $request)
    {
        $user = Auth::user();
        $category = $request->query('category');

        $query = Book::with('category');

        if (!$user->hasRole('admin')) {
            $query->where('user_id', $user->id);
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        $books = $query->get();

        return view('books.table', [
            'books' => $books
        ]);
    }
}
