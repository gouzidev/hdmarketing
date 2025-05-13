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
        Order::truncate();
        
        // Get some products and users
        $products = Product::all();
        $affiliates = User::where('is_admin', false)->get();
        $shippings = Shipping::all();
        
        if ($products->isEmpty() || $affiliates->isEmpty() || $shippings->isEmpty()) {
            $this->command->info('Skipping OrderSeeder - missing products, affiliates, or shippings');
            return;
        }
        
        // Create 50 orders for better analytics testing
        for ($i = 0; $i < 50; $i++) {
            $product = $products->random();
            $affiliate = $affiliates->random();
            $shipping = $shippings->random();
            $quantity = rand(1, 5);
            
            // Create base order with pending status
            $order = Order::create([
                'affiliate_id' => $affiliate->id,
                'product_id' => $product->id,
                'status' => 'pending',
                'quantity' => $quantity,
                'affiliate_price' => $this->calculateAffiliatePrice($product->price),
                'shipping_id' => $shipping->id,
                'name' => 'عميل ' . ($i + 1),
                'email' => 'customer' . ($i + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'address' => 'عنوان ' . ($i + 1),
                'zip' => rand(10000, 99999),
                'shipping_status' => 'pending',
                'payment_status' => 'pending',
                'created_at' => Carbon::now()->subDays(rand(0, 30)), // Spread over 30 days
            ]);
            
            // Progress order through workflow
            $this->progressOrderWorkflow($order);
        }
    }
    
    protected function calculateAffiliatePrice($productPrice)
    {
        // Calculate affiliate price with 10-30% discount from product price
        $discount = rand(10, 30) / 100;
        return $productPrice * (1 + $discount);
    }
    
    protected function progressOrderWorkflow($order)
    {
        $now = Carbon::now();
        
        // 80% chance to be accepted (20% remain pending)
        if (rand(1, 100) <= 80) {
            $order->update([
                'status' => 'accepted',
                'handling_date' => $order->created_at->addHours(rand(1, 24))
            ]);
            
            // 70% chance to be shipped (30% accepted but not shipped yet)
            if (rand(1, 100) <= 70) {
                $order->update([
                    'shipping_status' => 'shipped',
                    'shipping_date' => $order->handling_date->addDays(rand(1, 3))
                ]);
                
                // 80% chance to be delivered (20% shipped but not delivered yet)
                if (rand(1, 100) <= 80) {
                    $order->update([
                        'shipping_status' => 'delivered',
                        'delivery_date' => $order->shipping_date->addDays(rand(1, 5))
                    ]);
                    
                    // 90% chance to be paid if delivered (10% remain unpaid)
                    if (rand(1, 100) <= 90) {
                        $order->update([
                            'payment_status' => 'paid',
                            'payment_date' => $order->delivery_date->addDays(rand(0, 2))
                        ]);
                    }
                }
            }
        }
        
        // 10% chance to be rejected
        elseif (rand(1, 100) <= 10) {
            $order->update([
                'status' => 'rejected',
                'handling_date' => $order->created_at->addHours(rand(1, 24))
            ]);
        }
    }
}