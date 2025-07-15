<?php

namespace App\Feature\Ethnicity\UseCases;

use App\Models\Ethnicity;
use Illuminate\Database\Eloquent\Collection;

class GetAllEthnicitys
{
    public function __invoke():Collection
    {
        return Ethnicity::all();
    }
}
