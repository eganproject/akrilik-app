<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    public function destroy(ProductVariant $product_variant): RedirectResponse
    {
        Storage::disk('public')->delete($product_variant->image_path);
        $product_variant->delete();

        return back()->with('status', 'Varian dihapus.');
    }
}
