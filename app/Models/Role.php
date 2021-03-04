<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class Role extends Model
{
    use HasFactory;

    /**
     * Get the users having the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the permissions the role has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get the open and closed recruitment sessions for the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }

    /**
     * Scope a query to only include roles that can be recruited.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecruitable($query)
    {
        return $query->where('recruitment_enabled', true);
    }

    /**
     * Scope a query to only include roles having recruitments open.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentlyRecruiting($query) {
        return $query->whereHas('recruitments', function (Builder $query) {
            $query->open();
        });
    }

    /**
     * Scope a query to only include roles that doesn't have recruitments open.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotCurrentlyRecruiting($query) {
        return $query->whereDoesntHave('recruitments', function (Builder $query) {
            $query->open();
        });
    }
}
