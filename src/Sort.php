<?php

namespace Pavelrockjob\Filtersortpaginate;

use \Illuminate\Contracts\Database\Eloquent\Builder;

class Sort
{
    protected string $requestSortByKey = 'sort_by';
    protected string $requestSortDirectionKey = 'sort_direction';

    public string|null $sortBy;
    public string|null $sortDirection;

    public function __construct()
    {
        $this->sortBy = request()->get($this->requestSortByKey) ?? null;
        $this->sortDirection = request()->get($this->requestSortDirectionKey) ?? 'desc';
    }

    public function apply(Builder $builder, string|null $default = null, string|null $direction = null)
    {
        if (!$this->sortBy && $default){
            $this->sortBy = $default;
        }

        if ($this->sortBy) {
            if (method_exists($this, $this->sortBy)) {
                $builder = $this->{$this->sortBy}($builder);
            } elseif ($this->sortBy && $builder->getConnection()->getSchemaBuilder()->hasColumn($builder->getModel()->getTable(), $this->sortBy)) {
                $builder = $this->defaultSort($this->sortBy, $direction ?? $this->sortDirection, $builder);
            }
        }

        return $builder;
    }

    private function defaultSort(string $sortBy, string $direction, Builder $builder): Builder
    {
        return $builder->orderBy($sortBy, $this->sortDirection);
    }
}
