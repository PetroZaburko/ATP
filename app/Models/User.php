<?php

namespace App\Models;

use App\Casts\UserNameCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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

    public function isAdmin()
    {
        return $this->role->name == 'admin';
    }

    public function isManager()
    {
        return $this->role->name == 'manager';
    }

    public function isDriver()
    {
        return $this->role->name == 'driver';
    }

    public function scopeDrivers(Builder $query)
    {
        return $query->whereRelation('role', 'name', '=', 'driver');
    }

    public function scopeAdmins(Builder $query)
    {
        return $query->whereRelation('role', 'name', '=', 'admin');
    }

    public function scopeManagers(Builder $query)
    {
        return $query->whereRelation('role', 'name', '=', 'manager');
    }

    public function scopeUsers(Builder $query)
    {
        if (Auth::user()->isDriver()) {
            return $query->where('id', Auth::id());
        }
        return $query;
    }
}
