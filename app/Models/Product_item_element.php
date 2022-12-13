<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_item_element extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_item_id',
        'size',
        'price'
    ];

    public function setPriceAttribute($value) {
        if($value[0] != "R") {
            $this->attributes['price'] = "R " . $value;
        } //if($value[0] != "R") {
        else {
            $this->attributes['price'] = $value;
        } //else
    }

    public function product_item() {
	    return $this->belongsTo(Product_items::class);
    }
}
