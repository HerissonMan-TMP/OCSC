<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon_name',
        'color',
        'contrast_color',
        'description',
        'recruitment_enabled',
    ];

    /**
     * Get the downloads the role is allowed to access.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function downloads()
    {
        return $this->belongsToMany(Download::class);
    }

    /**
     * Get the group of the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the guides the role is allowed to read.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function guides()
    {
        return $this->belongsToMany(Guide::class);
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
     * Get the users having the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
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
    public function scopeCurrentlyRecruiting($query)
    {
        return $query->whereHas('recruitments', function (Builder $query) {
            $query->open();
        });
    }

    /**
     * Get the current recruitment session for the role.
     *
     * @return mixed
     */
    public function getOpenRecruitment()
    {
        return $this->recruitments->first();
    }

    /**
     * Test if the role is recruiting.
     *
     * @return bool
     */
    public function isRecruiting()
    {
        return $this->getOpenRecruitment() !== null;
    }

    /**
     * Test if the role has the given permission.
     *
     * @param $permission
     * @return bool
     */
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
}
