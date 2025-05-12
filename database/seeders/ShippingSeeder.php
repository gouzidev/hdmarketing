<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    public function run()
    {
        // Shipping::truncate();
        
        $shippings = [
            ['country' => 'السعودية', 'city' => 'الرياض', 'street' => 'شارع الملك فهد', 'price' => 20],
            ['country' => 'السعودية', 'city' => 'جدة', 'street' => 'شارع التحلية', 'price' => 25],
            ['country' => 'مصر', 'city' => 'القاهرة', 'street' => 'شارع التحرير', 'price' => 30],
            ['country' => 'الإمارات', 'city' => 'دبي', 'street' => 'شارع الشيخ زايد', 'price' => 35],
        ];
        
        foreach ($shippings as $shipping) {
            Shipping::create($shipping);
        }
    }
}