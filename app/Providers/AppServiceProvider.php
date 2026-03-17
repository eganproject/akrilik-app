<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Data untuk navbar (5 kategori + produk per kategori)
        view()->composer('partials.navbar', function ($view) {
            $navCategories = ProductCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->limit(5)
                ->get();

            $productsByCategory = Product::with('category')
                ->where('is_active', true)
                ->whereIn('product_category_id', $navCategories->pluck('id'))
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get()
                ->groupBy('product_category_id');

            $view->with([
                'navCategories' => $navCategories,
                'navProductsByCategory' => $productsByCategory,
            ]);
        });
    }
}
