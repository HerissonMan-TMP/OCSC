<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convoy extends Model
{
    use HasFactory;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'truckersmp_event_id',
        'title',
        'banner_url',
        'location',
        'distance',
        'destination',
        'server',
        'meetup_date'
    ];

    protected $dates = [
        'meetup_date'
    ];

    /**
     * Scope a query to only include upcoming convoys.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('meetup_date', '>', now());
    }
}
