<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'about'
    ];

    public function product() {
	    return $this->belongsTo(Product::class);
    }

    public function product_item_element() {
	    return $this->hasMany(Product_item_element::class);
    }
}
