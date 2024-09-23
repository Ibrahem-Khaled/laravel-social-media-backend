<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $casts =
    [
        'expire' => 'datetime'
    ];

    protected $fillable =[ 'title' ,'image','video' , 'expire','price'];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? url($this->image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function transactions()
    {
        return $this->hasMany(EntryUser::class);
    }

}
