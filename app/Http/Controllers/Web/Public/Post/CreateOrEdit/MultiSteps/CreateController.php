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

namespace App\Http\Controllers\Web\Public\Post\CreateOrEdit\MultiSteps;

use App\Enums\PostType;
use App\Feature\Age\UseCases\GetAllAges;
use App\Feature\BodyType\UseCases\GetAllBodyTypes;
use App\Feature\Breast\UseCases\GetAllBreasts;
use App\Feature\Cater\UseCases\GetAllCaters;
use App\Feature\Ethnicity\UseCases\GetAllEthnicitys;
use App\Feature\EyeColor\UseCases\GetAllEyeColors;
use App\Feature\Geneder\UseCases\GetAllGenders;
use App\Feature\HairColor\UseCases\GetAllHairColors;
use App\Feature\Height\UseCases\GetAllHeights;
use App\Feature\ServiceType\UseCases\GetAllServiceTypes;
use App\Feature\Servicing\UseCases\GetAllServicings;
use App\Helpers\Files\TmpUpload;
use App\Services\UrlGen;
use App\Http\Controllers\Api\Payment\HasPaymentTrigger;
use App\Http\Controllers\Api\Payment\Promotion\SingleStepPayment;
use App\Http\Controllers\Api\Payment\HasPaymentReferrers;
use App\Http\Controllers\Web\Public\Auth\Traits\VerificationTrait;
use App\Http\Controllers\Web\Public\Payment\HasPaymentRedirection;
use App\Http\Controllers\Web\Public\Post\CreateOrEdit\MultiSteps\Traits\Create\ClearTmpInputTrait;
use App\Http\Controllers\Web\Public\Post\CreateOrEdit\MultiSteps\Traits\Create\SubmitTrait;
use App\Http\Controllers\Web\Public\Post\CreateOrEdit\MultiSteps\Traits\WizardTrait;
use App\Http\Controllers\Web\Public\Post\CreateOrEdit\Traits\PricingPageUrlTrait;
use App\Http\Requests\Front\PackageRequest;
use App\Http\Requests\Front\PhotoRequest;
use App\Http\Requests\Front\PostRequest;
use App\Models\CategoryField;
use App\Models\Post;
use App\Models\Scopes\VerifiedScope;
use App\Http\Controllers\Web\Public\FrontController;
use App\Models\Scopes\ReviewedScope;
use App\Observers\Traits\PictureTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Larapen\LaravelMetaTags\Facades\MetaTag;

class CreateController extends FrontController
{
	use VerificationTrait;
	use HasPaymentReferrers;
	use WizardTrait;
	use PricingPageUrlTrait;
	use PictureTrait, ClearTmpInputTrait;
	use SubmitTrait;
	use HasPaymentTrigger, SingleStepPayment, HasPaymentRedirection;

	protected string $baseUrl = '/posts/create';
	protected string $cfTmpUploadDir = 'temporary';
	protected string $tmpUploadDir = 'temporary';

	private $getAllGenders;
	private $getAllEthnicitys;
	private $getAllAges;
	private $getAllBreasts;
	private $getAllCaters;
	private $getAllBodyTypes;
	private $getAllEyeColors;
	private $getAllHairColors;
	private $getAllHeighs;
	private $getAllServiceTypes;
	private $getAllServicings;

