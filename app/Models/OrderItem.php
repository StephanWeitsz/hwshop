<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
    ];

    public function ItemStatus() {
        return $this->hasOne('App\ItemStatus');
    }
    
    public function products() {
        return $this->hasMany('App\Products');
    }
}
