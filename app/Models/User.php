<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'avatar',
        'password',
        'note'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    } //public function setPasswordAttribute($value) {

    public function getAvatarAttribute($value) {
        if(strpos($value, 'https://') !== false || strpos('$value', 'http://') !== false) {
            return asset($value);
        } //if(strpos($value, 'https://') !== false || strpos('$value', 'http://') !== false) {
        else {
            return asset('storage/' . $value);
        } //else
    } //public function getAvatarAttribute($value) {

    public function posts() {
	    return $this->hasMany(Post::class);
    } //public function posts() {

    public function address() {
        return $this->belongsToMany(Address::class)
            ->withTimestamps();
    } //public function address() {

    //public function addresses()
    //{
        //return $this->belongsToMany(Address::class);
    //}

    public function contact() {
	    return $this->belongsToMany(Contact::class)
            ->withTimestamps();
    } //public function contact() {

    public function permissions() {
	    return $this->belongsToMany(Permission::class);
    } //public function permissions() {
    
    public function roles() {
	    return $this->belongsToMany(Role::class);
    } //public function roles() {

    public function images() {
	    return $this->morphMany(Image::class, 'imageable', 'imageable_type', 'imageable_id', 'image_id');
        //return $this->morphMany(Image::class, 'imageable', 'imageable_id', 'imageable_type', 'image_id');
    } //public function images() {

    public function userHasRole($role_name) {
        foreach($this->roles as $role) {
            if(strtolower($role_name) == strtolower($role->name)) {
                return true;
            } //if(strtolower($role_name) == strtolower($role->name)) {
        } //foreach($this->roles as $role) {
        return false;
    } //public function userHasRole($role_name) {
} //class User extends Authenticatable
