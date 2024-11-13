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
use App\Models\Package;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentNotification extends BaseNotification
{
	protected ?Payment $payment;
	protected ?object $post;
	protected ?Package $package = null;
	protected ?PaymentMethod $paymentMethod = null;
	
	public function __construct(?Payment $payment, ?object $post)
	{
		$this->payment = $payment;
		$this->post = $post;
		if (isset($payment->package_id)) {
			$this->package = Package::find($payment->package_id);
		}
		if (isset($payment->payment_method_id)) {
			$this->paymentMethod = PaymentMethod::find($payment->payment_method_id);
		}
	}
	
	protected function shouldSendNotificationWhen($notifiable): bool
	{
		return (
			!empty($this->payment)
			&& !empty($this->post)
			&& !empty($this->package)
			&& !empty($this->paymentMethod)
		);
	}
	
	protected function determineViaChannels($notifiable): array
	{
		return ['mail'];
	}
	
	public function toMail($notifiable): MailMessage
	{
		$postUrl = UrlGen::post($this->post);
		
		return (new MailMessage)
			->subject(trans('mail.payment_notification_title'))
			->greeting(trans('mail.payment_notification_content_1'))
			->line(trans('mail.payment_notification_content_2', [
				'advertiserName' => $this->post->contact_name,
				'postUrl'        => $postUrl,
				'title'          => $this->post->title,
			]))
			->line('<br>')
			->line(trans('mail.payment_notification_content_3', [
				'postId'            => $this->post->id,
				'packageName'       => !empty($this->package->short_name) ? $this->package->short_name : $this->package->name,
				'amount'            => $this->package->price,
				'currency'          => $this->package->currency_code,
				'paymentMethodName' => $this->paymentMethod->display_name,
			]))
			->salutation(trans('mail.footer_salutation', ['appName' => config('app.name')]));
	}
}