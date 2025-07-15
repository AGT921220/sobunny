<?php

namespace App\Feature\Shared\Dto;

class FilterParam
{
    private $field;
    private $operator;
    private $value;
    private $orWhere;

    public function __construct(
        string $field,
        string $value,
        string $operator = '=',
        ?array $orWhere = null
    ) {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
        $this->orWhere = $orWhere;
    }
    public function getOperator(): string
    {
        return $this->operator;
    }
    public function getField(): string
    {
        return $this->field;
    }
    public function getValue(): string
    {
        return $this->value;
    }
    public function isOrWhere() : bool
    {
        return !!$this->orWhere;
    }
    public function getOrwhere() : array
    {
        return $this->orWhere;
    }
}
