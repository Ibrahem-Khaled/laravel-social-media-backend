<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name','cca2','country_code' , 'flag','status'
    ];

    protected $casts = [
        'flag' => FileCast::class,
    ];
}
