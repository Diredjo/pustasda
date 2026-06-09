<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('competitions')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'icon' => 'required|string|max:100',
            'color' => 'required|string|max:20',
        ]);
        Category::create($request->only('name', 'icon', 'color'));
        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'icon' => 'required|string|max:100',
            'color' => 'required|string|max:20',
        ]);
        $category->update($request->only('name', 'icon', 'color'));
        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        if ($category->competitions()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan lomba.');
        }
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}