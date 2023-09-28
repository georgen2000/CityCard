<?php

namespace App\Filters;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait ModelFilterTrait
{
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
