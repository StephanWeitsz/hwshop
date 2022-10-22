<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_status_id';

    protected $fillable = [
        'description',
    ];
}
