<?php

namespace Pavelrockjob\Filtersortpaginate;

use Illuminate\Database\Eloquent\Builder;

class Filter
{
    protected string $requestFiltersKey = 'filters';
    protected object $filters;

    public function __construct()
    {
        $this->filters = request()->get($this->requestFiltersKey) ?? (object) [];
    }

    public function apply(Builder $builder): Builder
    {
        if (count((array) $this->filters) > 0) {
            foreach ($this->filters as $key => $value) {
                //Apply user filters
                if (method_exists($this, $key)) {
                    $builder = $this->{$key}($builder);
                //Apply default filter if column exist in table
                } elseif($builder->getConnection()->getSchemaBuilder()->hasColumn($builder->getModel()->getTable(), $key)) {
                    $builder = $this->defaultFilter($key, $value, $builder);
                }
            }
        }

        return $builder;
    }

    private function defaultFilter(string $key, mixed $value, Builder $builder): Builder{
        return $builder->where($key, 'LIKE', '%'.$value.'%');
    }
}
