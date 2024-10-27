<?php

namespace App\Feature\Age\UseCases;

use App\Models\Age;
use Illuminate\Database\Eloquent\Collection;

class GetAllAges
{
    public function __invoke():Collection
    {
        return Age::all();
    }
}
