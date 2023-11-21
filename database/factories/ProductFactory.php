<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\ProductDiscount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sku' => fake()->uuid(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 1000, 100000),
            'product_category_id' => fake()->numberBetween(1, ProductCategory::count()),
            'product_discount_id' => fake()->numberBetween(1, ProductDiscount::count()),
        ];
    }
}
