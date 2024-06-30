<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable =[ 'title' ,'image','video' , 'expire','price'];

    protected $casts =[
        'image' => FileCast::class ,
        'video' => FileCast::class ,
    ];
}