	public function __construct(
		GetAllGenders $getAllGenders,
		GetAllEthnicitys $getAllEthnicitys,
		GetAllAges $getAllAges,
		GetAllCaters $getAllCaters,
		GetAllBreasts $getAllBreasts,
		GetAllEyeColors $getAllEyeColors,
		GetAllHairColors $getAllHairColors,
		GetAllHeights $getAllHeighs,
		GetAllServiceTypes $getAllServiceTypes,
		GetAllServicings $getAllServicings,
		GetAllBodyTypes $getAllBodyTypes
	) {
		parent::__construct();

		$this->commonQueries();

		$this->baseUrl = url($this->baseUrl);
		$this->getAllGenders = $getAllGenders;
		$this->getAllEthnicitys = $getAllEthnicitys;
		$this->getAllAges = $getAllAges;
		$this->getAllBreasts = $getAllBreasts;
		$this->getAllCaters = $getAllCaters;
		$this->getAllBodyTypes = $getAllBodyTypes;
		$this->getAllEyeColors = $getAllEyeColors;
		$this->getAllHairColors = $getAllHairColors;
		$this->getAllHeighs = $getAllHeighs;
		$this->getAllServiceTypes = $getAllServiceTypes;
		$this->getAllServicings = $getAllServicings;
	}

	/**
	 * Get the middleware that should be assigned to the controller.
	 */
	public static function middleware(): array
	{
		$array = [];

		// Check if guests can post listings
		if (!doesGuestHaveAbilityToCreateListings()) {
			$array[] = 'auth';
		}

		return array_merge(parent::middleware(), $array);
	}

	/**
	 * @return void
	 */
	public function commonQueries(): void
	{
		$this->getPaymentReferrersData();
		$this->setPaymentSettingsForPromotion();

		if (config('settings.listing_form.show_listing_type')) {
			$postTypes = PostType::all();
			view()->share('postTypes', $postTypes);
		}

		// Meta Tags
		[$title, $description, $keywords] = getMetaTag('create');
		MetaTag::set('title', $title);
		MetaTag::set('description', strip_tags($description));
		MetaTag::set('keywords', $keywords);
	}

	/**
	 * Checking for the current step
	 *
	 * @param Request $request
	 * @return int
	 */
	public function step(Request $request): int
	{
		if ($request->query('error') == 'paymentCancelled') {
			if ($request->session()->has('postId')) {
				$request->session()->forget('postId');
			}
		}

		$postId = $request->session()->get('postId');

		$step = 0;

		$data = $request->session()->get('postInput');
		if (isset($data) || !empty($postId)) {
			$step = 1;
		} else {
			return $step;
		}

		$data = $request->session()->get('picturesInput');
		if (isset($data) || !empty($postId)) {
			$step = 2;
		} else {
			return $step;
		}

		$data = $request->session()->get('paymentInput');
		if (isset($data) || !empty($postId)) {
			$step = 3;
		} else {
			return $step;
		}

		return $step;
	}

