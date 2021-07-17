<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductsSeeder::class);
        $this->call(ImagesSeeder::class);
        $this->call(ShippingSeeder::class);
        $this->call(UserSeeder::class);
    }
}
