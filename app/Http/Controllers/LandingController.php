<?php

namespace App\Http\Controllers;

use App\Models\FeaturedCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $featuredCategories = FeaturedCategory::with('category')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('landing', compact('featuredCategories'));
    }

    public function kategori(): View
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order')->orderBy('name')->paginate(12);

        return view('kategori', compact('categories'));
    }

    public function tentang(): View
    {
        return view('tentang');
    }

    public function kategoriShow(Request $request, string $slug): View
    {
        $category = ProductCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $perPage = (int) $request->get('per_page', 8);
        $allowedPerPage = [8, 20, 40, 80, 100];
        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 8;
        }

        $sort = $request->get('sort', 'latest');

        $productsQuery = Product::where('product_category_id', $category->id)
            ->where('is_active', true);

        if ($search = $request->get('q')) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        switch ($sort) {
            case 'name_asc':
                $productsQuery->orderBy('name');
                break;
            case 'name_desc':
                $productsQuery->orderByDesc('name');
                break;
            case 'oldest':
                $productsQuery->orderBy('created_at');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
                $sort = 'latest';
        }

        $products = $productsQuery->paginate($perPage)->withQueryString();

        return view('kategori-detail', [
            'category' => $category,
            'products' => $products,
            'sort' => $sort,
            'perPage' => $perPage,
            'search' => $request->get('q', ''),
        ]);
    }

    public function productShow(string $slug): View
    {
        $product = Product::with(['category', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('produk-detail', compact('product'));
    }
}
