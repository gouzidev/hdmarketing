<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'country', 'city', 'street', 'price', 'created_at', 'updated_at'
    ];
}
