<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ProductCategory::orderByDesc('created_at')->paginate(10);

        return view('admin.product_categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $slug = Str::slug($request->input('name', ''));
        $payload = $request->all() + ['slug' => $slug];
        $data = Validator::make(
            $payload,
            [
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('product_categories', 'slug')],
                'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
                'image' => ['nullable', 'image', 'max:2048'],
                'description' => ['nullable', 'string'],
                'is_active' => ['nullable', 'boolean'],
            ]
        )->validate();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets/images/categories', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');
        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori berhasil dibuat.');
    }

    public function edit(ProductCategory $product_category): View
    {
        return view('admin.product_categories.edit', ['category' => $product_category]);
    }

    public function update(Request $request, ProductCategory $product_category): RedirectResponse
    {
        $slug = Str::slug($request->input('name', ''));
        $payload = $request->all() + ['slug' => $slug];
        $data = Validator::make(
            $payload,
            [
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('product_categories', 'slug')->ignore($product_category->id)],
                'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
                'image' => ['nullable', 'image', 'max:2048'],
                'description' => ['nullable', 'string'],
                'is_active' => ['nullable', 'boolean'],
            ]
        )->validate();

        if ($request->hasFile('image')) {
            if ($product_category->image) {
                Storage::disk('public')->delete($product_category->image);
            }
            $data['image'] = $request->file('image')->store('assets/images/categories', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $product_category->update($data);

        return redirect()->route('admin.product-categories.index')->with('status', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProductCategory $product_category): RedirectResponse
    {
        if ($product_category->image) {
            Storage::disk('public')->delete($product_category->image);
        }
        $product_category->delete();

        return back()->with('status', 'Kategori dihapus.');
    }

    public function updateOrder(Request $request, ProductCategory $product_category): RedirectResponse
    {
        $data = $request->validate([
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
        ]);

        $product_category->update($data);

        return back()->with('status', 'Urutan kategori diperbarui.');
    }
}
