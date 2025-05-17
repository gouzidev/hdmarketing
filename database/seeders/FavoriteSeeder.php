<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    public function run()
    {
        // Get all users and products
        $users = User::all();
        $products = Product::all();
        
        // Each user gets random favorites
        foreach ($users as $user) {
            // Choose random products to favorite (between 1-5 products)
            $randomProducts = $products->random(rand(1, 5));
            
            foreach ($randomProducts as $product) {
                Favorite::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ]);
            }
        }
    }
}