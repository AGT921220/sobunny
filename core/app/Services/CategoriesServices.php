<?php

namespace App\Services;

use App\Feature\Age\UseCases\GetAllAges;
use App\Feature\BodyType\UseCases\GetAllBodyTypes;
use App\Feature\Breast\UseCases\GetAllBreasts;
use App\Feature\Cater\UseCases\GetAllCaters;
use App\Feature\Ethnicity\UseCases\GetAllEthnicitys;
use App\Feature\EyeColor\UseCases\GetAllEyeColors;
use App\Feature\Geneder\UseCases\GetAllGenders;
use App\Feature\HairColor\UseCases\GetAllHairColors;
use App\Feature\Height\UseCases\GetAllHeights;
use App\Feature\ServiceType\UseCases\GetAllServiceTypes;
use App\Feature\Servicing\UseCases\GetAllServicings;

class CategoriesServices
{

    public $getAllGenders;
    public $getAllEthnicitys;
    public $getAllAges;
    public $getAllBreasts;
    public $getAllCaters;
    public $getAllBodyTypes;
    public $getAllEyeColors;
    public $getAllHairColors;
    public $getAllHeighs;
    public $getAllServiceTypes;
    public $getAllServicings;

    public function __construct(
        GetAllGenders $getAllGenders,
        GetAllEthnicitys $getAllEthnicitys,
        GetAllAges $getAllAges,
        GetAllCaters $getAllCaters,
        GetAllBreasts $getAllBreasts,
        GetAllEyeColors $getAllEyeColors,
        GetAllHairColors $getAllHairColors,
        GetAllHeights $getAllHeighs,
        GetAllServiceTypes $getAllServiceTypes,
        GetAllServicings $getAllServicings,
        GetAllBodyTypes $getAllBodyTypes

    ) {
        $this->getAllGenders = $getAllGenders;
        $this->getAllEthnicitys = $getAllEthnicitys;
        $this->getAllAges = $getAllAges;
        $this->getAllBreasts = $getAllBreasts;
        $this->getAllCaters = $getAllCaters;
        $this->getAllBodyTypes = $getAllBodyTypes;
        $this->getAllEyeColors = $getAllEyeColors;
        $this->getAllHairColors = $getAllHairColors;
        $this->getAllHeighs = $getAllHeighs;
        $this->getAllServiceTypes = $getAllServiceTypes;
        $this->getAllServicings = $getAllServicings;
    }

    // public $getAllGenders;

    // public function __construct()
    // {
    //     $this->getAllGenders = new GetAllGenders();
    // }

    public function getAllGenders()
    {
        return ($this->getAllGenders)();
    }
}
