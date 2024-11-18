<?php

namespace App\Feature\Geneder\UseCases;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Collection;

class GetAllGenders
{
    public function __invoke():Collection
    {
        return Gender::all();
    }
}
