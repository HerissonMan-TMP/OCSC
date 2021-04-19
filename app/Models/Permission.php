<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use HasFactory;

    /**
     * Get the roles having the permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function category()
    {
        return $this->belongsTo(PermissionCategory::class, 'category_id');
    }
}
