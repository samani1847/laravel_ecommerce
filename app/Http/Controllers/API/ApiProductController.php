<?php

namespace OneStop\Http\Controllers\API;

use Illuminate\Http\Request;
use OneStop\Http\Controllers\Controller;
use Modules\Product\Entities\Product;

class ApiProductController extends Controller
{
  
      public function detail($id)
        {
            $product = Product::findorFail($id);
            return response()->json(['data' => $product]);
        }
       
}
