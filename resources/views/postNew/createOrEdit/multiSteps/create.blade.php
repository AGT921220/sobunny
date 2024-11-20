{{--
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
--}}
@extends('layouts.master')

@section('wizard')
	@includeFirst([
		config('larapen.core.customizedViewPath') . 'post.createOrEdit.multiSteps.inc.wizard',
		'post.createOrEdit.multiSteps.inc.wizard'
	])
@endsection

@php
	$postInput ??= [];
	
	$postTypes ??= [];
	$countries ??= [];
@endphp

@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				@includeFirst([config('larapen.core.customizedViewPath') . 'post.inc.notification', 'post.inc.notification'])
				
				<div class="col-md-9 page-content">
					<div class="inner-box category-content" style="overflow: visible;">
						<h2 class="title-2">
							<strong><i class="fa-regular fa-pen-to-square"></i> {{ t('create_new_listing') }}</strong>
						</h2>
						
						<div class="row">
							<div class="col-xl-12">
								
								<form class="form-horizontal"
								      id="payableForm"
								      method="POST"
								      action="{{ request()->fullUrl() }}"
								      enctype="multipart/form-data"
								>
									{!! csrf_field() !!}
									@honeypot
									<fieldset>
										
										{{-- category_id --}}
										<?php $categoryIdError = (isset($errors) && $errors->has('category_id')) ? ' is-invalid' : ''; ?>
								
										
										@if (config('settings.listing_form.show_listing_type'))
											{{-- post_type_id --}}
											@php
												$postTypeIdError = (isset($errors) && $errors->has('post_type_id')) ? ' is-invalid' : '';
												$postTypeId = old('post_type_id', data_get($postInput, 'post_type_id'));
											@endphp
											<div id="postTypeBloc" class="row mb-3 required">
												<label class="col-md-3 col-form-label">{{ t('type') }} <sup>*</sup></label>
												<div class="col-md-8">
													@foreach ($postTypes as $postType)
														<div class="form-check form-check-inline pt-2">
															<input name="post_type_id"
															       id="postTypeId-{{ data_get($postType, 'id') }}"
															       value="{{ data_get($postType, 'id') }}"
															       type="radio"
															       class="form-check-input{{ $postTypeIdError }}" @checked($postTypeId == data_get($postType, 'id'))
															>
															<label class="form-check-label mb-0" for="postTypeId-{{ data_get($postType, 'id') }}">
																{{ data_get($postType, 'label') }}
															</label>
														</div>
													@endforeach
													<div class="form-text text-muted">{{ t('post_type_hint') }}</div>
												</div>
											</div>
										@endif
										
										{{-- title --}}
										<?php $titleError = (isset($errors) && $errors->has('title')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label{{ $titleError }}" for="title">{{ t('title') }} <sup>*</sup></label>
											<div class="col-md-8">
												<input id="title"
												       name="title"
												       placeholder="{{ t('listing_title') }}"
												       class="form-control input-md{{ $titleError }}"
												       type="text"
												       value="{{ old('title', data_get($postInput, 'title')) }}"
												>
												<div class="form-text text-muted">{{ t('a_great_title_needs_at_least_60_characters') }}</div>
											</div>
										</div>
										

										<div>
											<div class="row g-3 mt-3">
												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('Gender') }} <span class="text-danger">*</span> </label>
														<select name="gender_id" id="gender" class="form-control input-md">
															<option value="">{{ __('Select Gender') }}</option>
															@foreach ($genders as $cat)
																<option value="{{ $cat->id }}" @selected(old('gender_id') == $cat->id)>{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('Ethnicity') }} <span class="text-danger">*</span> </label>
														<select name="ethnicity_id" id="ethincity" class="form-control input-md">
															<option value="">{{ __('Select Ethnicity') }}</option>
															@foreach ($ethnicities as $item)
																<option value="{{ $item->id }}" @selected(old('ethnicity_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="item-age-wraper">
														<label for="item-age">{{ __('Age') }} <span class="text-danger">*</span> </label>
														<select name="age_id" id="age" class="form-control input-md">
															<option value="">{{ __('Select Age') }}</option>
															@foreach ($ages as $item)
																<option value="{{ $item->id }}" @selected(old('age_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>

											<div class="row g-3 mt-3">
												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('Breasts') }} <span class="text-danger">*</span> </label>
														<select name="breast_id" id="breasts" class="form-control input-md">
															<option value="">{{ __('Select Breasts') }}</option>
															@foreach ($breasts as $cat)
																<option value="{{ $cat->id }}" @selected(old('breast_id') == $cat->id)>{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('Caters') }} <span class="text-danger">*</span> </label>
														<select name="cater_id" id="cater" class="form-control input-md">
															<option value="">{{ __('Select Cater') }}</option>
															@foreach ($caters as $item)
																<option value="{{ $item->id }}" @selected(old('cater_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="item-age-wraper">
														<label for="item-age">{{ __('Body Type') }} <span class="text-danger">*</span> </label>
														<select name="body_type_id" id="body_type" class="form-control input-md">
															<option value="">{{ __('Select Body Type') }}</option>
															@foreach ($bodyTypes as $item)
																<option value="{{ $item->id }}" @selected(old('body_type_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>

											<div class="row g-3 mt-3">
												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('EyeColor') }} <span class="text-danger">*</span> </label>
														<select name="eye_color_id" id="eyeColor" class="form-control input-md">
															<option value="">{{ __('Select EyeColor') }}</option>
															@foreach ($eyeColors as $cat)
																<option value="{{ $cat->id }}" @selected(old('eye_color_id') == $cat->id)>{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('HairColor') }} <span class="text-danger">*</span> </label>
														<select name="hair_color_id" id="HairColor" class="form-control input-md">
															<option value="">{{ __('Select HairColor') }}</option>
															@foreach ($hairColors as $item)
																<option value="{{ $item->id }}" @selected(old('hair_color_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="item-age-wraper">
														<label for="item-age">{{ __('Service Type') }} <span class="text-danger">*</span> </label>
														<select name="service_type_id" id="service_type" class="form-control input-md">
															<option value="">{{ __('Select Service Type') }}</option>
															@foreach ($serviceTypes as $item)
																<option value="{{ $item->id }}" @selected(old('service_type_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>

											<div class="row g-3 mt-3">
												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('Servicing') }} <span class="text-danger">*</span> </label>
														<select name="servicing_id" id="servicing" class="form-control input-md">
															<option value="">{{ __('Select Servicing') }}</option>
															@foreach ($servicings as $cat)
																<option value="{{ $cat->id }}" @selected(old('servicing_id') == $cat->id)>{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>


												<div class="col-sm-4">
													<div class="item-catagory-wraper">
														<label for="item-catagory">{{ __('Heights') }} <span class="text-danger">*</span> </label>
														<select name="height_id" id="heights" class="form-control input-md">
															<option value="">{{__('Select Heights')}}</option>
															@foreach($heights as $item)
																<option value="{{ $item->id }}" @selected(old('height_id') == $item->id)>{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>


										</div>



										

										{{-- description --}}
										@php
											$descriptionError = (isset($errors) && $errors->has('description')) ? ' is-invalid' : '';
											$postDescription = data_get($postInput, 'description');
											$descriptionErrorLabel = '';
											$descriptionColClass = 'col-md-8';
											if (isWysiwygEnabled()) {
												$descriptionColClass = 'col-md-12';
												$descriptionErrorLabel = $descriptionError;
											}
										@endphp
										<div class="row mb-3 required">
											<label class="col-md-3 col-form-label{{ $descriptionErrorLabel }}" for="description">
												{{ t('Description') }} <sup>*</sup>
											</label>
											<div class="{{ $descriptionColClass }}">
												<textarea class="form-control{{ $descriptionError }}"
												          id="description"
												          name="description"
												          rows="15"
												          style="height: 300px"
												>{{ old('description', $postDescription) }}</textarea>
												<div class="form-text text-muted">{{ t('describe_what_makes_your_listing_unique') }}...</div>
											</div>
										</div>
										
										@php
											$adminType = config('country.admin_type', 0);
										@endphp
										@if (config('settings.listing_form.city_selection') == 'select')
											@if (in_array($adminType, ['1', '2']))
												{{-- admin_code --}}
													<?php $adminCodeError = (isset($errors) && $errors->has('admin_code')) ? ' is-invalid' : ''; ?>
												<div id="locationBox" class="row mb-3 required">
													<label class="col-md-3 col-form-label{{ $adminCodeError }}" for="admin_code">{{ t('location') }}
														<sup>*</sup></label>
													<div class="col-md-8">
														<select id="adminCode" name="admin_code" class="form-control large-data-selecter{{ $adminCodeError }}">
															<option value="0" @selected(empty(old('admin_code')))>
																{{ t('select_your_location') }}
															</option>
														</select>
													</div>
												</div>
											@endif
										@else
											<input type="hidden"
											       id="selectedAdminType"
											       name="selected_admin_type"
											       value="{{ old('selected_admin_type', $adminType) }}"
											>
											<input type="hidden"
											       id="selectedAdminCode"
											       name="selected_admin_code"
											       value="{{ old('selected_admin_code', 0) }}"
											>
											<input type="hidden"
											       id="selectedCityId"
											       name="selected_city_id"
											       value="{{ old('selected_city_id', 0) }}"
											>
											<input type="hidden"
											       id="selectedCityName"
											       name="selected_city_name"
											       value="{{ old('selected_city_name') }}"
											>
										@endif
										
										{{-- city_id --}}
										@php
											$cityIdError = (isset($errors) && $errors->has('city_id')) ? ' is-invalid' : '';
										@endphp
										<div id="cityBox" class="row mb-3 required">
											<label class="col-md-3 col-form-label{{ $cityIdError }}" for="city_id">
												{{ t('city') }} <sup>*</sup>
											</label>
											<div class="col-md-8">
												<select id="cityId" name="city_id" class="form-control large-data-selecter{{ $cityIdError }}">
													<option value="0" @selected(empty(old('city_id')))>
														{{ t('select_a_city') }}
													</option>
												</select>
											</div>
										</div>
										
										<div class="row mb-b">

										</div>

										
										
										<div class="content-subheading">
											<i class="fa-solid fa-user"></i>
											<strong>{{ t('seller_information') }}</strong>
										</div>
										
										
										{{-- contact_name --}}
										@php
											$contactNameError = (isset($errors) && $errors->has('contact_name')) ? ' is-invalid' : '';
										@endphp
										@if (auth()->check())
											<input id="contactName" name="contact_name" type="hidden" value="{{ auth()->user()->name }}">
										@else
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label{{ $contactNameError }}" for="contact_name">
													{{ t('your_name') }} <sup>*</sup>
												</label>
												<div class="col-md-9 col-lg-8 col-xl-6">
													<div class="input-group{{ $contactNameError }}">
														<span class="input-group-text"><i class="fa-regular fa-user"></i></span>
														<input id="contactName"
														       name="contact_name"
														       placeholder="{{ t('your_name') }}"
														       class="form-control input-md{{ $contactNameError }}"
														       type="text"
														       value="{{ old('contact_name', data_get($postInput, 'contact_name')) }}"
														>
													</div>
												</div>
											</div>
										@endif
										
										{{-- auth_field (as notification channel) --}}
										@php
											$authFields = getAuthFields(true);
											$authFieldError = (isset($errors) && $errors->has('auth_field')) ? ' is-invalid' : '';
											$usersCanChooseNotifyChannel = isUsersCanChooseNotifyChannel();
											$authFieldValue = ($usersCanChooseNotifyChannel) ? (old('auth_field', getAuthField())) : getAuthField();
										@endphp
										@if ($usersCanChooseNotifyChannel)
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label" for="auth_field">
													{{ t('notifications_channel') }} <sup>*</sup>
												</label>
												<div class="col-md-9">
													@foreach ($authFields as $iAuthField => $notificationType)
														<div class="form-check form-check-inline pt-2">
															<input name="auth_field"
															       id="{{ $iAuthField }}AuthField"
															       value="{{ $iAuthField }}"
															       class="form-check-input auth-field-input{{ $authFieldError }}"
															       type="radio" @checked($authFieldValue == $iAuthField)
															>
															<label class="form-check-label mb-0" for="{{ $iAuthField }}AuthField">
																{{ $notificationType }}
															</label>
														</div>
													@endforeach
													<div class="form-text text-muted">
														{{ t('notifications_channel_hint') }}
													</div>
												</div>
											</div>
										@else
											<input id="{{ $authFieldValue }}AuthField" name="auth_field" type="hidden" value="{{ $authFieldValue }}">
										@endif
										
										@php
											$forceToDisplay = isBothAuthFieldsCanBeDisplayed() ? ' force-to-display' : '';
										@endphp
										
										{{-- email --}}
										@php
											$emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : '';
											$emailValue = (auth()->check() && isset(auth()->user()->email))
												? auth()->user()->email
												: data_get($postInput, 'email');
										@endphp
										<div class="row mb-3 auth-field-item required{{ $forceToDisplay }}">
											<label class="col-md-3 col-form-label{{ $emailError }}" for="email">{{ t('email') }}
												@if (getAuthField() == 'email')
													<sup>*</sup>
												@endif
											</label>
											<div class="col-md-9 col-lg-8 col-xl-6">
												<div class="input-group{{ $emailError }}">
													<span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
													<input id="email"
													       name="email"
													       class="form-control"
													       placeholder="{{ t('email_address') }}"
													       type="text"
													       value="{{ old('email', $emailValue) }}"
													>
												</div>
											</div>
										</div>
										
										{{-- phone --}}
										@php
											$phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : '';
											$phoneValue = data_get($postInput, 'phone');
											$phoneCountryValue = data_get($postInput, 'phone_country', config('country.code'));
											if (
												auth()->check()
												&& isset(auth()->user()->country_code)
												&& !empty(auth()->user()->phone)
												&& isset(auth()->user()->phone_country)
												// && auth()->user()->country_code == config('country.code')
											) {
												$phoneValue = auth()->user()->phone;
												$phoneCountryValue = auth()->user()->phone_country;
											}
											$phoneValue = phoneE164($phoneValue, $phoneCountryValue);
											$phoneValueOld = phoneE164(old('phone', $phoneValue), old('phone_country', $phoneCountryValue));
										@endphp
										<div class="row mb-3 auth-field-item required{{ $forceToDisplay }}">
											<label class="col-md-3 col-form-label{{ $phoneError }}" for="phone">{{ t('phone_number') }}
												@if (getAuthField() == 'phone')
													<sup>*</sup>
												@endif
											</label>
											<div class="col-md-9 col-lg-8 col-xl-6">
												<div class="input-group{{ $phoneError }}">
													<input id="phone"
													       name="phone"
													       class="form-control input-md{{ $phoneError }}"
													       type="tel"
													       value="{{ $phoneValueOld }}"
													>
													<span class="input-group-text iti-group-text">
														<input id="phoneHidden"
														       name="phone_hidden"
														       type="checkbox"
														       value="1" @checked(old('phone_hidden') == '1')
														>&nbsp;<small>{{ t('Hide') }}</small>
													</span>
												</div>
												<input name="phone_country" type="hidden" value="{{ old('phone_country', $phoneCountryValue) }}">
											</div>
										</div>
										
										@if (!auth()->check())
											@if (in_array(config('settings.listing_form.auto_registration'), [1, 2]))
												{{-- auto_registration --}}
												@if (config('settings.listing_form.auto_registration') == 1)
													@php
														$autoRegistrationError = (isset($errors) && $errors->has('auto_registration')) ? ' is-invalid' : '';
													@endphp
													<div class="row mb-3 required">
														<label class="col-md-3 col-form-label"></label>
														<div class="col-md-8">
															<div class="form-check">
																<input name="auto_registration"
																       id="auto_registration"
																       class="form-check-input{{ $autoRegistrationError }}"
																       value="1"
																       type="checkbox"
																       checked="checked"
																>
																<label class="form-check-label" for="auto_registration">
																	{!! t('I want to register by submitting this listing') !!}
																</label>
															</div>
															<div class="form-text text-muted">
																{{ t('You will receive your authentication information by email') }}
															</div>
														</div>
													</div>
												@else
													<input type="hidden" name="auto_registration" id="auto_registration" value="1">
												@endif
											@endif
										@endif
										
										@include('layouts.inc.tools.captcha', ['colLeft' => 'col-md-3', 'colRight' => 'col-md-8'])
										
										@if (!auth()->check())
											{{-- accept_terms --}}
											@php
												$acceptTermsError = (isset($errors) && $errors->has('accept_terms')) ? ' is-invalid' : '';
												$acceptTerms = old('accept_terms', data_get($postInput, 'accept_terms'));
											@endphp
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label"></label>
												<div class="col-md-8">
													<div class="form-check">
														<input name="accept_terms"
														       id="acceptTerms"
														       class="form-check-input{{ $acceptTermsError }}"
														       value="1"
														       type="checkbox" @checked($acceptTerms == '1')
														>
														<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
															{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
														</label>
													</div>
												</div>
											</div>
											
											{{-- accept_marketing_offers --}}
											@php
												$acceptMarketingOffersError = (isset($errors) && $errors->has('accept_marketing_offers')) ? ' is-invalid' : '';
												$acceptMarketingOffers = old('accept_marketing_offers', data_get($postInput, 'accept_marketing_offers'));
											@endphp
											<div class="row mb-3 required">
												<label class="col-md-3 col-form-label"></label>
												<div class="col-md-8">
													<div class="form-check">
														<input name="accept_marketing_offers" id="acceptMarketingOffers"
														       class="form-check-input{{ $acceptMarketingOffersError }}"
														       value="1"
														       type="checkbox" @checked($acceptMarketingOffers == '1')
														>
														<label class="form-check-label" for="acceptMarketingOffers" style="font-weight: normal;">
															{!! t('accept_marketing_offers_label') !!}
														</label>
													</div>
												</div>
											</div>
										@endif
										
										{{-- Button --}}
										<div class="row mb-3 pt-3">
											<div class="col-md-12 text-center">
												<button id="nextStepBtn" class="btn btn-primary btn-lg">{{ t('Next') }}</button>
											</div>
										</div>
									
									</fieldset>
								</form>
							
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-3 reg-sidebar">
					@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.right-sidebar', 'post.createOrEdit.inc.right-sidebar'])
				</div>
			
			</div>
		</div>
	</div>
	@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.category-modal', 'post.createOrEdit.inc.category-modal'])
@endsection

@section('after_styles')
@endsection

@section('after_scripts')
@endsection

@includeFirst([config('larapen.core.customizedViewPath') . 'post.createOrEdit.inc.form-assets', 'post.createOrEdit.inc.form-assets'])
