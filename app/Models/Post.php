<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

     protected $date = ['deleted_at'];

      protected $fillable = [
        "title",
        "body",
        "user_id"
    ];

    public function user(){
       return $this->belongsTo(User::class);
    }
    public function category(){
       return $this->belongsTo(Category::class);
    }
    public function photos(){
         return $this->morphMany('App\Models\Photo', 'imageable');
    }


}
