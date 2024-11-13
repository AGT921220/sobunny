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

namespace App\Helpers\Categories\Traits;

use App\Helpers\DBTool\DBIndex;

trait IndexesTrait
{
	/**
	 * Create the Nested Set indexes
	 *
	 * @return void
	 * @throws \App\Exceptions\Custom\CustomException
	 */
	public function createNestedSetIndexes(): void
	{
		$this->checkTablesAndColumns();
		
		// Make the 'lft' & 'rgt' columns unique and index the 'depth' column
		
		// Check if a unique indexes key exist, and drop it.
		DBIndex::dropIndexIfExists($this->nestedTable, 'lft');
		DBIndex::dropIndexIfExists($this->nestedTable, 'rgt');
		DBIndex::dropIndexIfExists($this->nestedTable, 'depth');
		
		// Create indexes
		DBIndex::createIndexIfNotExists($this->nestedTable, 'lft'); // Should be unique
		DBIndex::createIndexIfNotExists($this->nestedTable, 'rgt'); // Should be unique
		DBIndex::createIndexIfNotExists($this->nestedTable, 'depth');
	}
}