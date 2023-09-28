<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $validatedData;

    protected Builder $builder;

    protected string $delimiter = ',';

    public function __construct($validatedData)
    {
        $this->validatedData = $validatedData;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->validatedData as $methodName => $params) {
            if (is_null($params)) continue;
            if (method_exists($this, $methodName)) {
                call_user_func_array([$this, $methodName], array_filter([$params]));
            }
        }

        return $this->builder;
    }
}
