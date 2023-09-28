<?php

namespace App\Filters;

use App\Models\CardType;
use App\Models\Transport;
use Illuminate\Database\Query\Builder;

class CardFilter extends QueryFilter
{
    public function city($id)
    {
        return $this->builder->whereHas('cardType', function ($query) use ($id) {
            return $query->where('city_id', '=', $id);
        });
    }

    public function transport($id)
    {
        return $this->builder->whereHas('cardType', function ($query) use ($id) {
            return $query->where('transport_id', '=', $id);
        });
    }

    // public function search($keyword)
    // {
    //     return $this->builder->where('title', 'like', '%'.$keyword.'%');
    // }
}
