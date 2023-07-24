<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return view('categories.table', compact('categories'));
    }

    public function createCategory() {
        $category = new Category();
        return view('categories.create', compact('category'));
    }

    public function storeCategory(Request $request) {
        $request->validate([
            'name'      => 'required|max:50'
        ]);

        Category::create([
            'name'      => strtolower($request->name)
        ]);

        return redirect(route('categories.table'))->with('success', 'Berhasil menambah kategori');
    }

    public function deleteCategoryById(Category $category) {
        $category->delete();
        return back();
    }
}