	/**
	 * Post's Step
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function getPostStep(Request $request): View|RedirectResponse
	{
		// Check if the 'Pricing Page' must be started first, and make redirection to it.
		$pricingUrl = $this->getPricingPage($this->getSelectedPackage());
		if (!empty($pricingUrl)) {
			return redirect()->to($pricingUrl)->withHeaders(config('larapen.core.noCacheHeaders'));
		}

		// Check if the form type is 'Single-Step Form' and make redirection to it (permanently).
		$isSingleStepFormEnabled = (config('settings.listing_form.publication_form_type') == '2');
		if ($isSingleStepFormEnabled) {
			$url = url('create');

			return redirect()->to($url, 301)->withHeaders(config('larapen.core.noCacheHeaders'));
		}

		// Create an unique temporary ID
		if (!$request->session()->has('cfUid')) {
			$request->session()->put('cfUid', 'cf-' . uniqueCode(9));
		}

		$this->shareWizardMenu($request);

		$postInput = $request->session()->get('postInput');

		//AQUI
		$genders = $this->getAllGenders->__invoke();
		$ethnicities = $this->getAllEthnicitys->__invoke();
		$ages = $this->getAllAges->__invoke();
		$breasts = $this->getAllBreasts->__invoke();
		$caters = $this->getAllCaters->__invoke();
		$bodyTypes = $this->getAllBodyTypes->__invoke();
		$eyeColors = $this->getAllEyeColors->__invoke();
		$hairColors = $this->getAllHairColors->__invoke();
		$serviceTypes = $this->getAllServiceTypes->__invoke();
		$servicings = $this->getAllServicings->__invoke();
		$heights = $this->getAllHeighs->__invoke();
		return appView('post.createOrEdit.multiSteps.create', compact(
			'postInput',
			'genders',
			'ethnicities',
			'ages',
			'breasts',
			'caters',
			'bodyTypes',
			'eyeColors',
			'hairColors',
			'serviceTypes',
			'servicings',
			'heights'

		));
	}

	/**
	 * Post's Step (POST)
	 *
	 * @param \App\Http\Requests\Front\PostRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postPostStep(PostRequest $request): RedirectResponse
	{
		$postInput = $request->all();
		
		// Use unique ID to store post's pictures
		if ($request->session()->has('cfUid')) {
			$this->cfTmpUploadDir = $this->cfTmpUploadDir . '/' . $request->session()->get('cfUid');
		}

		// Save uploaded files
		// Get Category's Fields details
		$fields = CategoryField::getFields($request->input('category_id'));
		if ($fields->count() > 0) {
			foreach ($fields as $field) {
				if ($field->type == 'file') {
					if ($request->hasFile('cf.' . $field->id)) {
						// Get the file
						$file = $request->file('cf.' . $field->id);

						// Check if the file is valid
						if (!$file->isValid()) {
							continue;
						}

						$postInput['cf'][$field->id] = TmpUpload::file($this->cfTmpUploadDir, $file);
					}
				}
			}
		}

		$request->session()->put('postInput', $postInput);

		// Get the next URL
		$nextUrl = url('posts/create/photos');
		$nextUrl = urlQuery($nextUrl)
			->setParameters(request()->only(['package']))
			->toString();

		return redirect()->to($nextUrl);
	}

	/**
	 * Pictures' Step
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function getPicturesStep(Request $request): View|RedirectResponse
	{
		if ($this->step($request) < 1) {
			$backUrl = urlQuery($this->baseUrl)
				->setParameters(request()->only(['package']))
				->toString();

			return redirect()->to($backUrl);
		}

		// Check if the 'Pricing Page' must be started first, and make redirection to it.
		$pricingUrl = $this->getPricingPage($this->getSelectedPackage());
		if (!empty($pricingUrl)) {
			return redirect()->to($pricingUrl)->withHeaders(config('larapen.core.noCacheHeaders'));
		}

		$this->shareWizardMenu($request);

		// Create an unique temporary ID
		if (!$request->session()->has('uid')) {
			$request->session()->put('uid', uniqueCode(9));
		}

		$picturesInput = $request->session()->get('picturesInput');

		// Get next step URL
		if (
			isset($this->countPackages, $this->countPaymentMethods)
			&& $this->countPackages > 0
			&& $this->countPaymentMethods > 0
		) {
			$nextUrl = url('posts/create/payment');
			$nextStepLabel = t('Next');
		} else {
			$nextUrl = url('posts/create/finish');
			$nextStepLabel = t('submit');
		}
		$nextUrl = urlQuery($nextUrl)
			->setParameters(request()->only(['package']))
			->toString();

		view()->share('nextStepUrl', $nextUrl);
		view()->share('nextStepLabel', $nextStepLabel);

		return appView('post.createOrEdit.multiSteps.photos.create', compact('picturesInput'));
	}

	/**
	 * Pictures' Step (POST)
	 *
	 * @param \App\Http\Requests\Front\PhotoRequest $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 */
	public function postPicturesStep(PhotoRequest $request): JsonResponse|RedirectResponse
	{
		if (!isFromAjax($request)) {
			if ($this->step($request) < 1) {
				$backUrl = urlQuery($this->baseUrl)
					->setParameters(request()->only(['package']))
					->toString();

				return redirect()->to($backUrl);
			}
		}

		$savedPicturesInput = (array)$request->session()->get('picturesInput');

		// Get default/global pictures limit
		$defaultPicturesLimit = (int)config('settings.listing_form.pictures_limit', 5);

		// Get the picture number limit
		$countExistingPictures = count($savedPicturesInput);
		$picturesLimit = $defaultPicturesLimit - $countExistingPictures;

		// Use unique ID to store post's pictures
		if ($request->session()->has('uid')) {
			$this->tmpUploadDir = $this->tmpUploadDir . '/' . $request->session()->get('uid');
		}

		$picturesInput = [];

		// Save uploaded files
		$files = $request->file('pictures');
		if (is_array($files) && count($files) > 0) {
			foreach ($files as $key => $file) {
				if (empty($file)) {
					continue;
				}

				$picturesInput[] = TmpUpload::image($this->tmpUploadDir, $file);

				// Check the picture number limit
				if ($key >= ($picturesLimit - 1)) {
					break;
				}
			}

			$newPicturesInput = array_merge($savedPicturesInput, $picturesInput);

			$request->session()->put('picturesInput', $newPicturesInput);
		}

		// AJAX response
		$data = [];
		$data['initialPreview'] = [];
		$data['initialPreviewConfig'] = [];
		if (isFromAjax($request)) {
			if (is_array($picturesInput) && count($picturesInput) > 0 && isset($this->disk)) {
				foreach ($picturesInput as $key => $filePath) {
					if (empty($filePath)) {
						continue;
					}

					// $isTemporary = str_starts_with($filePath, 'temporary/');
					// $pictureUrl = thumbParam($filePath)->setOption('picture-md')->url();
					// $pictureUrl = $isTemporary ? $this->disk->url($filePath) : $pictureUrl;
					$pictureUrl = thumbService($filePath)->resize('picture-md')->url();
					$deleteUrl = url('posts/create/photos/' . $key . '/delete');

					try {
						$fileSize = $this->disk->exists($filePath) ? (int)$this->disk->size($filePath) : 0;
					} catch (\Throwable $e) {
						$fileSize = 0;
					}

					// Build Bootstrap-FileInput plugin's parameters
					$data['initialPreview'][] = $pictureUrl;
					$data['initialPreviewConfig'][] = [
						'key'     => $key,
						'caption' => basename($filePath),
						'size'    => $fileSize,
						'url'     => $deleteUrl,
						'extra'   => ['id' => $key],
					];
				}
			}

			return response()->json($data);
		}

		// Response
		// Get the next URL & button label
		if (
			isset($this->countPackages, $this->countPaymentMethods)
			&& $this->countPackages > 0
			&& $this->countPaymentMethods > 0
		) {
			if (is_array($picturesInput) && count($picturesInput) > 0) {
				flash(t('The pictures have been updated'))->success();
			}

			$nextUrl = url('posts/create/payment');
			$nextUrl = urlQuery($nextUrl)
				->setParameters(request()->only(['package']))
				->toString();

			return redirect()->to($nextUrl);
		} else {
			$request->session()->flash('message', t('your_listing_is_created'));

			return $this->storeInputDataInDatabase($request);
		}
	}

