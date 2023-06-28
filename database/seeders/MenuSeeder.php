<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'name' => 'Pizza Maria',
                'photo' => 'menus/p1.jpg',
                'price' => 120,
                'stocks' => 22,
                'available' => true
            ],
            [
                'name' => 'Pizza China',
                'photo' => 'menus/p2.jpg',
                'price' => 300,
                'stocks' => 20,
                'available' => true
            ],
            [
                'name' => 'Pizza Hot n Mix',
                'photo' => 'menus/p3.jpg',
                'price' => 340,
                'stocks' => 18,
                'available' => true
            ],
            [
                'name' => 'Pizza Almonte',
                'photo' => 'menus/p4.jpg',
                'price' => 500,
                'stocks' => 44,
                'available' => true
            ],
            [
                'name' => 'Pizza Zagaria',
                'photo' => 'menus/p5.jpg',
                'price' => 200,
                'stocks' => 32,
                'available' => true
            ],
            
        ]);
    }
}
