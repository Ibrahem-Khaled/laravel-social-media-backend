<?php

namespace App\Models;

use App\Traits\GenerateUniqueSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Rooms extends Model
{
    use HasFactory , GenerateUniqueSlug;

    protected $guarded = [];

    protected $table = 'rooms';


    protected static function booted()
    {
        parent::boot();

        static::creating(function ($room) {
            $room->slug = $room->generate($room->name);
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

    function members()
    {
        return $this->hasMany(RoomMember::class, 'room_id');
    }

}
