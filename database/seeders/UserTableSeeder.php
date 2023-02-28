<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('1111'),
                'status' => 'active'
            ],
            //Vendor
            [
                'name' => 'Vendor',
                'username' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'role' => 'vendor',
                'password' => Hash::make('1111'),
                'status' => 'active'
            ],
            //user or cutsomer
            [
                'name' => 'User',
                'username' => 'User',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'password' => Hash::make('1111'),
                'status' => 'active'
            ],
        ]);
    }
}
