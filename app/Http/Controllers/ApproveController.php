<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ApproveController extends Controller
{
    public function approve($id) {
        $product = Product::findOrFail($id);
        $product->is_approved = true;
        $product->save();

        return response()->json(['message' => 'The product is approved!']);
    }
}
