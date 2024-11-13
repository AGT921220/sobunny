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

use App\Services\UrlGen;
use App\Models\ReportType;
use Illuminate\Notifications\Messages\MailMessage;

class ReportSent extends BaseNotification
{
	protected ?object $post;
	protected ?object $report;
	
	public function __construct(?object $post, ?object $report)
	{
		$this->post = $post;
		$this->report = $report;
	}
	
	protected function shouldSendNotificationWhen($notifiable): bool
	{
		return !isDemoDomain();
	}
	
	protected function determineViaChannels($notifiable): array
	{
		return ['mail'];
	}
	
	public function toMail($notifiable): MailMessage
	{
		$postUrl = UrlGen::post($this->post);
		
		$reportType = ReportType::find($this->report->report_type_id);
		
		$mailMessage = (new MailMessage)
			->replyTo($this->report->email, $this->report->email)
			->subject(trans('mail.post_report_sent_title', [
				'appName'     => config('app.name'),
				'countryCode' => $this->post->country_code,
			]))
			->line(trans('mail.Listing URL') . ': <a href="' . $postUrl . '">' . $postUrl . '</a>');
		
		if (!empty($reportType)) {
			$mailMessage->line(t('Reason') . ': ' . $reportType->name);
		}
		
		$mailMessage->line(t('Message') . ': <br>' . nl2br($this->report->message))
			->salutation(trans('mail.footer_salutation', ['appName' => config('app.name')]));
		
		return $mailMessage;
	}
}
