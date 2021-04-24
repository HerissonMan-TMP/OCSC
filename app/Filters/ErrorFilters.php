<?php

namespace App\Filters;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ErrorFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function statusCode($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['status_code'], $value);
    }

    public function uri($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['uri'], $value);
    }

    public function sortByCreatedAt($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->orderBy('created_at', $value);
    }
}
