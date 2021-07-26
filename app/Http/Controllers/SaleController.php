<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

use Mail;

use App\Models\User;
use App\Models\SaleOrder;
use App\Models\ShippingZone;

use App\Notifications\AskForFund;

use Validator;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->key = config('services.mercadopago.key');
        $this->secret = config('services.mercadopago.secret');
        $this->baseCurrency = config('services.mercadopago.base_currency');

        $this->converter = 'ars';
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

    public function buy(Request $request, $method)
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
                'message' => 'Hubo un error validando los datos enviados. Le recomendamos que vacíe su carrito de compras y vuelva a intentar.'
            ], 400);
        }

        if ($method !== 'mercadopago' && $method !== 'cash') {
            return response()->json([
                'errors' => [
                    'payment_method' => 'invalid payment method'
                ],
                'message' => 'Método de pago incorrecto.'
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

        $payment_method = 'Efectivo en el Local';

        if ($method === 'mercadopago') {
            $payment = $this->call_mercadopago(
                $info['card_network'],
                $info['card_token'],
                $info['email'],
                $info['total_price'],
                $info['shipping_id']
            );

            if ($payment->status !== 'approved') {
                return response()->json([
                    'errors' => [
                        'api_call_unsuccessful' => 'the api responded with a status different from "approved"'
                    ],
                    'message' => 'Hubo un problema procesando tu pago y la compra no pudo ser concretada...'
                ], 500);
            }

            $payment_method = 'MercadoPago';
        }

        $sale_order = SaleOrder::create([
            'date' => now()->format('Y-M-D'),
            'payment_method' => $payment_method,
            'total_price' => $info['total_price'], // más el envio... calcular luego
            'billing_info' => $info['billing_info'],
            'shipping_info' => $info['shipping_info'],
        ]);

        $order_finished = $this->generate_sales($sale_order->id, $info['cart_items']);

        if (!$order_finished) {
            return response()->json([
                'errors' => [
                    'db_connection_unsuccessful' => 'there was an error trying to reduce the stock of some products, or trying to create the sale order'
                ],
                'message' => 'Tu orden de compra no pudo ser finalizada, pero tu pago fue procesado. Te recomendamos que nos contactes para poder ayudarte.'
            ], 500);
        }

        // Mail::to('info@yugiohparaelpueblo.com')->send(new MailPagoFinalRealizado); notificar al usuario sobre su compra

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

    private function call_mercadopago($card_network, $card_token, $email, $total_amount, $shipping_id)
    {
        try {
            $shipping_option = ShippingZone::findOrFail($shipping_id);
        } catch (\Throwable $th) {
            return false;
        }

        return true;
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
