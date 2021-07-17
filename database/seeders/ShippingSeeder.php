<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_methods')->insert([
            'method' => 'Lo retiraré en el local'
        ]);
        DB::table('shipping_methods')->insert([
            'method' => 'Moto Mensajera'
        ]);

        DB::table('shipping_zones')->insert([
            'shipping_method_id' => 1,
            'region' => 'Direción del Local: San José 155, Ciudad Autónoma de Buenos Aires',
            'delay' => 'No hay.',
            'price' => 'Sin Costo.',
            'actual_price' => 0,
        ]);
        
        DB::table('shipping_zones')->insert([
            'shipping_method_id' => 2,
            'region' => 'Ciudad Autónoma de Buenos Aires',
            'delay' => 'De 1 a 3 días hábiles.',
            'price' => '$ 500',
            'actual_price' => 500,
        ]);
        DB::table('shipping_zones')->insert([
            'shipping_method_id' => 2,
            'region' => 'Provincia / Gran Buenos Aires',
            'delay' => 'De 1 a 5 días hábiles.',
            'price' => '$ 900',
            'actual_price' => 900
        ]);
    }
}
