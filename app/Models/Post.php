<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'post_banner',
        'body',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    } //public function user() {
        
    public function product() {
        return $this->belongsTo(Product::class);
    } // public function product() {

    public function images() {
        return $this->morphMany('App\Models\Images', 'imageable');
    }
   
    /*
    public function tags() {
        return $this->morphToMany('App\Tag', 'tagable');
    }
    */

    //public function setPostImageAttribute($value) {
        //$this->attributes['post_banner'] = asset($value);
    //} 

    public function getPostImageAttribute($value) {
        if(strpos($value, 'https://') !== false || strpos('$value', 'http://') !== false) {
            return asset($value);
        } //if(strpos($value, 'https://') !== false || strpos('$value', 'http://') !== false) {
        else {
            return asset('storage/' . $value);
        } //else
    } //public function getPostImageAttribute($value) {
} //class Post extends Model
