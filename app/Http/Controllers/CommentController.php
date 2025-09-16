<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function index($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product->comments); // چون رابطه hasMany داریم
    }

    
    public function store(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->user_id = $validated['user_id'];
        $comment->product_id = $productId;
        $comment->content = $validated['content'];
        $comment->save();

        return response()->json($comment, 201);
    }

    
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json($comment);
    }

    
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}