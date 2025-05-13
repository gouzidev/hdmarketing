<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Product::truncate();
        // ProductImage::truncate();

        if (!Storage::disk('private')->exists('products')) {
            Storage::disk('private')->makeDirectory('products');
        }

        $products = [
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'قميص رجالي قطني',
                'category' => 'clothes',
                'desc' => 'قميص رجالي عالي الجودة من القطن المصري',
                'stock' => 50,
                'price' => 120,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'جينز أزرق',
                'category' => 'clothes',
                'desc' => 'بنطال جينز رجالي بجودة عالية',
                'stock' => 35,
                'price' => 200,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'عباية سوداء',
                'category' => 'clothes',
                'desc' => 'عباية نسائية أنيقة مع تطريز',
                'stock' => 25,
                'price' => 350,
            ],

            // Kitchen & Home (المنزل والمطبخ)
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'خلاط كهربائي',
                'category' => 'kitchen_home',
                'desc' => 'خلاط سريع بقوة 800 وات',
                'stock' => 30,
                'price' => 250,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'طقم صحون',
                'category' => 'kitchen_home',
                'desc' => 'طقم صحون سيراميك 32 قطعة',
                'stock' => 15,
                'price' => 180,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'ماكينة صنع القهوة',
                'category' => 'kitchen_home',
                'desc' => 'ماكينة صنع القهوة الأتوماتيكية',
                'stock' => 20,
                'price' => 400,
            ],

            // Beauty & Health (الصحة والجمال)
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'عطر رجالي',
                'category' => 'beauty_health',
                'desc' => 'عطر رجالي برائحة خشبية',
                'stock' => 40,
                'price' => 300,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'مجفف شعر',
                'category' => 'beauty_health',
                'desc' => 'مجفف شعر بقوة 2000 وات',
                'stock' => 25,
                'price' => 150,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'كريم ترطيب',
                'category' => 'beauty_health',
                'desc' => 'كريم ترطيب يومي للبشرة',
                'stock' => 60,
                'price' => 80,
            ],

            // Electronics (هواتف وأجهزة ذكية)
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'هاتف ذكي',
                'category' => 'electronics',
                'desc' => 'هاتف ذكي بذاكرة 128GB',
                'stock' => 20,
                'price' => 2500,
            ],
            [
                'user_id' => User::where('is_admin', true)->get()->random()->id,
                'name' => 'سماعات لاسلكية',
                'category' => 'electronics',
                'desc' => 'سماعات بلوتوث عالية الجودة',
                'stock' => 31,
                'price' => 350,
            ],

        ];

        foreach ($products as $productData) {
            $product = Product::create($productData);
            $productDir = "products/{$product->id}";
            Storage::disk('private')->makeDirectory($productDir);

            // Primary image
            $this->createLocalImage("{$productDir}/primary.jpg", $productData['name'], $productData['category']);

            ProductImage::create([
                'product_id' => $product->id,
                'path' => "{$productDir}/primary.jpg",
                'is_primary' => true,
                'display_order' => 0,
            ]);

            // Additional images (2-4)
            for ($i = 1; $i <= rand(2, 4); $i++) {
                $this->createLocalImage("{$productDir}/image_{$i}.jpg", $productData['name']." $i", $productData['category']);

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => "{$productDir}/image_{$i}.jpg",
                    'is_primary' => false,
                    'display_order' => $i,
                ]);
            }
        }
    }

    protected function createLocalImage($path, $text, $category)
    {
        $width = 800;
        $height = 600;
        
        // Create image based on category
        $image = imagecreatetruecolor($width, $height);
        
        // Set background color based on category
        $bgColor = match($category) {
            'clothes' => imagecolorallocate($image, rand(150, 255), rand(100, 200), rand(100, 200)),
            'kitchen_home' => imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(150, 200)),
            default => imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200)),
        };
        
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
        
        // Add text
        $textColor = imagecolorallocate($image, 0, 0, 0);
        imagestring(
            $image, 
            5, 
            $width/2 - (strlen($text)*7), 
            $height/2, 
            substr($text, 0, 30), 
            $textColor
        );
        
        // Save image
        imagejpeg($image, Storage::disk('private')->path($path));
        imagedestroy($image);
    }
}