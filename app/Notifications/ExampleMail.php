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

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

/*
 * Note: Implementing "Illuminate\Contracts\Queue\ShouldQueue"
 * allows Laravel to save mail sending as Queue in the database
 */

class ExampleMail extends BaseNotification
{
	protected function shouldSendNotificationWhen($notifiable): bool
	{
		return !isDemoDomain();
	}
	
	protected function determineViaChannels($notifiable): array
	{
		return ['mail'];
	}
	
	public function toMail(object $notifiable): MailMessage
	{
		return (new MailMessage)
			->subject(trans('mail.email_example_title', ['appName' => config('app.name')]))
			->greeting(trans('mail.email_example_content_1'))
			->line(trans('mail.email_example_content_2', ['appName' => config('app.name')]))
			->salutation(trans('mail.footer_salutation', ['appName' => config('app.name')]));
	}
}