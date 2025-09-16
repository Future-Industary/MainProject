<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id){
        $product = Product::with(['images','comments.user','category.products'])->findOrFail($id);
        return response()->json(['product'=>$product]);
    }

    public function index(){
        return response()->json(Product::all());

    }

    public function store(Request $request){
        $validated = $request->validate(['title' => 'required|string',
                                         'description' => 'required|srting',
                                         'price' => 'required|numeric',
                                         'category_id' => 'required | exists:categoris,id',
                                         'user_id' => 'required | exists:users,id',
                                        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function update(Request $request,$id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['massage'=>'Product not found'],404);
        }

        $validated = $request->validate(['title' => 'sometimes|string',
                                         'description' => 'nullable|srting',
                                         'price' => 'sometimes|numeric',
                                         'category_id' => 'sometimes | exists:categoris,id',

        ]);

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['massage'=>'Product not found'],404);
        }

        $product->delete();
        return response()->json(['massage'=>'Product deleted']);

    }


    public function approve($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['massage'=>'Product not found'],404);
        }

        $product->is_approved = true;
        $product->save();

        return response()->json(['massage'=>'Product approved']);

    }
    
}
