<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = 'address_id';

    protected $fillable = [
        'line1',
        'line2',
        'line3',
        'line4',
        'postalcode',
    ];

    public function user() {
        return $this->belongsToMany(User::class, 'user_id')->using(AddressUser::class);
    }
}
