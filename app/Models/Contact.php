<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contacttype_id',
        'number',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    } //public function users() {

    public function contacttype() {
        return $this->belongsTo(Contacttype::class);
    } //public function contacttype() {
} //class Contact extends Model
