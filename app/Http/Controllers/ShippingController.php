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

    public function update_method(Request $request, $method_id)
    {
        $data = $request->validate([
            'method' => ['string', 'required', 'min:2', 'max:100', 'unique:shipping_methods,method'],
        ]);

        try {
            $method = ShippingMethod::findOrFail($method_id);

            $method->method = ucfirst($data['method']);

            $method->save();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('Método de envío actualizado exitosamente.');
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

    public function create_zone(Request $request)
    {
        $data = $request->validate([
            'shipping_method_id' => ['integer', 'required', 'min:1', 'exists:shipping_methods,id'],
            'region' => ['string', 'required', 'min:3', 'max:190'],
            'delay' => ['string', 'required', 'min:3', 'max:190'],
            'price' => ['integer', 'required', 'min:1']
        ]);

        try {
            ShippingZone::create([
                'shipping_method_id' => $data['shipping_method_id'],
                'region' => $data['region'],
                'delay' => $data['delay'],
                'actual_price' => $data['price'],
                'price' => '$ ' . $data['price'],
            ]);
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('La zona de envío añadida exitosamente.');
    }

    public function update_zone(Request $request, $zone_id)
    {
        $data = $request->validate([
            'region' => ['string', 'required', 'min:2', 'max:100', 'unique:shipping_zones,region'],
            'price' => ['integer', 'required', 'min:1'],
            'delay' => ['string', 'required', 'min:3', 'max:190'],
            'shipping_method_id' => ['integer', 'required', 'exists:shipping_methods,id'],
        ]);

        try {
            $zone = ShippingZone::findOrFail($zone_id);

            $zone->region = ucfirst($data['region']);
            $zone->actual_price = $data['price'];
            $zone->price = '$ ' . $data['price'];
            $zone->delay = $data['delay'];
            $zone->shipping_method_id = $data['shipping_method_id'];

            $zone->save();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('Método de envío actualizado exitosamente.');
    }

    public function delete_zone($zone_id)
    {
        try {
            ShippingZone::findOrFail($zone_id)->delete();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('La zona de envío eliminada exitosamente.');
    }
}
