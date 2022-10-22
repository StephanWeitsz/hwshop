<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'description',
    ];
    
    public function OrderStatus() {
        return $this->hasOne('App\OrderStatus');
    }
    
    public function OrderItem() {
        return $this->hasMany('App\OrderItems');
    }
    
    public function tags() {
        return $this->morphToMany('App\Tag', 'tagable');
    }
}
