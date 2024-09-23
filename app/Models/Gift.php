<?php

namespace App\Models;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? url($this->image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getVideoUrlAttribute()
    {
        return $this->video
            ? url($this->video)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }


    public function senders()
    {
        return $this->belongsToMany(User::class, 'gift_user', 'gift_id', 'from_user_id')->withTimestamps();
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'gift_user', 'gift_id', 'to_user_id')->withTimestamps();
    }

    public function giftings()
    {
        return $this->hasMany(GiftUser::class);
    }
}
