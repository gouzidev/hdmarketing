<?php

namespace Database\Seeders;
use App\Models\Shipping;
use Hash;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->admin()->create([
        //     'name' => 'sgouzi',
        //     'phone' => '0627748714',
        //     'email' => 'salahgouzi11@gmail.com',
        //     'city' => 'sale',
        //     'is_admin' => true,
        //     'verified' => true,
        //     'verified_at' => now(),
        //     'country' => 'MA',
        //     'password' => Hash::make("salahgouzi11@gmail.com"),
        // ]);
       
        // User::factory()->create([
        //     'name' => 'jamal',
        //     'phone' => '0627748714',
        //     'email' => 'jamal@jamal.com',
        //     'city' => 'sale',
        //     'is_admin' => false,
        //     'verified' => false,
        //     'verified_at' => NULL,
        //     'country' => 'TN',
        //     'password' => Hash::make("jamal@jamal.com"),
        // ]);
        Shipping::create([
            'country' => 'ma',
            'city' => 'sale',
            'street' => 'hay rahma',
            'price' => 9.99
        ]);
        Shipping::create([
            'country' => 'ma',
            'city' => 'sale',
            'street' => 'hay karima',
            'price' => 12.99
        ]);
        Shipping::create([
            'country' => 'ma',
            'city' => 'rabat',
            'street' => 'hassan',
            'price' => 15.99
        ]);
        Shipping::create([
            'country' => 'tn',
            'city' => 'tunisie',
            'street' => 'l3rbi',
            'price' => 49.99
        ]);
        Shipping::create([
            'country' => 'tn',
            'city' => 'jerbaa',
            'street' => 'sahil',
            'price' => 59.99
        ]);
        Shipping::create([
            'country' => 'ly',
            'city' => 'tarabulus',
            'street' => 'l8ja3',
            'price' => 89.99
        ]);
        // User::factory()->count(2)->create();
    }
}
