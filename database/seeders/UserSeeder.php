<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users
        // User::truncate();

        // Create admin user
        User::create(
            [
                'name' => fake()->name(),
                'email' => "abdo@abdo.com",
                'phone' => fake()->phoneNumber(),
                'city' => fake()->city(),
                'is_admin' => true,
                'verified' => true,
                'verified_at' => fake()->time(),
                'country' => Str::lower(fake()->countryCode()),
                'password' => Hash::make("abdo@abdo.com"),
            ]
            );

        User::create([
            'name' => 'sgouzi',
            'phone' => '0627748714',
            'email' => 'salahgouzi11@gmail.com',
            'city' => 'sale',
            'is_admin' => true,
            'verified' => true,
            'verified_at' => fake()->time(),
            'country' => 'ma',
            'password' => Hash::make("salahgouzi11@gmail.com"),
        ]);
       
        for ($i = 0 ; $i < 10; $i++)
        {
            $email = fake()->email();
            $isverified = fake()->boolean();
            User::create([
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'email' => $email,
                'city' => fake()->city(),
                'is_admin' => false,
                'verified' => $isverified,
                'verified_at' => $isverified ? now() : NULL,
                'country' => 'tn',
                'password' => Hash::make($email),
            ]);
        }
    
    }
}