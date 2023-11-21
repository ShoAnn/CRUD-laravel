<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    // show all products
    public function index(): View
    {
        return view('pages.product.index', [
            'products' => Product::with('images', 'inventory')->get()
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
            'price' => 'required|numeric',
            'sku' => 'required',
            'description' => 'required',
            'product_category_id' => 'required',
        ]);
        $productStock = $request->validate([
            'quantity' => 'required|numeric',
        ]);

        $addProduct = Product::create($productData);

        $productStock['product_id'] = $addProduct->id;

        $addInventory = ProductInventory::create($productStock);

        if (!$addProduct || !$addInventory) {
            return redirect()->route('product.add');
        }
        return redirect()->route('product.index');
    }


    public function edit($id)
    {
        $data = DB::table('products')->where('product_id', $id)->get();
        $data_category = DB::table('product_category')->get();
        $images = DB::table('product_image')->where('product_id', $id)->get();
        return view('pages.product.edit', ['product' => $data[0]], ['categories' => $data_category], ['images' => $images]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'price' => 'required|numeric',
        ]);
        DB::table('products')->where('product_id', $id)->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'unit' => $request->unit,
            'code' => $request->code,
            'stock' => $request->stock,
        ]);
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        DB::table('products')->where('product_id', $id)->delete();
        return redirect()->route('product.index');
    }
}
