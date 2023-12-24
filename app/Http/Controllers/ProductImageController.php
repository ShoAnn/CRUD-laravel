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
            'product_id' => 'required'
        ]);

        // store product images in product_images table
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'local');
                $addImage = ProductImage::create([
                    'product_id' => $productImage['product_id'],
                    'name' => $path
                ]);
            }
        }

        toast('Sukses menambahkan gambar produk!', 'success')->width('24rem')->background('#050505');
        return redirect()->back();
    }

    public function destroy(ProductImage $image)
    {
        $image->delete();
        toast('Sukses menghapus gambar produk!', 'success')->width('24rem')->background('#050505');
        return redirect()->back();
    }
}
