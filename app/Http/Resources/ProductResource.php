<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'unit' => $this->unit,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->product_category_id,
            'images' => $this->images,
            'inventory' => $this->inventory,
        ];
    }
}
