<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function createBook()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'title'     => 'required|max:100',
            'category'  => 'required',
            'description'   => 'required',
            'quantity'  => 'required|int',
            'cover'     => 'required|mimes:png,jpg,jpeg',
            'file'     => 'required|mimes:pdf',
        ]);

        $cover = $request->file('cover');
        $file = $request->file('file');

        $name = time() . "." . $cover->extension();

        $coverPath = "/books/covers/$name";
        $filePath = "/books/files/$name";

        Storage::disk('public')->put($coverPath, file_get_contents($cover));
        Storage::disk('public')->put($filePath, file_get_contents($file));

        Book::create([
            'title'     => $request->title,
            'user_id'   => Auth::user()->id,
            'category_id' => $request->category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'cover' => $coverPath,
            'file' => $filePath,
        ]);

        return redirect(route('books.table'))->with('success', 'Berhasil menambahkan buku');
    }

    public function deleteBookById(Book $book)
    {
        Storage::disk('public')->delete($book->cover);
        Storage::disk('public')->delete($book->file);
        $book->delete();
        return back();
    }
}
