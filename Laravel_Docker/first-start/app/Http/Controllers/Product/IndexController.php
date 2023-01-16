<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public  function __invoke(){
        return view('product.index', ['products'=>Product::all(),]);
    }
}
