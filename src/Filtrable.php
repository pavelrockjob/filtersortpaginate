<?php

namespace Pavelrockjob\FilterSortPaginate;

use App\Http\Filters\Api\Users\UsersFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait Filtrable
{
    protected string $filter = UsersFilter::class;

    public function scopeFiltered(Builder $query)
    {
        $filterScopes = new ($this->filter);
        return $filterScopes->apply($query);
    }
}
