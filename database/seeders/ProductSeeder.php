<?php

namespace Database\Seeders;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Database\Seeders\Traits\HasProductSeeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends BaseSeeder
{
    use HasProductSeeder;

    public function run(): void
    {
        $this->uploadFiles('products');

        $products = [
            [
                'name' => 'Smart Home Speaker',
                'is_featured' => true,
            ],
            [
                'name' => 'Headphone Ultra Bass',
                'is_featured' => true,
            ],
            [
                'name' => 'Boxed - Bluetooth Headphone',
                'is_featured' => true,
            ],
            [
                'name' => 'Chikie - Bluetooth Speaker',
                'is_featured' => true,
            ],
            [
                'name' => 'Camera Hikvision HK-35VS8',
                'is_featured' => true,
            ],
            [
                'name' => 'Camera Samsung SS-24',
                'is_featured' => true,
            ],
            [
                'name' => 'Leather Watch Band',
                'is_featured' => true,
            ],
            [
                'name' => 'Apple iPhone 13 Plus',
                'is_featured' => true,
            ],
            [
                'name' => 'Macbook Pro 2015',
                'is_featured' => true,
            ],
            [
                'name' => 'Macbook Air 12 inch',
                'is_featured' => true,
            ],
            [
                'name' => 'Apple Watch Serial 7',
                'is_featured' => true,
            ],
            [
                'name' => 'Macbook Pro 13 inch',
                'is_featured' => true,
            ],
            [
                'name' => 'Apple Keyboard',
                'is_featured' => true,
            ],
            [
                'name' => 'MacSafe 80W',
                'is_featured' => true,
            ],
            [
                'name' => 'Hand playstation',
                'is_featured' => true,
            ],
            [
                'name' => 'Apple Airpods Serial 3',
                'is_featured' => true,
            ],
            [
                'name' => 'Cool Smart Watches',
                'is_featured' => true,
            ],
            [
                'name' => 'Black Smart Watches',
                'is_featured' => true,
            ],
            [
                'name' => 'Leather Watch Band Serial 3',
                'is_featured' => true,
            ],
            [
                'name' => 'Macbook Pro 2015 13 inch',
                'is_featured' => true,
            ],
            [
                'name' => 'Historic Alarm Clock',
                'is_featured' => true,
            ],
            [
                'name' => 'Black Glasses',
                'is_featured' => true,
            ],
            [
                'name' => 'Phillips Mouse',
                'is_featured' => true,
            ],
            [
                'name' => 'Gaming Keyboard',
                'is_featured' => true,
            ],
            [
                'name' => 'Dual Camera 20MP',
            ],
            [
                'name' => 'Smart Watches',
            ],
            [
                'name' => 'Beat Headphone',
            ],
            [
                'name' => 'Red & Black Headphone',
            ],
            [
                'name' => 'Audio Equipment',
            ],
            [
                'name' => 'Smart Televisions',
            ],
            [
                'name' => 'Samsung Smart TV',
            ],
        ];

        foreach ($products as $key => &$item) {
            $item['description'] = '<p>Short Hooded Coat features a straight body, large pockets with button flaps, ventilation air holes, and a string detail along the hemline.</p>';
            $item['content'] = '<p>Short Hooded Coat features a straight body, large pockets with button flaps, ventilation air holes, and a string detail along the hemline. The style is completed with a drawstring hood, featuring Rains&rsquo; signature built-in cap. Made from waterproof, matte PU, this lightweight unisex rain jacket is an ode to nostalgia through its classic silhouette and utilitarian design details.</p>
                                <p>- Casual unisex fit</p>

                                <p>- 64% polyester, 36% polyurethane</p>

                                <p>- Water column pressure: 4000 mm</p>

                                <p>- Model is 187cm tall and wearing a size S / M</p>

                                <p>- Unisex fit</p>

                                <p>- Drawstring hood with built-in cap</p>

                                <p>- Front placket with snap buttons</p>

                                <p>- Ventilation under armpit</p>

                                <p>- Adjustable cuffs</p>

                                <p>- Double welted front pockets</p>

                                <p>- Adjustable elastic string at hempen</p>

                                <p>- Ultrasonically welded seams</p>

                                <p>This is a unisex item, please check our clothing &amp; footwear sizing guide for specific Rains jacket sizing information. RAINS comes from the rainy nation of Denmark at the edge of the European continent, close to the ocean and with prevailing westerly winds; all factors that contribute to an average of 121 rain days each year. Arising from these rainy weather conditions comes the attitude that a quick rain shower may be beautiful, as well as moody- but first and foremost requires the right outfit. Rains focus on the whole experience of going outside on rainy days, issuing an invitation to explore even in the most mercurial weather.</p>';
            $item['status'] = BaseStatusEnum::PUBLISHED;
            $item['sku'] = 'HS-' . fake()->numberBetween(100, 200);
            $item['brand_id'] = fake()->numberBetween(1, 7);
            $item['tax_id'] = 1;
            $item['views'] = fake()->numberBetween(1000, 200000);
            $item['quantity'] = fake()->numberBetween(10, 20);
            $item['length'] = fake()->numberBetween(10, 20);
            $item['wide'] = fake()->numberBetween(10, 20);
            $item['height'] = fake()->numberBetween(10, 20);
            $item['weight'] = fake()->numberBetween(500, 900);
            $item['with_storehouse_management'] = true;

            $images = [];

            for ($i = 1; $i <= 10; $i++) {
                if (File::exists(database_path('seeders/files/products/' . ($key + 1) . '-' . $i . '.jpg'))) {
                    $images[] = 'products/' . ($key + 1) . '-' . $i . '.jpg';
                }
            }

            $item['images'] = json_encode($images);
        }

        $this->createProducts($products);
    }
}
