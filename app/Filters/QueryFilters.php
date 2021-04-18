<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ReflectionClass;

class QueryFilters
{
    protected $request;

    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if ( ! method_exists($this, $name)) {
                continue;
            }
            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        $class = new ReflectionClass($this);

        if (!isset($request->sortCreatedAt)) {
            if ($class->getShortName() === 'ConvoyFilters' && !isset($request->sortByMeetupDate)) {
                $this->builder->latest('meetup_date');
            } else {
                $this->builder = $this->builder->latest();
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
