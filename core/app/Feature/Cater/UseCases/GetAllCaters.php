<?php

namespace App\Feature\Cater\UseCases;

use App\Models\Cater;
use Illuminate\Database\Eloquent\Collection;

class GetAllCaters
{
    public function __invoke():Collection
    {
        return Cater::all();
    }
}
