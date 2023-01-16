<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;

class ShowController extends Controller
{
    public  function __invoke(Product $product){
        $comments=$product->comments();
        return view('product.show',compact('product','comments'));
    }
}
