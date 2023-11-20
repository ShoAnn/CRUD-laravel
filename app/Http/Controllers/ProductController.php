<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    // show all products
    public function index(): View
    {
        // $data = DB::table('products')->paginate(10);
        // $images = DB::table('product_image')->get();
        // return view('pages.product.index', ['products' => $data], ['images' => $images]);

        return view('pages.product.index', [
            'products' => Product::with('images')->paginate(10)
        ]);
    }

    public function add()
    {
        $category = DB::table('product_category')->get();
        return view('pages.product.add', ['categories' => $category]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'price' => 'required|numeric',
            'unit' => 'required',
            'code' => 'required',
        ]);

        $add = DB::table('products')->insert([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'unit' => $request->unit,
            'code' => $request->code,
            'stock' => $request->stock,
        ]);
        if (!$add) {
            return redirect()->route('product.index')->with('error', 'Product failed to add');
        }
        return redirect()->route('product.index')->with('success', 'Product added successfully');
    }

    public function store_image(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'required|mimes:jpg,jpeg,gif,png',
        ]);
        if ($request->file('images')) {
            foreach ($request->file('images') as $key => $file) {
                $file_name = time() . "_" . '.' . $file->extension();
                $file->move(public_path('uploads'), $file_name);
                $images[]['name'] = $file_name;
            }
        }

        foreach ($images as $key => $file) {
            DB::table('product_image')->insert([
                'product_id' => $id,
                'file_name' => $file['name'],
                'file_type' => 'image',
            ]);
        }
        return redirect()->route('product.index')->with('success', 'Image uploaded successfully');
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
