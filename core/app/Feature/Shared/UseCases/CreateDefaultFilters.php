<?php

namespace App\Feature\Shared\UseCases;

use App\Feature\Shared\Dto\FilterGroup;
use App\Feature\Shared\Dto\FilterParam;
use Illuminate\Support\Facades\Cookie;

class CreateDefaultFilters
{
    public function __invoke(): array
    {

        $ethnicityId = request()->get('ethnicity_id') ?? null;
        $genderId = request()->get('gender_id') ?? null;
        $ageId = request()->get('age_id') ?? null;
        $breastId = request()->get('breast_id') ?? null;
        $cater1 = request()->get('cater_1') ?? null;
        $cater2 = request()->get('cater_2') ?? null;
        $cater3 = request()->get('cater_3') ?? null;

        $bodyTypeId = request()->get('body_type_id') ?? null;
        $eyeColorId = request()->get('eye_color_id') ?? null;
        $hairColorId = request()->get('hair_color_id') ??
            $serviceTypeId = request()->get('service_type_id') ?? null;
        $servicingId = request()->get('servicing_id') ?? null;
        $heightId = request()->get('height_id') ?? null;
        // $cityId = request()->get('city_id') ?? null;
        $cityId = Cookie::get('city_id') ?? null;
        $cityId = request()->get('city_id') ?? $cityId;
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
        $caters = [];

        if ($cater1 != false) {
            $caters[] = 'cater_1';
        }
        if ($cater2 != false) {
            $caters[] = 'cater_2';
        }
        if ($cater3 !== true && $cater3 != false) {
            $caters[] = 'cater_3';
        }

        if ($cater1 !== null || $cater2 !== null || $cater3 !== null) {
            $params[] = new FilterParam('city_id', 1,  '=', $caters);
        }
        if ($bodyTypeId !== null) {
            $params[] = new FilterParam('body_type_id', $bodyTypeId);
        }
        if ($eyeColorId !== null) {
            $params[] = new FilterParam('eyecolor_id', $eyeColorId);
        }
        if ($hairColorId !== null) {
            $params[] = new FilterParam('hair_color_id', $hairColorId);
        }
        if ($serviceTypeId !== null) {
            $params[] = new FilterParam('service_type_id', $serviceTypeId);
        }
        if ($servicingId !== null) {
            $params[] = new FilterParam('servicing_id', $servicingId);
        }
        if ($heightId !== null) {

            $params[] = new FilterParam('height_id', $heightId);
        }
        if ($cityId !== null) {
            $params[] = new FilterParam('city_id', $cityId,  '=', ['city_id', 'second_city_id', 'third_city_id']);
        }
        return $params;
    }
}
