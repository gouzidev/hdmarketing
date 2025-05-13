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
        $this->call([
            UserSeeder::class, // You should have this or create one for users
            ShippingSeeder::class,
        ]);
        
        // Then seed products which depend on users
        $this->call(ProductSeeder::class);
        
        // Finally seed orders which depend on all the above
        $this->call(OrderSeeder::class);
        // User::factory()->count(2)->create();
    }
}
