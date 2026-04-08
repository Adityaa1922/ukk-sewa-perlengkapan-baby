<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_available', $request->status === 'available');
        }

        $products   = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|string|max:150|unique:products,name',
            'description'   => 'nullable|string',
            'brand'         => 'nullable|string|max:100',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price_per_day' => 'required|numeric|min:1000',
            'stock'         => 'required|integer|min:0',
            'min_age_month' => 'nullable|integer|min:0',
            'max_age_month' => 'nullable|integer|min:0|gte:min_age_month',
            'is_available'  => 'boolean',
        ]);

        // Slug
        $validated['slug'] = $this->uniqueSlug($request->name);

        // Upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_available'] = $request->boolean('is_available', true);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', "Produk \"{$validated['name']}\" berhasil ditambahkan.");
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|string|max:150|unique:products,name,' . $product->id,
            'description'   => 'nullable|string',
            'brand'         => 'nullable|string|max:100',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price_per_day' => 'required|numeric|min:1000',
            'stock'         => 'required|integer|min:0',
            'min_age_month' => 'nullable|integer|min:0',
            'max_age_month' => 'nullable|integer|min:0|gte:min_age_month',
            'is_available'  => 'boolean',
        ]);

        // Slug hanya diupdate kalau nama berubah
        if ($product->name !== $request->name) {
            $validated['slug'] = $this->uniqueSlug($request->name, $product->id);
        }

        // Upload gambar baru & hapus lama
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_available'] = $request->boolean('is_available');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', "Produk \"{$product->name}\" berhasil diperbarui.");
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Produk \"{$name}\" berhasil dihapus.");
    }

    // ── Helpers ──────────────────────────────────────────────

    private function uniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug  = Str::slug($name);
        $base  = $slug;
        $count = 1;

        $query = Product::where('slug', $slug);
        if ($excludeId) $query->where('id', '!=', $excludeId);

        while ($query->exists()) {
            $slug  = $base . '-' . $count++;
            $query = Product::where('slug', $slug);
            if ($excludeId) $query->where('id', '!=', $excludeId);
        }

        return $slug;
    }
}