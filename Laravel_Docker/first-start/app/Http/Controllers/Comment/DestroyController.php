<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;

class DestroyController extends Controller
{
    public  function __invoke(Comment $comment){
        $comment->delete();
        return redirect()->route('products.show',$comment->product_id);
    }
}
