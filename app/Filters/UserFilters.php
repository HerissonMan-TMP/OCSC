<?php

namespace App\Filters;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function name($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['name'], $value);
    }

    public function email($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['email'], $value);
    }

    public function role($value = null)
    {
        if ($value === null || $value === 'all') {
            return;
        }

        return $this->builder->whereHas('roles', function (Builder $query) use ($value) {
            return $query->where('name', $value);
        });
    }

    public function sortByCreatedAt($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->orderBy('created_at', $value);
    }
}
