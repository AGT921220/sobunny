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

namespace App\Observers;

use App\Helpers\Files\Storage\StorageDisk;
use App\Models\ThreadMessage;

class ThreadMessageObserver
{
	/**
	 * Listen to the Entry deleting event.
	 *
	 * @param ThreadMessage $message
	 * @return void
	 */
	public function deleting(ThreadMessage $message)
	{
		// Storage Disk Init.
		$disk = StorageDisk::getDisk();
		
		// Delete the message's file
		if (!empty($message->file_path)) {
			if ($disk->exists($message->file_path)) {
				$disk->delete($message->file_path);
			}
		}
	}
}
