<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori
        $categories = Category::all();
        return response()->json(['status' => 200, 'message' => 'success', 'data' => $categories]);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Membuat kategori baru
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['status' => 200, 'message' => 'Category created successfully', 'data' => $category]);
    }

    public function show($id)
    {
        // Menampilkan detail kategori berdasarkan ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 404, 'message' => 'Category not found']);
        }

        return response()->json(['status' => 200, 'message' => 'success', 'data' => $category]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cari kategori berdasarkan ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 404, 'message' => 'Category not found']);
        }

        // Update nama kategori
        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(['status' => 200, 'message' => 'Category updated successfully', 'data' => $category]);
    }

    public function destroy($id)
    {
        // Hapus kategori berdasarkan ID
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 404, 'message' => 'Category not found']);
        }

        $category->delete();

        return response()->json(['status' => 200, 'message' => 'Category deleted successfully']);
    }
}