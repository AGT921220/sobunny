<?php

namespace App\Feature\BodyType\UseCases;

use App\Models\BodyType;
use Illuminate\Database\Eloquent\Collection;

class GetAllBodyTypes
{
    public function __invoke():Collection
    {
        return BodyType::all();
    }
}
