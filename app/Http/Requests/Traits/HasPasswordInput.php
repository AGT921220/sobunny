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

namespace App\Http\Requests\Traits;

use Illuminate\Validation\Rules\Password;

trait HasPasswordInput
{
	/**
	 * Valid Password Rules
	 *
	 * @param array $rules
	 * @param string $field
	 * @return array
	 */
	protected function passwordRules(array $rules = [], string $field = 'password'): array
	{
		if ($this->filled($field)) {
			$rule = Password::min(config('settings.security.password_min_length', 6));
			if (config('settings.security.password_letters_required')) {
				$rule->letters();
			}
			if (config('settings.security.password_mixedCase_required')) {
				$rule->mixedCase();
			}
			if (config('settings.security.password_numbers_required')) {
				$rule->numbers();
			}
			if (config('settings.security.password_symbols_required')) {
				$rule->symbols();
			}
			if (config('settings.security.password_uncompromised_required')) {
				$rule->uncompromised(config('settings.security.password_uncompromised_threshold', 0));
			}
			$rules[$field][] = $rule;
			
			$rules[$field][] = 'max:' . config('settings.security.password_max_length', 60);
		}
		
		return $rules;
	}
}