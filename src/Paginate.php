<?php

namespace Pavelrockjob\Filtersortpaginate;

class Paginate
{
    public static $perPage = 10;
    
    static function getPerPage(){
        return request()->has('per_page') ? request()->get('per_page') : self::$perPage;
    }
}