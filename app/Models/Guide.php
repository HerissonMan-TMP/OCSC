<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Guide extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'banner_url',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Scope a query to only include guides the current authenticated user is allowed to access.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAccessible($query)
    {
        $user = Auth::user();

        return $user->can('manage-guides')
            ? $query
            : $query->whereHas('roles', function (Builder $q) {
                $q->whereIn('role_id', Auth::user()->roles->pluck('id')->toArray());
            });
    }
}
