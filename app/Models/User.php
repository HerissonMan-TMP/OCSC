<?php

namespace App\Models;

use App\Filters\Filterable;
use Auth;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'has_temporary_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get if the user has a temporary password.
     *
     * @return bool
     */
    public function getHasTemporaryPasswordAttribute()
    {
        return $this->temporary_password_without_hash !== null;
    }

    /**
     * Get the roles a user has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->orderBy('group_id')->orderBy('order');
    }

    /**
     * Get the recruitment sessions created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'posted_by');
    }

    public function hasPermission($permission)
    {
        foreach (app('users')->find($this->id)->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        return $this->roles->contains($role->id);
    }

    public function highestGroup()
    {
        return Auth::user()->roles()->first()->group;
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'causer_id');
    }

    public function errors()
    {
        return $this->hasMany(Error::class);
    }
}
