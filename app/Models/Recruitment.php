<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recruitment
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class Recruitment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_at',
        'end_at',
        'note',
        'specific_requirements'
    ];

    /**
     * Get the role the recruitment session is for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the user who created the recruitment session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the the recruitment session's questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the applications sent for the recruitment session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the date & time the recruitment session starts at.
     *
     * @param string $value
     * @return string
     */
    public function getStartAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }

    /**
     * Get the date & time the recruitment session ends at.
     *
     * @param string $value
     * @return string
     */
    public function getEndAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }

    public function getIsOpenAttribute(): bool
    {
        return Carbon::parse($this->start_at) <= now() && Carbon::parse($this->end_at) > now();
    }

    /**
     * Scope a query to only include open recruitment sessions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->where([['start_at', '<=', now()], ['end_at', '>', now()]]);
    }
}
