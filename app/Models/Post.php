<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'title',
        'post_image',
        'body',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    public function images() {
        return $this->morphMany('App\Images', 'imageable');
    }
    
    public function tags() {
        return $this->morphToMany('App\Tag', 'tagable');
    }
    */
}
