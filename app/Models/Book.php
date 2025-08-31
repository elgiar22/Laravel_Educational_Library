<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "title" , "desc" , "image" , "price" ,"category_id" , "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

        public function category(){
        return $this->belongsTo(Category::class);
    }
}
