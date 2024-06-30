<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Bl\LaravelUploadable\Casts\FileCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'slug',
        'status',
        'last_login_at',
        'last_logout_at',
        'last_activity_at',
        'last_login_ip',
        'last_logout_ip',
        'last_activity_ip',

    ];

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
        'image' => FileCast::class,
    ];



    public function getJWTIdentifier()
    {
        return $this->getKey();
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
}
