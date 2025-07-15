<?php

namespace App\Feature\ServiceType\UseCases;

use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Collection;

class GetAllServiceTypes
{
    public function __invoke():Collection
    {
        return ServiceType::all();
    }
}
