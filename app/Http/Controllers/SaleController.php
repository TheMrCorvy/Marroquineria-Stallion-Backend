<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

use Mail;
use App\Mail\NotifyUser;

use App\Models\User;
use App\Models\SaleOrder;
use App\Models\ShippingZone;

use App\Notifications\AskForFund;

use Validator;

use Illuminate\Support\Facades\Http;

class SaleController extends Controller
{
    protected $base_uri;

    protected $public_key;

    protected $access_token;

    public function __construct()
    {
        $this->base_uri = config('services.mercadopago.base_uri');
        $this->public_key = config('services.mercadopago.public_key');
        $this->access_token = config('services.mercadopago.access_token');
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

    public function buy(Request $request)
    {
        $info = $request->only(
            'method',
            'billing_info',
            'shipping_info',
            'total_price',
            'cart_items',
            'email',
            'card_network',
            'card_token',
            'shipping_option_id'
        );

        $validator = Validator::make(
            $info,
            [
                'method' => ['required', 'string', 'min:3', 'max:15', 'in:mercadopago,cash'],
                'billing_info' => ['required', 'json'],
                'shipping_info' => ['required', 'json'],
                'total_price' => ['required', 'integer', 'min:1'],
                'cart_items' => ['required'],
                'email' => ['required', 'email'],
                'card_network' => ['required_unless:method,cash', 'string', 'min:1', 'max:190'],
                'card_token' => ['required_unless:method,cash', 'string', 'min:1', 'max:255'],
                'shipping_option_id' => ['required', 'integer', 'exists:shipping_zones,id']
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Hubo un error validando los datos enviados. Le recomendamos que vacíe su carrito de compras y vuelva a intentar.',
                'request' => $info['cart_items'],
            ], 400);
        }

        $products_exist_in_db = $this->verify_products($info['cart_items']);

        if (!$products_exist_in_db) {
            return response()->json([
                'errors' => [
                    'product_was_not_found' => 'One or multpile products where not found',
                ],
                'message' => 'Hubo un error validando los datos enviados. Le recomendamos que vacíe su carrito de compras y vuelva a intentar.'
            ], 400);
        }

        try {
            $shipping_option = ShippingZone::findOrFail($info['shipping_option_id']);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => [
                    'db_connection_unsuccessful' => 'there was an error trying to get the shipping option price'
                ],
                'message' => 'Hubo un error calculando el precio de la modalidad de envío elegida. Por favor intente otra vez.'
            ], 500);
        }

        $total_amount = $info['total_price'] + $shipping_option->actual_price;

        $payment_method = 'Efectivo en el Local';

        if ($info['method'] === 'mercadopago') {
            $payment = $this->call_mercadopago(
                $info['card_network'],
                $info['card_token'],
                $info['email'],
                $total_amount,
            );

            if (!$payment || $payment['status'] !== 'approved') {
                return response()->json([
                    'errors' => [
                        'api_call_unsuccessful' => 'the api responded with a status different from "approved"'
                    ],
                    'message' => 'Hubo un problema procesando su pago y la compra no pudo ser concretada...',
                ], 500);
            }

            $payment_method = 'MercadoPago';
        }

        $sale_order = SaleOrder::create([
            'date' => now()->format('Y-M-D'),
            'payment_method' => $payment_method,
            'total_price' => $total_amount,
            'billing_info' => $info['billing_info'],
            'shipping_info' => $info['shipping_info'],
        ]);

        $order_finished = $this->generate_sales($sale_order->id, $info['cart_items']);

        if (!$order_finished) {
            return response()->json([
                'errors' => [
                    'db_connection_unsuccessful' => 'there was an error trying to reduce the stock of some products, or trying to create the sale order'
                ],
                'message' => 'Su orden de compra no pudo ser finalizada, pero su pago fue procesado. Le recomendamos que nos contacte para poder ayudarle.'
            ], 500);
        }

        Mail::to($info['email'])->send(new NotifyUser($sale_order->id));

        return response()->json([
            'message' => 'Su compra fue finalizada exitosamente. Dentro de unos momentos recibirá un email con el código de su compra.'
        ], 200);
    }

    private function verify_products($products)
    {
        try {
            foreach ($products as $product) {
                Product::findOrFail($product['id']);
            }
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }

    private function call_mercadopago($card_network, $card_token, $email, $total_amount)
    {
        try {
            $response = Http::withToken($this->access_token)
                ->accept('application/json')
                ->post($this->base_uri . '/v1/payments', [
                    'payer' => [
                        'email' => $email,
                    ],
                    'binary_mode' => true, //binary_mode es para pedir que la transaccion tenga solo 2 estados, aprobada o rechazada
                    'transaction_amount' => $total_amount,
                    'payment_method_id' => $card_network,
                    'token' => $card_token,
                    'installments' => 1,
                    'statement_descriptor' => 'Stallion Marroquinería',
                ]);

            if ($response->failed() || $response->clientError() || $response->serverError()) {
                return false;
            }

            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function generate_sales($order_id, $products)
    {
        try {
            foreach ($products as $product) {
                $db_product = Product::findOrFail($product['id']);

                $db_product->stock = $db_product->stock - $product['amount'];

                $db_product->save();

                Sale::create([
                    'sale_order_id' => $order_id,
                    'title' => $db_product->title,
                    'product_id' => $product['id'],
                    'unit_price' => $db_product->price,
                    'amount' => $product['amount'],
                ]);
            }
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }
}
