<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'post_image',
        'body',
    ];



    public function user() {
        return $this->belongsTo(User::class);
    }

    /*
    public function images() {
        return $this->morphMany('App\Images', 'imageable');
    }
    
    public function tags() {
        return $this->morphToMany('App\Tag', 'tagable');
    }
    */

    //public function setPostImageAttribute($value) {
        //$this->attributes['post_image'] = asset($value);
    //} 

    public function getPostImageAttribute($value) {
        if(strpos($value, 'https://') !== false || strpos('$value', 'http://') !== false) {
            return asset($value);
        }
        else {
            return asset('storage/' . $value);
        }
    } 
}
