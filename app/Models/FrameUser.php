<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameUser extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'frame_id', 'purchased_at', 'expires_at'];
    protected $table = 'frame_user';
    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
