<?php

namespace App\Feature\Shared\Dto;

class FilterGroup
{
    private $fields;

    public function __construct(
        array $fields
    ) {
        $this->fields = $fields;
    }
    public function getFields(): array
    {
        return $this->fields;
    }
}
