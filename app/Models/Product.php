<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'about',
        'price',
    ];

    public function post() {
	    return $this->belongsTo(Posts::class);
    }

    public function order() {
	    return $this->hasMany(Orders::class);
    }

    public function images() {
	    return $this->morphMany('App\Models\Images', 'imageable');
    }

    public function tags() {
	    return $this->morphToMany('App\Models\Tag', 'tagable');
    }
}
