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

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LocaleOfLanguageRule implements ValidationRule
{
	public ?string $langCode = null;
	
	public function __construct(?string $langCode)
	{
		$this->langCode = $langCode;
	}
	
	/**
	 * Run the validation rule.
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!$this->passes($attribute, $value)) {
			$fail(trans('validation.locale_of_language_rule'));
		}
	}
	
	/**
	 * Determine if the validation rule passes.
	 * Check the Locale related to the Language Code.
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @return bool
	 */
	public function passes(string $attribute, mixed $value): bool
	{
		$value = getAsString($value);
		$locales = getLocalesWithName();
		
		$filtered = collect($locales)
			->filter(function ($name, $locale) {
				return str_starts_with($locale, $this->langCode);
			});
		
		if ($filtered->isNotEmpty()) {
			return str_starts_with($value, $this->langCode);
		}
		
		return isset($locales[$value]);
	}
}
