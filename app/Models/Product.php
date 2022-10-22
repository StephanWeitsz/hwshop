<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'about',
        'price',
    ];

    public function order() {
	    return $this->hasMany('App\Orders');
    }

    public function images() {
	    return $this->morphMany('App\Images', 'imageable');
    }

    public function tags() {
	    return $this->morphToMany('App\Tag', 'tagable');
    }
}
