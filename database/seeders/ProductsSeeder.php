<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'shield 24" rojo',
            'description' => ' ',
            'price' => 18890,
            'stock' => 1,
            'brand' => 'samsonite',
            'type' => 'valijas'
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'american tourister',
            'title' => 'instan 24" negro',
            'stock' => 1,
            'price' => 11499,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'american tourister',
            'title' => 'fiyi 24" negro / turquesa',
            'stock' => 1,
            'price' => 11590,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'american tourister',
            'title' => 'curio 25 a negro',
            'stock' => 1,
            'price' => 12999,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'american tourister',
            'title' => 'instant 24 azul',
            'stock' => 1,
            'price' => 11499,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'american tourister',
            'title' => 'sunside 28" negro',
            'stock' => 1,
            'price' => 13990,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'american tourister',
            'title' => 'sunside 24" violeta',
            'stock' => 1,
            'price' => 13490,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'funk negro',
            'stock' => 2,
            'price' => 7690,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'funk violeta',
            'stock' => 1,
            'price' => 7690,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'conor negro',
            'stock' => 2,
            'price' => 9490,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'bison negro',
            'stock' => 1,
            'price' => 6990,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'bison menta',
            'stock' => 1,
            'price' => 6990,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'bravo negro',
            'stock' => 2,
            'price' => 9390,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'samsonite',
            'title' => 'orion violeta',
            'stock' => 1,
            'price' => 6590,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'monsta 077 gris',
            'stock' => 1,
            'price' => 5890,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'linx 072 rojo',
            'stock' => 1,
            'price' => 6390,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'force 055 lurex',
            'stock' => 1,
            'price' => 5290,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'power 011 hearts blue',
            'stock' => 1,
            'price' => 4390,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'power 011 unicorn llama',
            'stock' => 1,
            'price' => 3290,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'power 011 shiny dreams',
            'stock' => 1,
            'price' => 3290,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'power 011 rainbow hair',
            'stock' => 1,
            'price' => 3290,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'spark 017 hexagonal cosmoBlue',
            'stock' => 1,
            'price' => 4490,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme c / ruedas',
            'title' => 'shuttle 097 shiny pink',
            'stock' => 1,
            'price' => 10090,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme c / ruedas',
            'title' => 'mountain 057 negro',
            'stock' => 2,
            'price' => 6390,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'rider 055 petrol blue',
            'stock' => 3,
            'price' => 5290,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'rider 055 negro',
            'stock' => 1,
            'price' => 5290,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'xtreme',
            'title' => 'traveler 059 black orange',
            'stock' => 1,
            'price' => 6390,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'delsey',
            'title' => 'belfort plus cabina rojo',
            'stock' => 1,
            'price' => 16400,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'delsey',
            'title' => 'esplande noir profond negro',
            'stock' => 1,
            'price' => 9790,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'delsey',
            'title' => 'esplande noir profond negro 1',
            'stock' => 1,
            'price' => 11300,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'parvis noir negro',
            'stock' => 1,
            'price' => 9790,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'esplande noir profond negro',
            'stock' => 1,
            'price' => 7550,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'esplande noir profond negro',
            'stock' => 1,
            'price' => 7590,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'picpus noir negro',
            'stock' => 1,
            'price' => 6350,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'picpus noir negro',
            'stock' => 1,
            'price' => 6730,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'picpus noir negro',
            'stock' => 1,
            'price' => 5540,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'beauty case two compartments negro',
            'stock' => 1,
            'price' => 2930,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'delsey',
            'title' => 'accesory 2,0 negro',
            'stock' => 1,
            'price' => 3250,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'no disponible',
            'title' => 'portanotebook gris',
            'stock' => 2,
            'price' => 4200,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'no disponible',
            'title' => 'portanotebook gris',
            'stock' => 6,
            'price' => 4200,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'no disponible',
            'title' => 'portanotebook negro',
            'stock' => 1,
            'price' => 4848,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'no disponible',
            'title' => 'portanotebook morral / mensajero negro',
            'stock' => 1,
            'price' => 5636,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafiolios',
            'brand' => 'no disponible',
            'title' => 'portanotebook casual / mensajero negro',
            'stock' => 1,
            'price' => 6460,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'no disponible',
            'title' => 'mochila alta gris oscuro',
            'stock' => 3,
            'price' => 7699,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'mochilas',
            'brand' => 'no disponible',
            'title' => 'mochila alta gris claro',
            'stock' => 3,
            'price' => 7699,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'no disponible',
            'title' => 'hakone cabina negro',
            'stock' => 1,
            'price' => 10962,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'no disponible',
            'title' => 'hakone cabina turquesa',
            'stock' => 1,
            'price' => 10962,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'valijas',
            'brand' => 'no disponible',
            'title' => 'nassau cabina rojo',
            'stock' => 1,
            'price' => 9937,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'nancy azul',
            'stock' => 1,
            'price' => 9855,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'merida bordó',
            'stock' => 1,
            'price' => 3599,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'bilbao azul',
            'stock' => 2,
            'price' => 4900,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'ontario negro',
            'stock' => 1,
            'price' => 2045,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'try negro',
            'stock' => 1,
            'price' => 4999,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'try rojo / negro',
            'stock' => 1,
            'price' => 4999,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'try rojo / negro',
            'stock' => 1,
            'price' => 6705,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'try negro',
            'stock' => 1,
            'price' => 7040,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'bolsos',
            'brand' => 'no disponible',
            'title' => 'ontario negro',
            'stock' => 1,
            'price' => 3799,
            'description' => ' ',
        ]);
        DB::table('products')->insert([
            'type' => 'portafolio',
            'brand' => 'no disponible',
            'title' => 'endos portalaptop negro',
            'stock' => 2,
            'price' => 5100,
            'description' => ' ',
        ]);
    }
}
