<?php
/*
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 * Author: Mayeul Akpovi (BeDigit - https://bedigit.com)
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - https://codecanyon.net/licenses/standard
 */

namespace App\Providers;

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
use App\Models\Sanctum\PersonalAccessToken;
use App\Providers\AppService\AclSystemTrait;
use App\Providers\AppService\ConfigTrait;
use App\Providers\AppService\SchemaStringLengthTrait;
use App\Providers\AppService\SymlinkTrait;
use App\Providers\AppService\TelescopeTrait;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
	use SchemaStringLengthTrait, TelescopeTrait, AclSystemTrait, ConfigTrait, SymlinkTrait;
	
	private int $cacheExpiration = 86400; // Cache for 1 day (60 * 60 * 24)
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
	
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->runInspection();
		
		// Set Bootstrap as default client assets
		Paginator::useBootstrap();
		
		// Set the default schema string length
		$this->setDefaultSchemaStringLength();
		
		// Setup Laravel Sanctum
		try {
			Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
		} catch (\Throwable $e) {
		}
		
		// Setup Storage Symlink
		$this->setupStorageSymlink();
		
		// Setup ACL system
		$this->setupAclSystem();
		
		// Setup Https
		$this->setupHttps();
		
		// Setup Configs
		$this->setupConfigs();
		
		// Rate Limiters
		$this->setupRateLimiting();
		
		// Send Mails Always To
		$this->setupMailsAlwaysTo();
		// $genders = (new GetAllGenders())->__invoke();
		View::composer('search.inc.sidebar', function ($view){
			
			$genders = (new GetAllGenders())->__invoke();
			$ethnicities = (new GetAllEthnicitys())->__invoke();
			$ages = (new GetAllAges())->__invoke();
			$breasts = (new GetAllBreasts())->__invoke();
			$caters = (new GetAllCaters())->__invoke();
			$bodyTypes = (new GetAllBodyTypes())->__invoke();
			$eyeColors = (new GetAllEyeColors())->__invoke();
			$hairColors = (new GetAllHairColors())->__invoke();
			$serviceTypes = (new GetAllServiceTypes())->__invoke();
			$servicings = (new GetAllServicings())->__invoke();
			$heights = (new GetAllHeights())->__invoke();

			$view->with('genders', $genders);
			$view->with('ethnicities', $ethnicities);
			$view->with('ages', $ages);
			$view->with('breasts', $breasts);
			$view->with('caters', $caters);
			$view->with('bodyTypes', $bodyTypes);
			$view->with('eyeColors', $eyeColors);
			$view->with('hairColors', $hairColors);
			$view->with('serviceTypes', $serviceTypes);
			$view->with('servicings', $servicings);
			$view->with('heights', $heights);

			// $view->with('variable2', ['key' => 'value']);
		});
	}
	
	/**
	 * Setup Https
	 */
	private function setupHttps()
	{
		// Force HTTPS protocol
		if (config('larapen.core.forceHttps')) {
			URL::forceScheme('https');
		}
	}
	
	/**
	 * Configure the rate limiters for the application.
	 */
	private function setupRateLimiting(): void
	{
		// More Info: https://laravel.com/docs/10.x/routing#rate-limiting
		
		// API rate limit
		RateLimiter::for('api', function (Request $request) {
			// Exception for local and demo environments
			if (isLocalEnv() || isDemoEnv()) {
				return isLocalEnv()
					? Limit::none()
					: (
					$request->user()
						? Limit::perMinute(90)->by($request->user()->id)
						: Limit::perMinute(60)->by($request->ip())
					);
			}
			
			// Limits access to the routes associated with it to:
			// - (For logged users): 1200 requests per minute by user ID
			// - (For guests): 600 requests per minute by IP address
			return $request->user()
				? Limit::perMinute(1200)->by($request->user()->id)
				: Limit::perMinute(600)->by($request->ip());
		});
		
		// Global rate limit (Not used)
		RateLimiter::for('global', function (Request $request) {
			// Limits access to the routes associated with it to:
			// - 1000 requests per minute
			return Limit::perMinute(1000);
		});
	}
}
