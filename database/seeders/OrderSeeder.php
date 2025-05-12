<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Order::truncate();
        
        // Get some products and users
        $products = Product::all();
        $users = User::where('id', '>', 1)->get(); // Assuming admin is ID 1
        $shippings = Shipping::all();
        
        if ($products->isEmpty() || $users->isEmpty() || $shippings->isEmpty()) {
            $this->command->info('Skipping OrderSeeder - missing products, users, or shippings');
            return;
        }
        
        $statuses = ['pending', 'accepted', 'rejected'];
        $shippingStatuses = ['pending', 'shipped', 'delivered'];
        $paymentStatuses = ['pending', 'paid'];
        
        for ($i = 0; $i < 20; $i++) {
            $product = $products->random();
            $user = $users->random();
            $shipping = $shippings->random();
            $quantity = rand(1, 5);
            
            $order = Order::create([
                'affiliate_id' => $user->id,
                'product_id' => $product->id,
                'status' => $statuses[array_rand($statuses)],
                'quantity' => $quantity,
                'affiliate_price' => $product->price * (1 - (rand(0, 20) / 100)), // Random discount
                'shipping_id' => $shipping->id,
                'name' => 'عميل ' . ($i + 1),
                'email' => 'customer' . ($i + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'address' => 'عنوان ' . ($i + 1),
                'zip' => rand(10000, 99999),
                'shipping_status' => $shippingStatuses[array_rand($shippingStatuses)],
                'payment_status' => $paymentStatuses[array_rand($paymentStatuses)],
            ]);
            
            // Set dates based on statuses
            if ($order->status != 'pending') {
                $order->handling_date = Carbon::now()->subDays(rand(1, 10));
                $order->save();
            }
            
            if ($order->shipping_status == 'shipped') {
                $order->shipping_date = Carbon::now()->subDays(rand(1, 7));
                $order->save();
            } elseif ($order->shipping_status == 'delivered') {
                $order->shipping_date = Carbon::now()->subDays(rand(3, 10));
                $order->delivery_date = Carbon::now()->subDays(rand(1, 3));
                $order->save();
            }
            
            if ($order->payment_status == 'paid') {
                $order->payment_date = Carbon::now()->subDays(rand(1, 5));
                $order->save();
            }
        }
    }
}