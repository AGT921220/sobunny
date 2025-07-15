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

        if ($filter->isOrWhere()) {
            $fields = $filter->getOrwhere();
            foreach ($fields as $index => $subField) {
                if ($index === 0) {
                    $builder = $builder->where($subField, $operator, $value);
                    continue;
                }
                $builder = $builder->orWhere($subField, $operator, $value);
            }
            return $builder;
        }
        return $builder->where($field, $operator, $value);
    }
}
