<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $path = '/storage/';

    protected $fillable = [
        'filename',
    ];

    public function getFilenameAttribute($filename) {
        return $this->path . $filename;
    }

    public function imageable() {
        return $this->morphTo();
    }
}
