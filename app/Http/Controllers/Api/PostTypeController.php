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

namespace App\Http\Controllers\Api;

use App\Enums\PostType;

/**
 * @group Listings
 */
class PostTypeController extends BaseController
{
	/**
	 * List listing types
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): \Illuminate\Http\JsonResponse
	{
		$postTypes = PostType::all();
		
		$message = empty($postTypes) ? t('no_post_types_found') : null;
		
		$data = [
			'success' => true,
			'message' => $message,
			'result'  => $postTypes,
		];
		
		return apiResponse()->json($data);
	}
	
	/**
	 * Get listing type
	 *
	 * @urlParam id int required The listing type's ID. Example: 1
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id): \Illuminate\Http\JsonResponse
	{
		$postType = PostType::find($id);
		
		abort_if(empty($postType), 404, t('post_type_not_found'));
		
		$data = [
			'success' => true,
			'result'  => $postType,
		];
		
		return apiResponse()->json($data);
	}
}
