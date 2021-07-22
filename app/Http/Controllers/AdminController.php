<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ShippingMethod;
use App\Models\ShippingZone;

use Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'min:4', 'max:50', 'exists:users,email'],
            'password' => ['required', 'string', 'min:4', 'max:10', 'alpha']
        ]);

        try {
            $user = User::where('email', $data['email'])->firstOrFail();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        $logged_in = Auth::loginUsingId($user->id);

        if ($logged_in) {
            request()->session()->regenerate();

            return redirect()->route('home');
        }

        return view('errors.500');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }

    public function dashboard()
    {
        $shipping_methods = ShippingMethod::select('id', 'method')->where('id', '>', 1)->get();

        $shipping_zones = ShippingZone::join(
            'shipping_methods',
            'shipping_methods.id',
            'shipping_zones.shipping_method_id'
        )
            ->select(
                'shipping_methods.method',
                'shipping_zones.shipping_method_id',
                'shipping_zones.region',
                'shipping_zones.delay',
                'shipping_zones.actual_price'
            )
            ->where('shipping_zones.id', '>', 1)
            ->get();

        return view('dashboard', compact('shipping_zones', 'shipping_methods'));
    }
}
