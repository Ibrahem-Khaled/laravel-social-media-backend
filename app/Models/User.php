<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_logout_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'image' => FileCast::class . ':avatars,public',
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getProfilePictureUrlAttribute()
    {
        return $this->image !== '/uploadable.jpg'
            ? url($this->image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role == 'admin';
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sentGifts()
    {
        return $this->belongsToMany(Gift::class, 'gift_user', 'from_user_id', 'gift_id')->withTimestamps();
    }

    public function receivedGifts()
    {
        return $this->belongsToMany(Gift::class, 'gift_user', 'to_user_id', 'gift_id')->withTimestamps();
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_users');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function followingList()
    {
        return $this->hasMany(Following::class, 'following_id');
    }

    public function followersList()
    {
        return $this->hasMany(Following::class, 'follower_id');
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }
}
