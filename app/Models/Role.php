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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color',
        'contrast_color',
    ];

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
     * Get the downloads the role is allowed to see.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function downloads()
    {
        return $this->belongsToMany(Download::class);
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

    public function hasPermission($permission)
    {

        if (gettype($permission) === 'string') {
            $permissions = [];
            foreach (app('roles')->find($this->id)->permissions as $permissionItem) {
                array_push($permissions, $permissionItem);
            }
            $collection = collect($permissions);
            return $collection->where('slug', $permission)->isNotEmpty();
        } else {
            $permissionId = $permission->id;
        }
        return $this->permissions->contains($permissionId);
    }

    public function getOpenRecruitment()
    {
        return $this->recruitments->first();
    }

    public function isRecruiting()
    {
        return $this->getOpenRecruitment() !== null;
    }
}
