<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 59; $i++) {
            DB::table('images')->insert([
                'img_url' => 'https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg',
                'product_id' => $i
            ]);
        }
    }
}
