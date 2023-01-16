<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class StoreController extends Controller
{
    public  function __invoke(){
        $data=request()->validate(
            [
                'model'=>'string',
                'price'=>'int',
                'image'=>'string',
                'category_id'=>'',
            ]
        );
        $product=Product::create($data);
        return redirect()->route('products.index');
    }
}
