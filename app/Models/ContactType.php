<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacttype extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function contact() {
        return $this->hasMany(Contact::class);
    } //public function contact() {
} //class Contacttype extends Model
