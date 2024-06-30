<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id',
        'slug',
        'status',
    ];

    protected $casts = [
        'image' => FileCast::class,
    ];


    function user()
        {
            return $this->hasOne(User::class , 'id' , 'user_id');
        }
}
