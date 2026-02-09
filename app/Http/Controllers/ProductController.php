<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(): View
    {
        $query = Product::with(['category', 'images']);

        if ($search = request('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($categoryId = request('category_id')) {
            $query->where('product_category_id', $categoryId);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = ProductCategory::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $slug = Str::slug($request->input('name', ''));
        $data = Validator::make(
            $request->all() + ['slug' => $slug],
            [
                'product_category_id' => ['required', 'exists:product_categories,id'],
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')],
                'thumbnail' => ['nullable', 'image', 'max:2048'],
                'excerpt' => ['nullable', 'string', 'max:500'],
                'description' => ['nullable', 'string'],
                'is_active' => ['nullable', 'boolean'],
                'images.*' => ['nullable', 'image', 'max:2048'],
                'sort_orders.*' => ['nullable', 'integer', 'min:0', 'max:10000'],
                'existing_sort_orders.*' => ['nullable', 'integer', 'min:0', 'max:10000'],
                'existing_files.*' => ['nullable', 'image', 'max:2048'],
            ]
        )->validate();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('assets/images/products', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');

        $product = Product::create($data);

        $images = $request->file('images', []);
        $orders = $request->input('sort_orders', []);
        foreach ($images as $idx => $image) {
            $order = is_array($orders) && array_key_exists($idx, $orders) ? (int)$orders[$idx] : $idx;
            $path = $image->store('assets/images/products/gallery', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $path,
                'alt_text' => $product->name,
                'sort_order' => $order,
            ]);
        }

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dibuat.');
    }

    public function edit(Product $product): View
    {
        $categories = ProductCategory::orderBy('name')->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $slug = Str::slug($request->input('name', ''));
        $data = Validator::make(
            $request->all() + ['slug' => $slug],
            [
                'product_category_id' => ['required', 'exists:product_categories,id'],
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product->id)],
                'thumbnail' => ['nullable', 'image', 'max:2048'],
                'excerpt' => ['nullable', 'string', 'max:500'],
                'description' => ['nullable', 'string'],
                'is_active' => ['nullable', 'boolean'],
                'images.*' => ['nullable', 'image', 'max:2048'],
                'sort_orders.*' => ['nullable', 'integer', 'min:0', 'max:10000'],
            ]
        )->validate();

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('assets/images/products', 'public');
        }
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        // update existing sort orders and replacements
        $existingOrders = $request->input('existing_sort_orders', []);
        foreach ($existingOrders as $imgId => $order) {
            $img = $product->images()->where('id', $imgId)->first();
            if ($img) {
                $img->update(['sort_order' => (int)$order]);
            }
        }

        $existingFiles = $request->file('existing_files', []);
        foreach ($existingFiles as $imgId => $file) {
            $img = $product->images()->where('id', $imgId)->first();
            if ($img && $file) {
                Storage::disk('public')->delete($img->file_path);
                $path = $file->store('assets/images/products/gallery', 'public');
                $img->update(['file_path' => $path]);
            }
        }

        $images = $request->file('images', []);
        $orders = $request->input('sort_orders', []);
        if (!empty($images)) {
            $start = $product->images()->max('sort_order') ?? 0;
            foreach ($images as $idx => $image) {
                $orderInput = is_array($orders) && array_key_exists($idx, $orders) ? (int)$orders[$idx] : $start + $idx + 1;
                $path = $image->store('assets/images/products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $path,
                    'alt_text' => $product->name,
                    'sort_order' => $orderInput,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->file_path);
        }
        $product->delete();

        return back()->with('status', 'Produk dihapus.');
    }
}