	/**
	 * Payment's Step
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function getPaymentStep(Request $request): View|RedirectResponse
	{
		if ($this->step($request) < 2) {
			if (config('settings.listing_form.picture_mandatory')) {
				$backUrl = url($this->baseUrl . '/photos');
				$backUrl = urlQuery($backUrl)
					->setParameters(request()->only(['package']))
					->toString();

				return redirect()->to($backUrl);
			}
		}

		// Check if the 'Pricing Page' must be started first, and make redirection to it.
		$pricingUrl = $this->getPricingPage($this->getSelectedPackage());
		if (!empty($pricingUrl)) {
			return redirect()->to($pricingUrl)->withHeaders(config('larapen.core.noCacheHeaders'));
		}

		$this->shareWizardMenu($request);

		$payment = $request->session()->get('paymentInput');

		return appView('post.createOrEdit.multiSteps.packages.create', compact('payment'));
	}

	/**
	 * Payment's Step (POST)
	 *
	 * @param \App\Http\Requests\Front\PackageRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postPaymentStep(PackageRequest $request): RedirectResponse
	{
		if ($this->step($request) < 2) {
			if (config('settings.listing_form.picture_mandatory')) {
				$backUrl = url($this->baseUrl . '/photos');
				$backUrl = urlQuery($backUrl)
					->setParameters(request()->only(['package']))
					->toString();

				return redirect()->to($backUrl);
			}
		}

		$request->session()->put('paymentInput', $request->validated());

		return $this->storeInputDataInDatabase($request);
	}

	/**
	 * End of the steps (Confirmation)
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function finish(Request $request): View|RedirectResponse
	{
		if (!session()->has('message')) {
			return redirect()->to('/');
		}
		
		// Clear the step wizard
		if (session()->has('postId')) {
			// Get the Post
			$post = Post::query()
				->withoutGlobalScopes([VerifiedScope::class, ReviewedScope::class])
				->where('id', session('postId'))
				->first();

			abort_if(empty($post), 404, t('post_not_found'));

			session()->forget('postId');
		}

		// Redirect to the Post,
		// - If User is logged
		// - Or if Email and Phone verification option is not activated
		$doesVerificationIsDisabled = (config('settings.mail.email_verification') != 1 && config('settings.sms.phone_verification') != 1);
		if (auth()->check() || $doesVerificationIsDisabled) {
			if (!empty($post)) {
				flash(session('message'))->success();

				return redirect()->to(UrlGen::postUri($post));
			}
		}

		// Meta Tags
		MetaTag::set('title', session('message'));
		MetaTag::set('description', session('message'));

		return appView('post.createOrEdit.multiSteps.finish');
	}

	/**
	 * Remove a picture
	 *
	 * @param $pictureId
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 */
	public function removePicture($pictureId, Request $request): JsonResponse|RedirectResponse
	{
		$picturesInput = $request->session()->get('picturesInput');

		$message = t('The picture cannot be deleted');
		$result = ['status' => 0, 'message' => $message];

		if (isset($picturesInput[$pictureId])) {
			$res = true;
			try {
				$this->removePictureWithItsThumbs($picturesInput[$pictureId]);
			} catch (\Throwable $e) {
				$res = false;
			}

			if ($res) {
				unset($picturesInput[$pictureId]);

				if (!empty($picturesInput)) {
					$request->session()->put('picturesInput', $picturesInput);
				} else {
					$request->session()->forget('picturesInput');
				}

				$message = t('The picture has been deleted');

				if (isFromAjax()) {
					$result['status'] = 1;
					$result['message'] = $message;

					return response()->json($result);
				} else {
					flash($message)->success();

					return redirect()->back();
				}
			}
		}

		if (isFromAjax()) {
			return response()->json($result);
		} else {
			flash($message)->error();

			return redirect()->back();
		}
	}

	/**
	 * Reorder pictures
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function reorderPictures(Request $request): JsonResponse
	{
		$params = $request->input('params');

		$result = ['status' => 0];

		if (isset($params['stack']) && count($params['stack']) > 0) {
			// Use unique ID to store post's pictures
			if ($request->session()->has('uid')) {
				$this->tmpUploadDir = $this->tmpUploadDir . '/' . $request->session()->get('uid');
			}

			$newPicturesInput = [];
			$statusOk = false;
			foreach ($params['stack'] as $position => $item) {
				if (array_key_exists('caption', $item) && !empty($item['caption'])) {
					$newPicturesInput[] = $this->tmpUploadDir . '/' . $item['caption'];
					$statusOk = true;
				}
			}
			if ($statusOk) {
				$request->session()->put('picturesInput', $newPicturesInput);
				$result['status'] = 1;
				$result['message'] = t('Your picture has been reorder successfully');
			}
		}

		return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
	}
}
