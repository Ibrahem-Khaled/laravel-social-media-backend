<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'user_id',
        'slug',
        'image',
        'password',
        'category_id',
    ];




    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'image' => FileCast::class,
    ];




         /**
         * The user that belong to the Rooms
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        function user()
        {
            return $this->hasOne(User::class , 'id' , 'user_id');
        }

        function category()
        {
            return $this->hasOne(Category::class , 'id' , 'category_id');
        }

}
