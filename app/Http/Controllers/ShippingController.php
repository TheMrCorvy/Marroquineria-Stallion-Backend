<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShippingMethod;
use App\Models\ShippingZone;

class ShippingController extends Controller
{
    public function get_shipping_options()
    {
        $shipping_options = cache()->remember('shipping_options', 60 * 60 * 24 * 10, function () {
            return ShippingMethod::with('shipping_zones')->get();
        });

        return response()->json([
            'shipping_options' => $shipping_options,
        ], 200);
    }

    public function create_method(Request $request)
    {
        $data = $request->validate([
            'method' => ['string', 'required', 'min:2', 'max:100', 'unique:shipping_methods,method'],
        ]);

        try {
            ShippingMethod::create([
                'method' => ucfirst($data['method']),
            ]);
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('Nuevo método de envío añadido exitosamente.');
    }

    public function update_method(Request $request)
    {
    }

    public function delete_method($method_id)
    {
        try {
            ShippingMethod::findOrFail($method_id)->delete();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('Método de envío eliminado exitosamente.');
    }
}
