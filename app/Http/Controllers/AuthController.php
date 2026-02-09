<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Show the admin dashboard (protected).
     */
    public function admin()
    {
        $stats = [
            'products' => Product::count(),
            'products_active' => Product::where('is_active', true)->count(),
            'categories' => ProductCategory::count(),
            'images' => ProductImage::count(),
            'featured' => \App\Models\FeaturedCategory::count(),
        ];

        $latestProducts = Product::with('category')->latest()->take(5)->get();
        $latestCategories = ProductCategory::latest()->take(5)->get();

        return view('admin.index', compact('stats', 'latestProducts', 'latestCategories'));
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
