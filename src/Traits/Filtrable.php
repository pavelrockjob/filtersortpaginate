<?php

namespace Pavelrockjob\Filtersortpaginate;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait Filtrable
{
    protected string $filter = '';

    public function scopeFiltered(Builder $query)
    {
        $filterScopes = new ($this->filter);
        return $filterScopes->apply($query);
    }
}
