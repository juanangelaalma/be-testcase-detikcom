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
        $submitLabel = 'Tambah';
        return view('categories.create', compact('category', 'submitLabel'));
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

    public function editCategoryById(Category $category) {
        $submitLabel = "Edit";
        return view('categories.edit', compact('category', 'submitLabel'));
    }

    public function updateCategoryById(Request $request, Category $category) {
        $request->validate([
            'name'      => 'required|max:50'
        ]);

        $category->name = $request->name;

        $category->save();

        return redirect(route('categories.table'))->with('success', 'Berhasil update kategori');
    }

    public function deleteCategoryById(Category $category) {
        $category->delete();
        return back();
    }
}
