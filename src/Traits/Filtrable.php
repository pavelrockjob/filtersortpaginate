<?php

namespace Pavelrockjob\Filtersortpaginate\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Pavelrockjob\Filtersortpaginate\Filter;

trait Filtrable
{
    public function scopeFiltered(Builder $builder, Filter $filter = new Filter()): mixed
    {
        return $filter->apply($builder);
    }
}
