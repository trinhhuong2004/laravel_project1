<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Xóa dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();

        // Seed Product Sizes
        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $item){
            ProductSize::query()->create([
                'name' => $item
            ]);
        }

        // Seed Product Colors
        foreach (['Black', 'White', 'Gray', 'Blue', 'Yellow', 'Red'] as $item){
            ProductColor::query()->create([
                'name' => $item
            ]);
        }

        // Seed Products
        for ($i = 0; $i < 100; $i++){
            $name = $faker->text(20); // Sử dụng faker để tạo tên sản phẩm

            Product::query()->create([
                'category_id' => rand(5, 9),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'img_thumb' => 'https://via.placeholder.com/150',
                'price' => 100000,
                'price_sale' => 20000,
                'material' => $faker->word,
                'description' => $faker->sentence,
                'use_manual' => $faker->paragraph,
            ]);
        }
        for ($i = 0; $i<101; $i++){
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://www.vietnamworks.com/hrinsider/wp-content/uploads/2023/12/hinh-thien-nhien-3d-002.jpg'

                ],
                [
                    'product_id' => $i,
                    'image' => 'https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/07/hinh-dep.jpg'

                ],
            ]);
        }
    }
}
