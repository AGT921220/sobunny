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

namespace App\Http\Controllers\Web\Admin\Panel\Library\Traits\Panel;

trait AutoFocus
{
	public $autoFocusOnFirstField = true;
	
	/**
	 * @return bool
	 */
	public function getAutoFocusOnFirstField(): bool
	{
		return $this->autoFocusOnFirstField;
	}
	
	/**
	 * @param $value
	 * @return bool
	 */
	public function setAutoFocusOnFirstField($value): bool
	{
		return $this->autoFocusOnFirstField = (bool)$value;
	}
	
	/**
	 * @return bool
	 */
	public function enableAutoFocus(): bool
	{
		return $this->setAutoFocusOnFirstField(true);
	}
	
	/**
	 * @return bool
	 */
	public function disableAutoFocus(): bool
	{
		return $this->setAutoFocusOnFirstField(false);
	}
}
