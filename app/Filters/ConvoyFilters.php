<?php

namespace App\Filters;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConvoyFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function truckersmpEventId($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->where('truckersmp_event_id', $value);
    }

    public function title($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['title'], $value);
    }

    public function location($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['location'], $value);
    }

    public function destination($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['destination'], $value);
    }

    public function distanceMoreThan($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->where('distance', '>', $value);
    }

    public function distanceLessThan($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->where('distance', '<', $value);
    }

    public function sortByMeetupDate($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->orderBy('meetup_date', ($value === 'asc') ? 'asc' : 'desc');
    }

    public function date($value = null)
    {
        if ($value === 'past') {
            return $this->builder->where('meetup_date', '<', now());
        } elseif ($value === 'upcoming') {
            return $this->builder->where('meetup_date', '>', now());
        } else {
            return;
        }
    }
}
