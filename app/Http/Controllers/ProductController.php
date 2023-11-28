<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Resources\ProductCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    // show all products
    public function index(): View
    {
        return view('pages.product.index', [
            'products' => new ProductCollection(Product::with('images', 'inventory')->get())
        ]);
    }

    public function add()
    {
        return view('pages.product.add', ['categories' => ProductCategory::all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $productData = $request->validate([
            'name' => 'required|max:255|min:5',
            'description' => 'required',
            'sku' => 'required',
            'unit' => 'string',
            'price' => 'required|numeric',
            'product_category_id' => 'required',
        ]);
        $productStock = $request->validate([
            'quantity' => 'required|numeric',
        ]);
        $productImage = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        // store product in products table
        $addProduct = Product::create($productData);

        // store product images in product_images table
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $addImage = ProductImage::create([
                    'product_id' => $addProduct->id,
                    'name' => $path
                ]);
            }
        }

        // store product quantity in product_inventories table
        $productStock['product_id'] = $addProduct->id;
        $addInventory = ProductInventory::create($productStock);

        if (!$addProduct || !$addInventory) {
            toast('Gagal menambahkan produk!', 'error');
            return redirect()->route('product.add')->with('error', 'Product add failed');
        }
        toast('Sukses menambahkan produk!', 'success')->width('24rem')->background('#050505');
        return redirect()->route('product.index');
    }


    public function edit(Product $product)
    {
        return view('pages.product.edit', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $productData = $request->validate([
            'name' => 'required|max:255|min:5',
            'price' => 'required|numeric',
            'sku' => 'required',
            'unit' => 'string',
            'description' => 'required',
            'product_category_id' => 'required',
        ]);
        $productStock = $request->validate([
            'quantity' => 'required|numeric',
        ]);

        // update product in products table
        $updateProduct = $product->update($productData);
        $updateQuantity = $product->inventory->update($productStock);

        if (!$updateProduct || !$updateQuantity) {
            toast('Gagal mengubah produk!', 'error')->width('24rem')->background('#050505');
            return redirect()->route('product.edit', $product->id)->with('error', 'Product update failed');
        }
        toast('Sukses mengubah produk!', 'success')->width('24rem')->background('#050505');
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
