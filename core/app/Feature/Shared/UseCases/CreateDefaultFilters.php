<?php

namespace App\Feature\Shared\UseCases;

use App\Feature\Shared\Dto\FilterParam;

class CreateDefaultFilters
{
    public function __invoke(): array
    {

        $ethnicityId = request()->get('ethnicity_id') ?? null;
        $genderId = request()->get('gender_id') ?? null;
        $ageId = request()->get('age_id') ?? null;
        $breastId = request()->get('breast_id') ?? null;
        $caterId = request()->get('cater_id') ?? null;
        $bodyTypeId = request()->get('body_type_id') ?? null;
        $eyeColorId = request()->get('eye_color_id') ?? null;
        $hairColorId = request()->get('hair_color_id') ??
        $serviceTypeId = request()->get('service_type_id') ?? null;
        $servicingId = request()->get('servicing_id')?? null;
        $heightId = request()->get('height_id') ?? null;
        $cityId = request()->get('city_id') ?? null;
        $params = [];
        

        if ($ethnicityId !== null) {
            $params[] = new FilterParam('ethnicity_id', $ethnicityId);
        }
        if ($genderId !== null) {
            $params[] = new FilterParam('gender_id', $genderId);
        }
        if ($ageId !== null) {
            $params[] = new FilterParam('age_id', $ageId);
        }
        if ($breastId !== null) {
            $params[] = new FilterParam('breast_id', $breastId);
        }
        if($caterId !== null) {
            $params[] = new FilterParam('cater_id', $caterId);
        }
        if($bodyTypeId !== null) {
            $params[] = new FilterParam('body_type_id', $bodyTypeId);
        }
        if($eyeColorId !== null) {
            $params[] = new FilterParam('eyecolor_id', $eyeColorId);
        }
        if($hairColorId !== null) {
            $params[] = new FilterParam('hair_color_id', $hairColorId);
        }
        if($serviceTypeId !== null) {
            $params[] = new FilterParam('service_type_id', $serviceTypeId);
        }
        if($servicingId !== null) {
            $params[] = new FilterParam('servicing_id', $servicingId);
        }
        if($heightId !== null) {
            $params[] = new FilterParam('height_id', $heightId);
        }        
        if($cityId !== null) {
            $params[] = new FilterParam('city_id', $cityId);
        }
        return $params;
    }
}

