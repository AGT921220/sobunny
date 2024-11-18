<?php

namespace App\Feature\EyeColor\UseCases;

use App\Models\EyeColor;
use Illuminate\Database\Eloquent\Collection;

class GetAllEyeColors
{
    public function __invoke():Collection
    {
        return EyeColor::all();
    }
}
