<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected $validatedData;

    protected Builder $builder;

    /**
     * @var string $model like YourFilteringModel::class
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function apply($validatedData): Builder
    {
        $this->validatedData = $validatedData;

        foreach ($this->validatedData as $methodName => $params) {
            if (is_null($params)) {
                continue;
            }
            if (method_exists($this, $methodName)) {
                call_user_func_array([$this, $methodName], array_filter([$params]));
            }
        }

        return $this->builder;
    }
}
