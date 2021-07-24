<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ShippingMethod;
use App\Models\ShippingZone;
use App\Models\SaleOrder;
use App\Models\Product;

use Auth;
use Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'min:4', 'max:50', 'exists:users,email'],
            'password' => ['required', 'string', 'min:4', 'max:100', 'alpha_dash']
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

    public function change_password(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:4', 'max:100', 'alpha_dash', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:4', 'max:100', 'alpha_dash'],
        ]);

        try {
            $user = User::findOrFail(Auth::user()->id);

            $user->password = Hash::make($data['password']);

            $user->save();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        return redirect()->route('home')->withMessage('Contraseña actualizada exitosamente.');
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
                'shipping_zones.id',
                'shipping_zones.shipping_method_id',
                'shipping_zones.region',
                'shipping_zones.delay',
                'shipping_zones.actual_price'
            )
            ->where('shipping_zones.id', '>', 1)
            ->get();

        return view('dashboard', compact('shipping_zones', 'shipping_methods'));
    }

    public function review_sales()
    {
        $sales = SaleOrder::with('sales')->paginate(15);

        return view('sales', compact('sales'));
    }
}
