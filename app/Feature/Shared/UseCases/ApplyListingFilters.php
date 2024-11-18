<?php

namespace App\Feature\Shared\UseCases;

use App\Feature\Shared\Dto\FilterParam;
use App\Models\Builders\Classes\GlobalBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ApplyListingFilters
{
    private $filters;
    public function __invoke(GlobalBuilder $builder, FilterParam ...$filters): GlobalBuilder
    {
        $this->filters = $filters;
        foreach ($this->filters as $filter) {
            $builder = $this->applyFilter($builder, $filter);
        }
        return $builder;
    }
    private function applyFilter(GlobalBuilder $builder, FilterParam $filter): GlobalBuilder
    {
        $field = $filter->getField();
        $operator = $filter->getOperator();
        $value = $filter->getValue();
        return $builder->where($field, $operator, $value);
    }
}
