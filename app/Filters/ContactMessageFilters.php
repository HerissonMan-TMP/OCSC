<?php

namespace App\Filters;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactMessageFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function discord($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['discord'], $value);
    }

    public function email($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['email'], $value);
    }

    public function sortByCreatedAt($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->orderBy('created_at', $value);
    }

    public function status($value = null)
    {
        if ($value === null || $value === 'all') {
            return;
        }

        return $this->builder->where('status', $value);
    }
}
