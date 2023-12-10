<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics and Gadgets',
                'description' => 'Smartphones, laptops, cameras, headphones, smartwatches, and other electronic devices.',
            ],
            [
                'name' => 'Fashion and Apparel',
                'description' => 'Clothing, shoes, accessories, and fashion items for men, women, and children.',
            ],
            [
                'name' => 'Home and Furniture',
                'description' => 'Furniture, home decor, bedding, kitchenware, and appliances.',
            ],
            [
                'name' => 'Beauty and Personal Care',
                'description' => 'Skincare products, makeup, haircare items, grooming tools, and fragrances.',
            ],
            [
                'name' => 'Books and Educational Materials',
                'description' => 'Physical books, eBooks, educational courses, and study materials.',
            ],
            [
                'name' => 'Sports and Outdoors',
                'description' => 'Sports equipment, activewear, outdoor gear, and accessories.',
            ],
            [
                'name' => 'Toys and Games',
                'description' => 'Toys for children, board games, video games, and gaming accessories.',
            ],
            [
                'name' => 'Health and Wellness',
                'description' => 'Vitamins, supplements, fitness equipment, and health-related products.',
            ],
            [
                'name' => 'Groceries and Food Items',
                'description' => 'Online grocery shopping, specialty foods, and gourmet products.',
            ],
            [
                'name' => 'Jewelry and Accessories',
                'description' => 'Rings, necklaces, bracelets, and other jewelry items.',
            ],
        ];

        ProductCategory::withoutEvents(function () use ($categories) {
            ProductCategory::insert($categories);
        });
    }
}
