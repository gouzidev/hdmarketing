<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users
        // User::truncate();

        // Create admin user
        // User::create([
        //     'name' => 'sgouzi',
        //     'phone' => '0627748714',
        //     'email' => 'salahgouzi11@gmail.com',
        //     'city' => 'sale',
        //     'is_admin' => true,
        //     'verified' => true,
        //     'verified_at' => now(),
        //     'country' => 'ma',
        //     'password' => Hash::make("salahgouzi11@gmail.com"),
        // ]);
       
        // User::create([
        //     'name' => 'jamal',
        //     'phone' => '0627748714',
        //     'email' => 'jamal@jamal.com',
        //     'city' => 'sale',
        //     'is_admin' => false,
        //     'verified' => true,
        //     'verified_at' => NULL,
        //     'country' => 'tn',
        //     'password' => Hash::make("jamal@jamal.com"),
        // ]);

        // Create some affiliate users
    
    }
}