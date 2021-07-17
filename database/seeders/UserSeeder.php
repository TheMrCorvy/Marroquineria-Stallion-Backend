<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gonzalo Salvador Corvalán',
            'email' => 'mr.corvy@gmail.com',
            'password' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'Mercedes del Valle Aguirre',
            'email' => 'mercedesdelvalleaguirre@gmail.com',
            'password' => 'admin',
        ]);
    }
}
