<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class UpdateController extends Controller
{
    public  function __invoke(Product $product){
        $data=request()->validate(
            [
                'model'=>'string',
                'price'=>'',
                'category_id'=>'',
            ]
        );
        $product->update($data);
        return redirect()->route('products.index');
    }
}
