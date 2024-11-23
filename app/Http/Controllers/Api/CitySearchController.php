<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CitySearchController extends Controller
{

	public function index(Request $request)
	{
		$search = $request->get('q');

		return City::where('name', 'LIKE', "%{$search}%")->get();

		return City::whereRaw("JSON_EXTRACT(name, '$.en') LIKE ?", ["%{$search}%"])->get();
		return  City::whereRaw("JSON_EXTRACT(name, '$.en') LIKE ?", ["%{$search}%"])->get();





		return City::whereRaw("JSON_EXTRACT(name, '$search') IS NOT NULL")->get();






		return $request->all();
	}
}
