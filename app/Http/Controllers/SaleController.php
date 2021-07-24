<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Models\User;
use App\Models\SaleOrder;

use App\Notifications\AskForFund;

use Validator;

class SaleController extends Controller
{
    public function buy(Request $request)
    {
        //
    }

    public function ask_for_fund(Request $request)
    {
        $info = $request->only('name', 'email', 'phone', 'mail_body');

        $validator = Validator::make(
            $info,
            [
                'name' => ['required', 'string', 'min:2', 'max:100'],
                'phone' => ['required', 'string', 'min:6', 'max:16'],
                'email' => ['required', 'email', 'min:5', 'max:100'],
                'mail_body' => ['required', 'string', 'min:5', 'max:190'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::findOrFail(1);

        $user->notify(new AskForFund(
            $info['name'],
            $info['email'],
            $info['phone'],
            $info['mail_body'],
        ));

        return response()->json([
            'message' => 'Tu consulta fue enviada con éxito.',
        ], 200);
    }

    public function prueba(Request $request)
    {
        $info = $request->only('billing_info', 'shipping_info');

        $validator = Validator::make(
            $info,
            [
                'billing_info' => ['required', 'json'],
                'shipping_info' => ['required', 'json'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $sale = SaleOrder::find(1);

        $sale->shipping_info = $info['shipping_info'];
        $sale->billing_info = $info['billing_info'];

        $sale->save();

        return response()->json(['message' => 'exito'], 500);
    }
}
