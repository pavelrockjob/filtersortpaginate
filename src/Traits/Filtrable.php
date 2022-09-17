<?php

namespace Pavelrockjob\Filtersortpaginate\Traits;

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
