<?php

namespace App\Feature\Breast\UseCases;

use App\Models\Breast;
use Illuminate\Database\Eloquent\Collection;

class GetAllBreasts
{
    public function __invoke():Collection
    {
        return Breast::all();
    }
}
