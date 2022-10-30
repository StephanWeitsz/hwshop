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
        'lat',
        'long',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('address_type_id');
    }

    /*
    public function newPivot(Model $parent, array $attributes, $table, $exists) {
        if ($parent instanceof User) {
            return new AddressUser($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }
    */
}
