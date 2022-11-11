<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addresstype_id',
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
        return $this->belongsToMany(User::class);
    }

    public function addresstype()
    {
        return $this->belongsTo(Addresstype::class);
    }
}
