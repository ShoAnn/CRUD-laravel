<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('inventory_id')->references('id')->on('product_inventories');
            $table->foreign('discount_id')->references('id')->on('product_discounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_table');
    }
};
