<?php

namespace App\Models;

use App\Casts\UserNameCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'birth',
        'photo',
        'salary',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name' => UserNameCast::class,
    ];

    public $additional_attributes = [
        'full_name'
    ];

    protected $perPage = 20;

    public function getFullNameAttribute()
    {
        return "{$this->surname} {$this->name}";
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    public function checkAgeAbility()
    {
        return Carbon::parse($this->birth)->age <= config('atp.max_working_age');
    }
}
