<?php

namespace App\Feature\Height\UseCases;

use App\Models\Height;
use Illuminate\Database\Eloquent\Collection;

class GetAllHeights
{
    public function __invoke():Collection
    {
        return Height::all();
    }
}
