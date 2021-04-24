<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'original_file_name',
        'path',
    ];

    /**
     * Get the roles that are allowed to see the download.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Scope a query to only include downloads the current authenticated user is allowed to access.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAccessible($query)
    {
        $user = Auth::user();

        return $user->can('manage-downloads')
            ? $query
            : $query->whereHas('roles', function (Builder $q) {
                  $q->whereIn('role_id', Auth::user()->roles->pluck('id')->toArray());
            });
    }
}
