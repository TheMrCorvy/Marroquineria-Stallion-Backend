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

    public function find_product($product_id)
    {
        $product = Product::with('images')->findOrFail();

        return response()->json([
            'product' => $product,
        ], 200);
    }

    public function search_products(Request $request)
    {
        //
    }

    public function get_offers()
    {
        // 
    }
}
