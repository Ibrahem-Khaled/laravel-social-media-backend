<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    function user()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }
    function post()
    {
        return $this->hasOne(Posts::class , 'id' , 'post_id');
    }
}
