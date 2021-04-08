<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // what it will do is that it will find us those post where
    // user belongs to country which we want  as user model is have
    // id of country
    public function posts() {
        return  $this->hasManyThrough(Post::class, User::class);
    }
}
