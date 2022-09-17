<?php

namespace Pavelrockjob\Filtersortpaginate\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Pavelrockjob\Filtersortpaginate\Filter;
use Pavelrockjob\Filtersortpaginate\Sort;

trait Sortable
{

    public function scopeSorted(Builder $builder, Sort $sort = new Sort(), string $default = null, string $direction = null){
        return $sort->apply($builder, $default, $direction);
    }
}
