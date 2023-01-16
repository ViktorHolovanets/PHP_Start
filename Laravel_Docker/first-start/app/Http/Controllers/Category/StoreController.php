<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class StoreController extends Controller
{
    public  function __invoke(){
        $data=request()->validate(
            [
                'name'=>'string',
            ]
        );
        $category=Category::create($data);
        return redirect()->route('categories.index');
    }
}
