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
        $book = new Book();
        $submitLabel = 'Tambah';
        return view('books.create', compact('categories', 'book', 'submitLabel'));
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

        $coverName = time() . "." . $cover->extension();
        $fileName = time() . "." . $file->extension();

        $coverPath = "/books/covers/$coverName";
        $filePath = "/books/files/$fileName";

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

    public function editBookById(Book $book)
    {
        $categories = Category::all();
        $submitLabel = 'Edit';
        return view('books.edit', compact('book', 'categories', 'submitLabel'));
    }

    public function updateBookById(Request $request, Book $book)
    {
        $request->validate([
            'title'     => 'required|max:100',
            'category'  => 'required',
            'description'   => 'required',
            'quantity'  => 'required|int',
        ]);

        if ($request->file('cover')) {
            $request->validate([
                'cover'     => 'required|mimes:png,jpg,jpeg',
            ]);

            Storage::disk('public')->delete($book->cover);

            $cover = $request->file('cover');
            $newCoverName = time() . "." . $cover->extension();
            $newCoverPath = "/books/covers/$newCoverName";
            Storage::disk('public')->put($newCoverPath, file_get_contents($cover));

            $book->cover = $newCoverPath;
        }

        if ($request->file('file')) {
            $request->validate([
                'file'     => 'required|mimes:pdf',
            ]);

            Storage::disk('public')->delete($book->file);

            $file = $request->file('file');
            $newFileName = time() . "." . $file->extension();
            $newFilePath = "/books/files/$newFileName";
            Storage::disk('public')->put($newFilePath, file_get_contents($file));

            $book->file = $newFilePath;
        }

        $book->title = $request->title;
        $book->category_id = $request->category;
        $book->description = $request->description;
        $book->quantity = $request->quantity;

        $book->save();

        return redirect(route('books.table'))->with('success', 'Berhasil update data buku');
    }

    public function deleteBookById(Book $book)
    {
        Storage::disk('public')->delete($book->cover);
        Storage::disk('public')->delete($book->file);
        $book->delete();
        return back();
    }
}
