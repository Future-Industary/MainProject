<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id){
        $product = Product::with(['images','comments.user','category.products'])->findOrFail($id);
        return response()->json(['product'=>$product,]);
    }
    
}
