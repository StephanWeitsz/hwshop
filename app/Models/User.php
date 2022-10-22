<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'note',
        'isAdmin'
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
    ];

    public function posts() {
	    return $this->hasMany(Post::class, 'user_id');
    }

    public function address() {
        return $this->belongsToMany(Address::class, 'address_user', 'user_id', 'address_id')
            ->withTimestamps()
            ->withPivot(['name']);
    }

    public function contact() {
	    return $this->belongsToMany(Contact::class, 'contact_user', 'user_id', 'contact_id')
            ->withTimestamps()
            ->withPivot(['number']);
    }

    public function roles() {
	    return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
            ->withTimestamp();
    }

    public function images() {
	    return $this->morphMany(Image::class, 'imageable', 'imageable_type', 'imageable_id', 'image_id');
        //return $this->morphMany(Image::class, 'imageable', 'imageable_id', 'imageable_type', 'image_id');
    }
}
