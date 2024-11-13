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

namespace App\Enums;

enum UserType: int
{
	use EnumToArray;
	
	case PROFESSIONAL = 1;
	case INDIVIDUAL = 2;
	
	public function label(): string
	{
		return match ($this) {
			self::PROFESSIONAL => trans('enum.user_professional'),
			self::INDIVIDUAL => trans('enum.user_individual'),
		};
	}
}