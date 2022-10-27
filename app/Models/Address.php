<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'line1',
        'line2',
        'line3',
        'line4',
        'postalcode',
    ];

    public function user() {
        return $this->belongsToMany(User::class)->using(AddressUser::class);
    }
}
