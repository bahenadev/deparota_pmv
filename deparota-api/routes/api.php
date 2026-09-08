<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

// 1. Obtener todas las categorías
Route::get('/categories', function () {
    return response()->json(Category::all());
});

// 2. Obtener el catálogo completo (solo visibles)
Route::get('/products', function () {
    return response()->json(
        Product::with('category')
            ->where('is_visible', true)
            ->get()
    );
});

// 3. Obtener el detalle de un producto específico por su slug
Route::get('/products/{slug}', function ($slug) {
    return response()->json(
        Product::with('category')
            ->where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail()
    );
});