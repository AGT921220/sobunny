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

namespace App\Http\Controllers\Web\Install\Traits\Install\Db;

use App\Helpers\DBTool;
use App\Helpers\DBTool\DBEncoding;

trait CharsetTrait
{
	/**
	 * @param array $databaseInfo
	 * @return array
	 */
	private function setDatabaseConnectionCharsetAndCollation(array $databaseInfo): array
	{
		$pdo = null;
		
		// Try to get PDO connexion
		try {
			$pdo = DBTool::getPdoConnection($databaseInfo);
		} catch (\Throwable $e) {
		}
		
		// Get default charset & collation
		$defaultCharset = config('larapen.core.database.encoding.default.charset', 'utf8mb4');
		$defaultCollation = config('larapen.core.database.encoding.default.collation', 'utf8mb4_unicode_ci');
		
		// Find the charset & collation to set in the /.env file
		$charsetAndCollation = DBEncoding::findConnectionCharsetAndCollation($pdo);
		$databaseInfo['charset'] = $charsetAndCollation['charset'] ?? $defaultCharset;
		$databaseInfo['collation'] = $charsetAndCollation['collation'] ?? $defaultCollation;
		
		return $databaseInfo;
	}
}
