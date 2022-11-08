<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'brand_id',
        'user_id'
    ];

    protected $perPage = 20;

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = Str::upper($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
