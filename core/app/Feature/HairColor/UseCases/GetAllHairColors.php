<?php

namespace App\Feature\HairColor\UseCases;

use App\Models\HairColor;
use Illuminate\Database\Eloquent\Collection;

class GetAllHairColors
{
    public function __invoke():Collection
    {
        return HairColor::all();
    }
}
