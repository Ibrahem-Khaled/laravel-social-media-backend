<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable =[ 'title' ,'image' , 'video','price'];

    protected $casts =[
        'image' => FileCast::class ,
        'video' => FileCast::class
    ];

    public function senders()
    {
        return $this->belongsToMany(User::class, 'gift_user', 'gift_id', 'from_user_id')->withTimestamps();
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'gift_user', 'gift_id', 'to_user_id')->withTimestamps();
    }
}
