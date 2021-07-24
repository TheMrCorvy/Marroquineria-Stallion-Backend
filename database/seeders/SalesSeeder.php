<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale_orders')->insert([
            'date' => now(),
            'payment_method' => 'MercadoPago',
            'total_price' => '80000.92',
        ]);

        DB::table('sales')->insert([
            'sale_order_id' => 1,
            'title' => 'titulo del producto',
            'product_id' => 1,
            'unit_price' => 10000,
            'amount' => 2
        ]);
    }
}
