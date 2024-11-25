<?php

namespace App\Feature\Shared\UseCases;

use App\Feature\Shared\Dto\FilterParam;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ApplyListingFilters
{
    private $filters;
    public function __invoke(Builder $builder, FilterParam ...$filters): Builder
    {
        $this->filters = $filters;
        foreach ($this->filters as $filter) {
            $builder = $this->applyFilter($builder, $filter);
        }
        return $builder;
    }
    private function applyFilter(Builder $builder, FilterParam $filter): Builder
    {
        $field = $filter->getField();
        $operator = $filter->getOperator();
        $value = $filter->getValue();
        return $builder->where($field, $operator, $value);
    }
}
