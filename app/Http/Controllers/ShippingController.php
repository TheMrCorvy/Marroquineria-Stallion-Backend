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
}
