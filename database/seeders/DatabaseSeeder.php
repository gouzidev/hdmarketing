<?php

namespace Database\Seeders;
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

        User::factory()->admin()->create([
            'name' => 'sgouzi',
            'phone' => '0627748714',
            'email' => 'salahgouzi11@gmail.com',
            'city' => 'sale',
            'is_admin' => true,
            'verified' => true,
            'verified_at' => now(),
            'country' => 'MA',
            'password' => Hash::make("salahgouzi11@gmail.com"),
        ]);
        User::factory()->admin()->create([
            'name' => 'salah',
            'phone' => '0627748714',
            'email' => 'salah@gouzi.com',
            'city' => 'sale',
            'is_admin' => true,
            'verified' => true,
            'verified_at' => now(),
            'country' => 'MA',
            'password' => Hash::make("salah@gouzi.com"),
        ]);
        User::factory()->create([
            'name' => 'salah',
            'phone' => '0627748714',
            'email' => 'sgouzi@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("sgouzi@gmail.com"),
        ]);
        User::factory()->create([
            'name' => 'test',
            'phone' => '0627748714',
            'email' => 'test@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("test@gmail.com"),
        ]);
        User::factory()->create([
            'name' => 'test1',
            'phone' => '0627748714',
            'email' => 'test1@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("test1@gmail.com"),
        ]);
        User::factory()->create([
            'name' => 'test2',
            'phone' => '0627748714',
            'email' => 'test2@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("test2@gmail.com"),
        ]);
        User::factory()->create([
            'name' => 'test3',
            'phone' => '0627748714',
            'email' => 'test3@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("test3@gmail.com"),
        ]);
        User::factory()->create([
            'name' => 'test4',
            'phone' => '0627748714',
            'email' => 'test4@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("test4@gmail.com"),
        ]);
        User::factory()->create([
            'name' => 'test5',
            'phone' => '0627748714',
            'email' => 'test5@gmail.com',
            'city' => 'sale',
            'is_admin' => false,
            'verified' => false,
            'verified_at' => NULL,
            'password' => Hash::make("test5@gmail.com"),
        ]);
        User::factory()->count(10)->create();
    }
}
