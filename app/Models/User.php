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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'avatar',
        'password',
        'note'
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

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute($value) {
        if(strpos($value, 'https://') !== false || strpos('$value', 'http://') !== false) {
            return asset($value);
        }
        else {
            return asset('storage/' . $value);
        }
    } 

    public function posts() {
	    return $this->hasMany(Post::class);
    }

    public function address() {
        return $this->belongsToMany(Address::class)
            ->withTimestamps();
    }

    public function contact() {
	    return $this->belongsToMany(Contact::class)
            ->withTimestamps()
            ->withPivot(['number']);
    }

    public function permissions() {
	    return $this->belongsToMany(Permission::class);
    }
    
    public function roles() {
	    return $this->belongsToMany(Role::class);
    }

    public function images() {
	    return $this->morphMany(Image::class, 'imageable', 'imageable_type', 'imageable_id', 'image_id');
        //return $this->morphMany(Image::class, 'imageable', 'imageable_id', 'imageable_type', 'image_id');
    }

    public function userHasRole($role_name) {
        foreach($this->roles as $role) {
            if(strtolower($role_name) == strtolower($role->name)) {
                return true;
            }
        }
        return false;
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }
}
