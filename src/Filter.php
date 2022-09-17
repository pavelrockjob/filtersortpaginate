<?php

namespace Pavelrockjob\FilterSortPaginate;

use Illuminate\Database\Eloquent\Builder;

class Filter
{
    protected object $filters;

    public function __construct()
    {
        $this->filters = request()->get('filters') ?? (object) [];
    }

    public function apply(Builder $builder): Builder
    {
        if (request()->has('filters')) {
            foreach (request()->get('filters') as $key => $filter) {
                if (method_exists($this, $key)) {
                    $builder = $this->{$key}($builder);
                }
            }
        }

        return $builder;
    }
}
