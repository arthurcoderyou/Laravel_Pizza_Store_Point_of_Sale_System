<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for($i = 0;$i < 5;$i++){
            //create dummy order for this day
            DB::table('orders')->insert([
                [
                    'user_id' => '1',
                    'total_payment' => fake()->numberBetween($min = 1000, $max = 9000),
                    'status' => 'completed',
                    'created_at' => now(),
                    'shipping_status' => 'completed'
                ]
            ]);
        }

        for($i = 0;$i < 5;$i++){
            //create dummy order for this day
            DB::table('orders')->insert([
                [
                    'user_id' => '2',
                    'total_payment' => fake()->numberBetween($min = 1000, $max = 9000),
                    'status' => 'completed',
                    'created_at' => now()->month(),
                    'shipping_status' => 'completed'
                ]
            ]);
        }

        for($i = 0;$i < 5;$i++){
            //create dummy order for this day
            DB::table('orders')->insert([
                [
                    'user_id' => '3',
                    'total_payment' => fake()->numberBetween($min = 1000, $max = 9000),
                    'status' => 'completed',
                    'created_at' => now()->startOfWeek(),
                    'shipping_status' => 'completed'
                ]
            ]);
        }

        for($i = 0;$i < 5;$i++){
            //create dummy order for this day
            DB::table('orders')->insert([
                [
                    'user_id' => '1',
                    'total_payment' => fake()->numberBetween($min = 1000, $max = 9000),
                    'status' => 'completed',
                    'created_at' => now()->endOfWeek(),
                    'shipping_status' => 'completed'
                ]
            ]);
        }

        
    }
}
