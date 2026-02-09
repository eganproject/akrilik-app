<?php

namespace App\Http\Controllers;

use App\Models\FeaturedCategory;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FeaturedCategoryController extends Controller
{
    public function index(): View
    {
        $items = FeaturedCategory::with('category')->orderBy('sort_order')->get();
        $categories = ProductCategory::where('is_active', true)->orderBy('name')->get();

        return view('admin.featured_categories.index', compact('items', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (FeaturedCategory::count() >= 3) {
            return back()->withErrors(['limit' => 'Maksimal 3 kategori unggulan. Hapus salah satu terlebih dahulu.']);
        }

        $data = $request->validate([
            'product_category_id' => ['required', 'exists:product_categories,id', Rule::unique('featured_categories', 'product_category_id')],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
        ]);

        FeaturedCategory::create($data);

        return back()->with('status', 'Kategori ditambahkan ke unggulan.');
    }

    public function update(Request $request, FeaturedCategory $featured_category): RedirectResponse
    {
        $data = $request->validate([
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
        ]);

        $featured_category->update($data);

        return back()->with('status', 'Urutan diperbarui.');
    }

    public function destroy(FeaturedCategory $featured_category): RedirectResponse
    {
        $featured_category->delete();

        return back()->with('status', 'Kategori dihapus dari unggulan.');
    }
}
