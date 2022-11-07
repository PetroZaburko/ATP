<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Buses extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'brand_id',
        'user_id'
    ];

    public function setNumberAttribute($value)
    {
        return Str::upper($value);
    }
}
