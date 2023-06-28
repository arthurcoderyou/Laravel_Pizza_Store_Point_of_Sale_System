<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'user_id' => '1',
                'menu_id' => '1',
                'quantity' => 3
            ],
            [
                'user_id' => '1',
                'menu_id' => '2',
                'quantity' => 4
            ],
            [
                'user_id' => '1',
                'menu_id' => '3',
                'quantity' => 5
            ],
        ]);
    }
}
