<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class StoreController extends Controller
{
    public  function __invoke(){
        $data=request()->validate(
            [
                'user'=>'string',
                'text'=>'string',
                'product_id'=>'',
            ]
        );
        $comment=Comment::create($data);
        return redirect()->route('products.show',$comment->product_id);
    }
}
