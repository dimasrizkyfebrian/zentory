<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data kategori dari database, urutkan dari yang terbaru
        $categories = Category::latest()->get();

        // 2. Render komponen Vue dan kirim data categories sebagai "props"
        return Inertia::render('Categories/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Method ini hanya menampilkan halaman form
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories',
        ]);

        // 2. Buat record baru di database
        Category::create($validated);

        // 3. Redirect kembali ke halaman index
        return Redirect::route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Method ini menerima model Category yang ingin diedit
        // dan menampilkannya di halaman form Edit
        return Inertia::render('Categories/Edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validasi input (aturan unique kita sesuaikan agar mengabaikan data saat ini)
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        // 2. Update record di database
        $category->update($validated);

        // 3. Redirect kembali ke halaman index
        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Hapus kategori dari database
        $category->delete();

        // Redirect kembali ke halaman index
        return Redirect::route('categories.index');
    }
}
