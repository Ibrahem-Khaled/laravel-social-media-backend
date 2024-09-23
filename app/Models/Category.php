<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? url($this->image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }


    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }


}
