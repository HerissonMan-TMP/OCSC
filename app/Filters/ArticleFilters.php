<?php

namespace App\Filters;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArticleFilters extends QueryFilters
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
            return $this->builder->whereHas('postedByUser', function (Builder $query) use ($value) {
                $query->whereLike(['name'], $value);
            });
        }
    }

    public function title($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->whereLike(['title'], $value);
    }

    public function sortByCreatedAt($value = null)
    {
        if ($value === null) {
            return;
        }

        return $this->builder->orderBy('created_at', $value);
    }
}
