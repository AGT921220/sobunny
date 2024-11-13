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

namespace App\Http\Requests\Admin\SettingRequest;

use App\Http\Requests\Admin\Request;
use App\Http\Requests\Admin\SettingRequest\MailRequest\MailDriverRequest;

/*
 * Use request() instead of $this since this form request can be called from another
 */

class MailRequest extends Request
{
	protected array $mailDriverRulesMessages = [];
	protected array $mailDriverRulesAttributes = [];
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		$request = request();
		
		$rules = [];
		
		// Selected mail driver's rules
		$mailDriver = $request->input('driver');
		if (!empty($mailDriver)) {
			$appName = config('settings.app.name');
			$mailTo = $request->input('email_always_to');
			$settings = $request->all();
			
			$formRequest = new MailDriverRequest($appName, $mailTo, $settings);
			$rules = $rules + $formRequest->rules();
			$this->mailDriverRulesMessages = $formRequest->messages();
			$this->mailDriverRulesAttributes = $formRequest->attributes();
		}
		
		return $rules;
	}
	
	/**
	 * @return array
	 */
	public function messages(): array
	{
		$messages = [];
		
		if (!empty($this->mailDriverRulesMessages)) {
			$messages = $messages + $this->mailDriverRulesMessages;
		}
		
		return array_merge(parent::messages(), $messages);
	}
	
	/**
	 * @return array
	 */
	public function attributes(): array
	{
		$attributes = [];
		
		if (!empty($this->mailDriverRulesAttributes)) {
			$attributes = $attributes + $this->mailDriverRulesAttributes;
		}
		
		return array_merge(parent::attributes(), $attributes);
	}
}