<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Addresstype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function address() {
        return $this->hasMany(Address::class);
    }
}
