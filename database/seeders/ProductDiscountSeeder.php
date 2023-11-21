<?php

namespace Database\Seeders;

use App\Models\ProductDiscount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDiscount::factory()->count(10)->create();
    }
}
