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

use App\Enums\UserType;

/**
 * @group Users
 */
class UserTypeController extends BaseController
{
	/**
	 * List user types
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): \Illuminate\Http\JsonResponse
	{
		$userTypes = UserType::all();
		
		$message = empty($userTypes) ? t('no_user_types_found') : null;
		
		$data = [
			'success' => true,
			'message' => $message,
			'result'  => $userTypes,
		];
		
		return apiResponse()->json($data);
	}
	
	/**
	 * Get user type
	 *
	 * @urlParam id int required The user type's ID. Example: 1
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id): \Illuminate\Http\JsonResponse
	{
		$userType = UserType::find($id);
		
		abort_if(empty($userType), 404, t('user_type_not_found'));
		
		$data = [
			'success' => true,
			'result'  => $userType,
		];
		
		return apiResponse()->json($data);
	}
}
