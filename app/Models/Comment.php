<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
