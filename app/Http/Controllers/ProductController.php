<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use Validator;

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
        $product = Product::with('images')->findOrFail($product_id);

        return response()->json([
            'product' => $product,
        ], 200);
    }

    public function search_products(Request $request)
    {
        $validator = Validator::make(
            $request->only('query'),
            [
                'query' => ['required', 'string', 'min:2', 'max:100'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $query = $request['query'];

        $products = Product::with('images')
            ->where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('brand', 'LIKE', "%$query%")
            ->orWhere('type', 'LIKE', "%$query%")
            ->paginate(10);

        return response()->json([
            'products' => $products,
        ], 200);
    }

    public function get_offers()
    {
        // 
    }
}
