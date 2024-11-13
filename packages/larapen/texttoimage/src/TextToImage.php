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

namespace Larapen\TextToImage;

use Intervention\Image\Image;
use Larapen\TextToImage\Libraries\Settings;
use Larapen\TextToImage\Libraries\TextToImageEngine;

class TextToImage
{
	/**
	 * @param string $string
	 * @param array $overrides
	 * @param bool $embedded
	 * @return \Intervention\Image\Image|string
	 * @throws \App\Exceptions\Custom\CustomException
	 */
	public function make(string $string, array $overrides = [], bool $embedded = true): Image|string
	{
		if (trim($string) == '') {
			return $string;
		}
		
		$settings = Settings::createFromIni(__DIR__ . DIRECTORY_SEPARATOR . 'settings.ini');
		$settings->assignProperties($overrides);
		$settings->fontFamily = __DIR__ . '/Libraries/font/' . $settings->fontFamily;
		if (!empty($settings->boldFontFamily)) {
			$boldFontFamily = __DIR__ . '/Libraries/font/' . $settings->boldFontFamily;
			$settings->boldFontFamily = file_exists($boldFontFamily) ? $boldFontFamily : null;
		}
		
		$engine = new TextToImageEngine($settings);
		$engine = $engine->setText($string);
		
		if ($embedded) {
			return $engine->getEmbeddedImage();
		}
		
		return $engine->getImage();
	}
}