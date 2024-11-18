<?php

namespace Database\Seeders;

use App\Models\Age;
use App\Models\BodyType;
use App\Models\Breast;
use App\Models\Cater;
use App\Models\Ethnicity;
use App\Models\EyeColor;
use App\Models\Gender;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\ServiceType;
use App\Models\Servicing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::insert([
            ['name' => 'Female'],
            ['name' => 'Male'],
            ['name' => 'Gay'],
            ['name' => 'Trans']
        ]);

        // Ethnicities
        Ethnicity::insert([
            ['name' => 'Asian'],
            ['name' => 'Caucasian'],
            ['name' => 'Pacific Islander'],
            ['name' => 'Ebony'],
            ['name' => 'Latina'],
            ['name' => 'Exotic'],
            ['name' => 'Middle Eastern']
        ]);

        // Ages
        Age::insert([
            ['name' => '21 - 25'],
            ['name' => '26 - 30'],
            ['name' => '31 - 35'],
            ['name' => '36 - 40'],
            ['name' => '41 - 45'],
            ['name' => '46 - 50'],
            ['name' => '51+']
        ]);
    

        // Body Types
        BodyType::insert([
            ['name' => 'Slim'],
            ['name' => 'Bbw'],
            ['name' => 'Petite'],
            ['name' => 'Curvy'],
            ['name' => 'Pregnant']
        ]);

        // Service Types
        ServiceType::insert([
            ['name' => 'Escort'],
            ['name' => 'Massage']
        ]);

        // Caters
        Cater::insert([
            ['name' => 'Men'],
            ['name' => 'Women'],
            ['name' => 'Couples'],
            ['name' => 'Gay']
        ]);

        // Breast Sizes
        Breast::insert([
            ['name' => 'Small'],
            ['name' => 'Medium'],
            ['name' => 'Large'],
            ['name' => 'Extra Large']
        ]);

        // Heights
        Height::insert([
            ['name' => '4\'3"'],
            ['name' => '4\'5"'],
            ['name' => '4\'9"'],
            ['name' => '5\'1"'],
            ['name' => '5\'5"'],
            ['name' => '5\'8"'],
            ['name' => '6\'1"'],
            ['name' => '6\'5"'],
            ['name' => '6\'7"'],
            ['name' => '6\'10"']
        ]);

        // Hair Colors
        HairColor::insert([
            ['name' => 'Blonde'],
            ['name' => 'Brunette'],
            ['name' => 'Redhead']
        ]);

        // Eye Colors
        EyeColor::insert([
            ['name' => 'Green'],
            ['name' => 'Blue'],
            ['name' => 'Brown'],
            ['name' => 'Black'],
            ['name' => 'Hazel']
        ]);

        // Servicing
        Servicing::insert([
            ['name' => 'Incall'],
            ['name' => 'Outcall'],
            ['name' => ' Incall / Outcall']
        ]);
    }
}
