<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function get_products()
    {
        $products = Product::with('images')->paginate(10);

        return response()->json([
            'products' => $products,
        ], 200);
    }
}
