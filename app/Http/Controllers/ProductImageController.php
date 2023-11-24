<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {

        $productImage = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        dd($request->all());
        // store product images in product_images table
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $addImage = ProductImage::create([
                    'product_id' => $productImage['product_id'],
                    'name' => $path
                ]);
            }
        }

        toast('Product image(s) added successfully!', 'success');
        return redirect()->back();
    }

    public function destroy(ProductImage $image)
    {
        $image->delete();
        toast('Product image deleted successfully!', 'success');
        return redirect()->back();
    }
}
