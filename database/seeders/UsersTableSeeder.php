<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [//Admin
                'name' => 'Trisha Florez',
                'email' => 'trisha@gmail.com',
                'photo' => 'uploads/admin/c1.jpg',
                'phone' => '09191853030',
                'address' => 'Mabini',
                'password' => Hash::make('111'),
                'role' => 'admin'
            ],
            [//Customer
                'name' => 'Jamaica Ginez',
                'email' => 'jamaica@gmail.com',
                'photo' => 'uploads/admin/c2.jpg',
                'phone' => '09191853030',
                'address' => 'Mabini',
                'password' => Hash::make('111'),
                'role' => 'customer'
            ],
            [//User
                'name' => 'Cherry Ann',
                'email' => 'cherry@gmail.com',
                'photo' => 'uploads/admin/c3.jpg',
                'phone' => '09191853030',
                'address' => 'Mabini',
                'password' => Hash::make('111'),
                'role' => 'user',
            ],
        ]);
    }
}
