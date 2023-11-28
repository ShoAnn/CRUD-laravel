<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(ProductInventory::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
