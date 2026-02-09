<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $product_image): RedirectResponse
    {
        Storage::disk('public')->delete($product_image->file_path);
        $product = $product_image->product;
        $product_image->delete();

        return back()->with('status', 'Gambar dihapus.');
    }
}
