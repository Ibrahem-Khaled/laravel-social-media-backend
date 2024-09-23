<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $casts = [
        'expire' => 'datetime',
    ];

    protected $fillable =[ 'title' ,'image' ,'price', 'expire'];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? url($this->image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }


    public function transactions()
    {
        return $this->hasMany(FrameUser::class);
    }
}
