@extends('install.layouts.master')
@section('title', trans('messages.site_info_title'))

@php
	$defaultCountyCode ??= null;
	$siteInfo ??= [];
	$mailDrivers ??= [];
	$mailDriversSelectorsJson ??= '[]';
@endphp
@section('content')
	<form method="POST" name="siteInfoForm" action="{{ data_get($stepsUrls, 'siteInfo') }}" novalidate>
		{!! csrf_field() !!}
		
		<h3 class="title-3">
			<i class="bi bi-globe"></i> {{ trans('messages.app_info') }}
		</h3>
		<div class="row">
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'    => trans('messages.settings_app_name'),
					'type'     => 'text',
					'name'     => 'settings[app][name]',
					'value'    => data_get($siteInfo, 'settings.app.name'),
					'required' => true,
				])
			</div>
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'    => trans('messages.settings_app_slogan'),
					'type'     => 'text',
					'name'     => 'settings[app][slogan]',
					'value'    => data_get($siteInfo, 'settings.app.slogan'),
					'required' => true,
				])
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'         => trans('messages.settings_localization_default_country_code'),
					'type'          => 'select',
					'name'          => 'settings[localization][default_country_code]',
					'value'         => data_get($siteInfo, 'settings.localization.default_country_code', $defaultCountyCode),
					'options'       => getCountriesFromArray(),
					'include_blank' => trans('messages.select'),
					'required'      => true,
				])
			</div>
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'    => trans('messages.settings_app_purchase_code'),
					'type'     => 'text',
					'name'     => 'settings[app][purchase_code]',
					'value'    => data_get($siteInfo, 'settings.app.purchase_code'),
					'hint'     => trans('admin.find_my_purchase_code', [
						'purchaseCodeFindingUrl' => config('larapen.core.purchaseCodeFindingUrl'),
					]),
					'required' => true,
				])
			</div>
		</div>
		
		<hr class="border-0 bg-secondary">
		
		<h3 class="title-3">
			<i class="bi bi-person-circle"></i> {{ trans('messages.admin_info') }}
		</h3>
		<div class="row">
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'    => trans('messages.user_name'),
					'type'     => 'text',
					'name'     => 'user[name]',
					'value'    => data_get($siteInfo, 'user.name'),
					'required' => true,
				])
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'    => trans('messages.user_email'),
					'type'     => 'text',
					'name'     => 'user[email]',
					'value'    => data_get($siteInfo, 'user.email'),
					'required' => true,
				])
			</div>
			<div class="col-md-6">
				@include('install.helpers.form_control', [
					'label'    => trans('messages.user_password'),
					'type'     => 'text',
					'name'     => 'user[password]',
					'value'    => data_get($siteInfo, 'user.password'),
					'required' => true,
				])
			</div>
		</div>
		
		@if (view()->exists('install.site_info.mail_drivers'))
			@include('install.site_info.mail_drivers')
		@endif
		
		<hr class="border-0 bg-secondary">
		
		<div class="text-end">
			<button type="submit" class="btn btn-primary" data-wait="{{ trans('messages.button_processing') }}">
				{!! trans('messages.next') !!} <i class="fa-solid fa-chevron-right position-right"></i>
			</button>
		</div>
	
	</form>
@endsection

@section('after_scripts')
@endsection