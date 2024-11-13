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

namespace App\Http\Controllers\Web\Public\Search\Traits;

use App\Services\UrlGen;
use App\Http\Controllers\Web\Public\Post\Traits\CatBreadcrumbTrait;
use Illuminate\Support\Arr;

trait TitleTrait
{
	use CatBreadcrumbTrait;
	
	/**
	 * Get Search HTML Title
	 *
	 * @param array|null $preSearch
	 * @param array|null $sidebar
	 * @return string
	 */
	public function getHtmlTitle(?array $preSearch = [], ?array $sidebar = []): string
	{
		// Get the Location's right arguments
		$cityId = request()->input('l');
		$stateName = request()->input('r');
		$isStateRequested = (!empty($stateName) && empty($cityId));
		
		// Get pre-searched objects/vars
		$state = data_get($preSearch, 'admin');
		$city = data_get($preSearch, 'city');
		$currentDistance = data_get($preSearch, 'distance.current', 0);
		$category = data_get($preSearch, 'cat');
		$parentCat = data_get($preSearch, 'cat.parent');
		
		// Title
		$htmlTitle = '';
		
		// Init.
		$htmlTitle .= '<a href="' . UrlGen::searchWithoutQuery() . '" class="current">';
		$htmlTitle .= '<span>' . t('All listings') . '</span>';
		$htmlTitle .= '</a>';
		
		// Location
		if ($isStateRequested) {
			// State (Admin. Division)
			if (!empty($state)) {
				$searchUrl = UrlGen::searchWithoutCity($category, $state);
				
				$htmlTitle .= ' ' . t('in') . ' ';
				$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
				$htmlTitle .= data_get($state, 'name');
				$htmlTitle .= '</a>';
			}
		} else {
			// City
			if (!empty($city)) {
				$searchUrl = UrlGen::searchWithoutCity($category, $city);
				
				if (config('settings.listings_list.cities_extended_searches')) {
					$distance = ($currentDistance == 1) ? 0 : $currentDistance;
					$htmlTitle .= ' ' . t('within') . ' ';
					$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
					$htmlTitle .= t('x_distance_around_city', [
						'distance' => $distance,
						'unit'     => getDistanceUnit(config('country.code')),
						'city'     => data_get($city, 'name'),
					]);
				} else {
					$htmlTitle .= ' ' . t('in') . ' ';
					$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
					$htmlTitle .= data_get($city, 'name');
				}
				$htmlTitle .= '</a>';
			}
		}
		
		// Category
		if (!empty($category)) {
			if (!empty($parentCat)) {
				$searchUrl = UrlGen::searchWithoutCategory($parentCat, $city);
				
				$htmlTitle .= ' ' . t('in') . ' ';
				$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
				$htmlTitle .= data_get($parentCat, 'name');
				$htmlTitle .= '</a>';
			}
			$searchUrl = UrlGen::searchWithoutCategory($category, $city);
			
			$htmlTitle .= ' ' . t('in') . ' ';
			$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
			$htmlTitle .= data_get($category, 'name');
			$htmlTitle .= '</a>';
		}
		
		// Tag
		if (!empty($this->tag)) {
			$htmlTitle .= ' ' . t('for') . ' ';
			$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . UrlGen::searchWithoutQuery() . '">';
			$htmlTitle .= $this->tag;
			$htmlTitle .= '</a>';
		}
		
		// Date
		$postedDate = request()->input('postedDate');
		$postedDateLabel = data_get($sidebar, 'periodList.' . $postedDate);
		if (!empty($postedDateLabel)) {
			$searchUrl = UrlGen::searchWithoutDate($category, $city);
			
			$htmlTitle .= t('last');
			$htmlTitle .= '<a rel="nofollow" class="jobs-s-tag" href="' . $searchUrl . '">';
			$htmlTitle .= $postedDateLabel;
			$htmlTitle .= '</a>';
		}
		
		view()->share('htmlTitle', $htmlTitle);
		
		return $htmlTitle;
	}
	
	/**
	 * Get Breadcrumbs Tabs
	 *
	 * @param array|null $preSearch
	 * @return array
	 */
	public function getBreadcrumb(?array $preSearch = []): array
	{
		// Get pre-searched objects
		$state = data_get($preSearch, 'admin');
		$city = data_get($preSearch, 'city');
		$currentDistance = data_get($preSearch, 'distance.current', 0);
		$category = data_get($preSearch, 'cat');
		
		// ...
		
		$bcTab = [];
		
		// City
		if (!empty($city)) {
			$distance = ($currentDistance == 1) ? 0 : $currentDistance;
			$title = t('in_x_distance_around_city', [
				'distance' => $distance,
				'unit'     => getDistanceUnit(config('country.code')),
				'city'     => data_get($city, 'name'),
			]);
			
			$bcTab[] = collect([
				'name'     => t('All listings') . ' ' . $title,
				'url'      => UrlGen::city($city),
				'position' => !empty($category) ? 5 : 3,
				'location' => true,
			]);
		}
		
		// State (Admin. Division)
		if (!empty($state)) {
			$params = [
				'country' => config('country.icode'),
				'r'       => data_get($state, 'name'),
			];
			$searchUrl = UrlGen::search($params);
			$paramsToRemove = ['l', 'location', 'distance'];
			$searchUrl = urlQuery($searchUrl)->removeParameters($paramsToRemove)->toString();
			
			$title = data_get($state, 'name');
			
			$bcTab[] = collect([
				'name'     => !empty($category) ? (t('All listings') . ' ' . $title) : data_get($state, 'name'),
				'url'      => $searchUrl,
				'position' => !empty($category) ? 5 : 3,
				'location' => true,
			]);
		}
		
		// Category
		$catBreadcrumb = $this->getCatBreadcrumb($category, 3);
		$bcTab = array_merge($bcTab, $catBreadcrumb);
		
		// Sort by Position
		$bcTab = array_values(Arr::sort($bcTab, function ($value) {
			return $value->get('position');
		}));
		
		view()->share('bcTab', $bcTab);
		
		return $bcTab;
	}
}