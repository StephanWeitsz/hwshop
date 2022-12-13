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
        'type'
    ];

    public function post() {
	    return $this->belongsTo(Posts::class);
    }

    public function product_item() {
	    return $this->hasMany(Product_item::class);
    }

    public function order() {
	    return $this->hasMany(Order::class);
    }

    public function images() {
	    return $this->morphMany('App\Models\Images', 'imageable');
    }

    public function tags() {
	    return $this->morphToMany('App\Models\Tag', 'tagable');
    }
}
