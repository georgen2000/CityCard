<?php

namespace App\Filters;

use App\Models\CardType;
use App\Models\Transport;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends QueryFilter
{
    public function search($value): Builder
    {
        return $this->builder->where('name', 'like', '%'.$value.'%');
    }
}
