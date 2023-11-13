<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // show all products
    public function index()
    {
        return view('pages.product.index');
    }
}
