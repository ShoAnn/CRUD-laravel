<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // show all products
    public function index()
    {
        $data = DB::table('products')->get();
        return view('pages.product.index', ['products' => $data]);
    }
}
