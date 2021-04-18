<?php

namespace App\Filters;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PictureFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function by($value = null)
    {
        if ($value === null) {
            return;
        }

        if ($value === 'Anonymous') {
            return $this->builder->where('user_id', null);
        } else {
            return $this->builder->whereHas('user', function (Builder $query) use ($value) {
                $query->whereLike(['name'], $value);
            });
        }
    }

    public function name($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['name'], $value);
    }

    public function description($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['description'], $value);
    }

    public function sortByCreatedAt($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->orderBy('created_at', $value);
    }
}
