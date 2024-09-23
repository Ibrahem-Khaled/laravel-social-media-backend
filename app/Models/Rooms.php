<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Rooms extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }


    public function getImageUrlAttribute()
    {
        return $this->image
            ? url($this->image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

}
