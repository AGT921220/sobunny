<?php

namespace App\Feature\Servicing\UseCases;

use App\Models\Servicing;
use Illuminate\Database\Eloquent\Collection;

class GetAllServicings
{
    public function __invoke():Collection
    {
        return Servicing::all();
    }
}
