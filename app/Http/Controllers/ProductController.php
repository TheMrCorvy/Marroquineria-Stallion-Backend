<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Image;

use Validator;

use Storage;

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

    public function search_products(Request $request, $no_pagination = null)
    {
        $validator = Validator::make(
            $request->only('query'),
            [
                'query' => ['required', 'string', 'min:2', 'max:100'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'request' => $request->all()
            ], 400);
        }

        $query = $request['query'];

        if ($no_pagination) {
            $products = Product::with('images')
                ->where('title', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->orWhere('brand', 'LIKE', "%$query%")
                ->orWhere('type', 'LIKE', "%$query%")
                ->get();
        } else {
            $products = Product::with('images')
                ->where('title', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->orWhere('brand', 'LIKE', "%$query%")
                ->orWhere('type', 'LIKE', "%$query%")
                ->paginate(10);
        }


        return response()->json([
            'products' => $products,
        ], 200);
    }

    public function get_offers()
    {
        // 
    }

    public function create(Request $request)
    {
        $new_product = $request->validate([
            'title' =>          ['required', 'string', 'min:2', 'max:190'],
            'description' =>    ['nullable', 'string', 'min:2', 'max:190'],
            'price' =>          ['required', 'integer', 'min:2'],
            'stock' =>          ['required', 'integer', 'min:1'],
            'brand' =>          ['required', 'string', 'min:1', 'max:190'],
            'type' =>           ['required', 'string', 'min:2', 'max:190'],
            'images.*' =>       ['nullable', 'mimes:jpg,jpeg,peng', 'max:20000']
        ]);

        try {
            $product_created = Product::create([
                'title' => $new_product['title'],
                'description' => $new_product['description'],
                'price' => $new_product['price'],
                'stock' => $new_product['stock'],
                'brand' => $new_product['brand'],
                'type' => $new_product['type'],
            ]);

            $images = $request->file('images');

            foreach ($images as $image) {
                $path = $image->store('images', 's3');

                Storage::disk('s3')->setVisibility($path, 'public');

                Image::create([
                    'img_url' => Storage::disk('s3')->url($path),
                    'img_path' => basename($path),
                    'product_id' => $product_created->id,
                ]);
            }
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('El producto fue añadido exitosamente.');
    }

    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('edit-product', compact('product'));
    }

    public function update(Request $request)
    {
    }

    public function delete($product_id)
    {
        $images = Image::select('img_url', 'img_path', 'id')->where('product_id', $product_id)->get();

        foreach ($images as $image) {
            Storage::disk('s3')->delete('images/' . $image->img_path);

            $image->delete();
        }

        $product = Product::findOrFail($product_id);

        $product->delete();

        return redirect()->route('home');
    }
}
