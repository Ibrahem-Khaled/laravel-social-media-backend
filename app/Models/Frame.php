<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $fillable =[ 'title' ,'image' , 'expire','price'];

    protected $casts =[
        'image' => FileCast::class ,
    ];
}
