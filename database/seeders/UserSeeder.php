<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

use Hash; 
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
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mercedes del Valle Aguirre',
            'email' => 'mercedesdelvalleaguirre@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
