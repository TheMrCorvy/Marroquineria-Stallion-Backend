<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Image;

use Validator;

use Storage;

class ProductController extends Controller
{
    public function get_products($type = null)
    {
        if ($type) {
            $products = Product::with('images')
                ->where('stock', '>=', 1)
                ->where('type', 'LIKE', "%$type%")
                ->paginate(10);
        } else {
            $products = Product::with('images')
                ->where('stock', '>=', 1)
                ->paginate(10);
        }


        return response()->json([
            'products' => $products,
            'endpoint' => $type
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
        $offers = Product::with('images')
            ->where('stock', '>=', 1)
            ->where('discount', '>', 0)
            ->whereNotNull('discount')
            ->paginate(2);

        return response()->json([
            'offers' => $offers,
        ], 200);
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
            'sale' =>           ['nullable', 'integer', 'min:0'],
            'images.*' =>       ['required']
        ]);

        try {
            $product_created = Product::create([
                'title' => $new_product['title'],
                'description' => $new_product['description'] ? $new_product['description'] : ' ',
                'price' => $new_product['price'],
                'stock' => $new_product['stock'],
                'brand' => $new_product['brand'],
                'discount' => $new_product['sale'],
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

        $categories = [
            "accesorios",
            "accesorios - mujer",
            "accesorios de viaje",
            "bandoleras",
            "barbijos / cubrebocas",
            "billeteras",
            "billeteras - hombre",
            "billeteras - mujer",
            "billeteras - tarjetero",
            "billeteras de cuero - hombre",
            "billeteras de cuero - mujer",
            "bolsos",
            "botineros",
            "botineros",
            "carteras",
            "carteras simil cuero",
            "cartucheras",
            "maletines",
            "mochilas",
            "mochilas escolares",
            "mochilas porta-notebooks",
            "mochilas urbanas",
            "morrales",
            "paraguas",
            "paraguas - hombre",
            "paraguas - mujer",
            "porta cosméticos",
            "porta-notebooks",
            "portafolio",
            "portafolios",
            "portafolios porta-notebooks",
            "portafolios simil cuero",
            "productos fabricados",
            "riñoneras",
            "valijas",
        ];

        return view('edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $product_id)
    {
        $edit_product = $request->validate([
            'title' =>          ['required', 'string', 'min:2', 'max:190'],
            'description' =>    ['nullable', 'string', 'min:2', 'max:190'],
            'price' =>          ['required', 'integer', 'min:2'],
            'stock' =>          ['required', 'integer', 'min:1'],
            'brand' =>          ['required', 'string', 'min:1', 'max:190'],
            'type' =>           ['required', 'string', 'min:2', 'max:190'],
            'sale' =>           ['nullable', 'integer', 'min:0'],
            'images.*' =>       ['nullable'],
        ]);

        $images_input = $request->file('images');

        try {
            $product = Product::findOrFail($product_id);

            $product->title = $edit_product['title'];
            $product->description = $edit_product['description'] ? $edit_product['description'] : ' ';
            $product->price = $edit_product['price'];
            $product->stock = $edit_product['stock'];
            $product->brand = $edit_product['brand'];
            $product->type = $edit_product['type'];
            $product->discount = $edit_product['sale'];

            $product->save();

            if (!is_null($images_input)) {
                $images_db = Image::select('img_url', 'img_path', 'id')->where('product_id', $product_id)->get();

                foreach ($images_db as $image_db) {
                    if ($image_db->img_path) {
                        Storage::disk('s3')->delete('images/' . $image_db->img_path);
                    }

                    $image_db->delete();
                }

                foreach ($images_input as $image_input) {
                    $path = $image_input->store('images', 's3');

                    Storage::disk('s3')->setVisibility($path, 'public');

                    Image::create([
                        'img_url' => Storage::disk('s3')->url($path),
                        'img_path' => basename($path),
                        'product_id' => $product_id,
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('El producto fue actualizado exitosamente.');
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

        return redirect()->route('home')->withMessage('El producto fue eliminado exitosamente.');
    }
}
