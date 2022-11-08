<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand'
    ];

    protected $perPage = 20;

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
