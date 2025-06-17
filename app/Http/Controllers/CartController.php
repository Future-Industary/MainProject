<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id){
        return response()->json(['message'=>'Project added to cart!']);
        
    }
    
}
