<?php

namespace App\Feature\Shared\Dto;

class FilterParam
{
    private $field;
    private $operator;
    private $value;

    public function __construct(
        string $field,
        string $value,
        string $operator = '='
    ) {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
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
}
