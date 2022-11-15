<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    } //public function permissions() {

    public function users() {
        return $this->belongsToMany(User::class);
    } //public function users() {

    public function roleHasPermission($permission_name) {
        foreach($this->permissions as $permission) {
            if($permission_name == $permission->name) {
                return true;
            } //if($permission_name == $permission->name) {
        } //foreach($this->permissions as $permission) {
        return false;
    } //public function roleHasPermission($permission_name) {
} //class Role extends Model
