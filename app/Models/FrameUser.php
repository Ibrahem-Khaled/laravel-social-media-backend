<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameUser extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $table = 'frame_user';

    protected $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
