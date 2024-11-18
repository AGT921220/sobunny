@php

@endphp



<!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
<div class="col-md-3 page-sidebar mobile-filter-sidebar pb-4">
    <aside>
        <div class="sidebar-modern-inner enable-long-words">

            <br>
            <div id="subCatsList">
                <div class="block-title has-arrow sidebar-header">
                    <h5>
                        <span class="fw-bold">
                            <a>FILTERS</a>
                        </span>
                    </h5>
                </div>

                <!-- Gender Selector -->
                <div class="itemFilter">
                    <label for="item-catagory">{{ __('Gender') }} <span class="text-danger">*</span> </label>
                    <select name="gender_id" id="gender" class="form-control input-md">
                        <option value="">{{ __('Select Gender') }}</option>
                        @foreach ($genders as $cat)
                            <option value="{{ $cat->id }}" @selected(old('gender_id') == $cat->id)>{{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="itemFilter">

                        <label for="item-catagory">{{ __('Ethnicity') }} <span class="text-danger">*</span> </label>
                        <select name="ethnicity_id" id="ethincity" class="form-control input-md">
                            <option value="">{{ __('Select Ethnicity') }}</option>
                            @foreach ($ethnicities as $item)
                                <option value="{{ $item->id }}" @selected(old('ethnicity_id') == $item->id)>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

					<div class="itemFilter">
                        <label for="item-age">{{ __('Age') }} <span class="text-danger">*</span> </label>
                        <select name="age_id" id="age" class="form-control input-md">
                            <option value="">{{ __('Select Age') }}</option>
                            @foreach ($ages as $item)
                                <option value="{{ $item->id }}" @selected(old('age_id') == $item->id)>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

					<div class="itemFilter">
						<label for="item-catagory">{{ __('Breasts') }} <span class="text-danger">*</span> </label>
						<select name="breast_id" id="breasts" class="form-control input-md">
							<option value="">{{ __('Select Breasts') }}</option>
							@foreach ($breasts as $cat)
								<option value="{{ $cat->id }}" @selected(old('breast_id') == $cat->id)>{{ $cat->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="itemFilter">
						<label for="item-catagory">{{ __('Caters') }} <span class="text-danger">*</span> </label>
						<select name="cater_id" id="cater" class="form-control input-md">
							<option value="">{{ __('Select Cater') }}</option>
							@foreach ($caters as $item)
								<option value="{{ $item->id }}" @selected(old('cater_id') == $item->id)>{{ $item->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="itemFilter">
						<label for="item-age">{{ __('Body Type') }} <span class="text-danger">*</span> </label>
						<select name="body_type_id" id="body_type" class="form-control input-md">
							<option value="">{{ __('Select Body Type') }}</option>
							@foreach ($bodyTypes as $item)
								<option value="{{ $item->id }}" @selected(old('body_type_id') == $item->id)>{{ $item->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="itemFilter">
						<label for="item-catagory">{{ __('EyeColor') }} <span class="text-danger">*</span> </label>
						<select name="eye_color_id" id="eyeColor" class="form-control input-md">
							<option value="">{{ __('Select EyeColor') }}</option>
							@foreach ($eyeColors as $cat)
								<option value="{{ $cat->id }}" @selected(old('eye_color_id') == $cat->id)>{{ $cat->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="itemFilter">
						<label for="item-catagory">{{ __('HairColor') }} <span class="text-danger">*</span> </label>
						<select name="hair_color_id" id="HairColor" class="form-control input-md">
							<option value="">{{ __('Select HairColor') }}</option>
							@foreach ($hairColors as $item)
								<option value="{{ $item->id }}" @selected(old('hair_color_id') == $item->id)>{{ $item->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="itemFilter">
						<label for="item-age">{{ __('Service Type') }} <span class="text-danger">*</span> </label>
						<select name="service_type_id" id="service_type" class="form-control input-md">
							<option value="">{{ __('Select Service Type') }}</option>
							@foreach ($serviceTypes as $item)
								<option value="{{ $item->id }}" @selected(old('service_type_id') == $item->id)>{{ $item->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="itemFilter">
						<label for="item-catagory">{{ __('Servicing') }} <span class="text-danger">*</span> </label>
						<select name="servicing_id" id="servicing" class="form-control input-md">
							<option value="">{{ __('Select Servicing') }}</option>
							@foreach ($servicings as $cat)
								<option value="{{ $cat->id }}" @selected(old('servicing_id') == $cat->id)>{{ $cat->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="itemFilter">
						<label for="item-catagory">{{ __('Heights') }} <span class="text-danger">*</span> </label>
						<select name="height_id" id="heights" class="form-control input-md">
							<option value="">{{__('Select Heights')}}</option>
							@foreach($heights as $item)
								<option value="{{ $item->id }}" @selected(old('height_id') == $item->id)>{{ $item->name }}</option>
							@endforeach
						</select>
					</div>







            </div>

				<div class="findBtnContainer search-btn-border bg-primary">
					<button class="btn btn-primary btn-search btn-block btn-gradient searchFilterBtn">
						<i class="fa-solid fa-magnifying-glass"></i> <strong>Find</strong>
					</button>
				</div>

<form action="/search" method="GET" id="searchForm">

</form>

            {{-- <div id="subCatsList">

				@if (!empty(data_get($cat, 'children')))
					
					<div class="block-title has-arrow sidebar-header">
						<h5>
						<span class="fw-bold">
							@if (!empty(data_get($cat, 'parent')))
								<a href="{{ \App\Services\UrlGen::category(data_get($cat, 'parent'), null, $city ?? null) }}">
									<i class="fa-solid fa-reply"></i> {{ data_get($cat, 'parent.name') }}
								</a>
							@else
								<a href="{{ $catParentUrl }}">
									<i class="fa-solid fa-reply"></i> {{ t('all_categories') }}
								</a>
							@endif
						</span> {!! $clearFilterBtn !!}
						</h5>
					</div>
					<div class="block-content list-filter categories-list">
						<ul class="list-unstyled">
							<li>
								<a href="{{ \App\Services\UrlGen::category($cat, null, $city ?? null) }}" title="{{ data_get($cat, 'name') }}">
									<span class="title fw-bold">
										@if (in_array(config('settings.listings_list.show_category_icon'), [4, 5, 6, 8]))
											<i class="{{ data_get($cat, 'icon_class') ?? 'fa-solid fa-folder' }}"></i>
										@endif
										{{ data_get($cat, 'name') }}
									</span>
									@if (config('settings.listings_list.count_categories_listings'))
										<span class="count">&nbsp;({{ $countPostsPerCat[data_get($cat, 'id')]['total'] ?? 0 }})</span>
									@endif
								</a>
								<ul class="list-unstyled long-list">
									@foreach (data_get($cat, 'children') as $iSubCat)
										<li>
											<a href="{{ \App\Services\UrlGen::category($iSubCat, null, $city ?? null) }}" title="{{ data_get($iSubCat, 'name') }}">
												@if (in_array(config('settings.listings_list.show_category_icon'), [4, 5, 6, 8]))
													<i class="{{ data_get($iSubCat, 'icon_class') ?? 'fa-solid fa-folder' }}"></i>
												@endif
												{{ str(data_get($iSubCat, 'name'))->limit(100) }}
												@if (config('settings.listings_list.count_categories_listings'))
													<span class="count">&nbsp;({{ $countPostsPerCat[data_get($iSubCat, 'id')]['total'] ?? 0 }})</span>
												@endif
											</a>
										</li>
									@endforeach
								</ul>
							</li>
						</ul>
					</div>
					
				@else
					
					@if (!empty(data_get($cat, 'parent.children')))
						<div class="block-title has-arrow sidebar-header">
							<h5>
								<span class="fw-bold">
									@if (!empty(data_get($cat, 'parent.parent')))
										<a href="{{ \App\Services\UrlGen::category(data_get($cat, 'parent.parent'), null, $city ?? null) }}">
											<i class="fa-solid fa-reply"></i> {{ data_get($cat, 'parent.parent.name') }}
										</a>
									@elseif (!empty(data_get($cat, 'parent')))
										<a href="{{ \App\Services\UrlGen::category(data_get($cat, 'parent'), null, $city ?? null) }}">
											<i class="fa-solid fa-reply"></i> {{ data_get($cat, 'name') }}
										</a>
									@else
										<a href="{{ $catParentUrl }}">
											<i class="fa-solid fa-reply"></i> {{ t('all_categories') }}
										</a>
									@endif
								</span> {!! $clearFilterBtn !!}
							</h5>
						</div>
						<div class="block-content list-filter categories-list">
							<ul class="list-unstyled">
								@foreach (data_get($cat, 'parent.children') as $iSubCat)
									<li>
										@if (data_get($iSubCat, 'id') == data_get($cat, 'id'))
											<strong>
												<a href="{{ \App\Services\UrlGen::category($iSubCat, null, $city ?? null) }}" title="{{ data_get($iSubCat, 'name') }}">
													@if (in_array(config('settings.listings_list.show_category_icon'), [4, 5, 6, 8]))
														<i class="{{ data_get($iSubCat, 'icon_class') ?? 'fa-solid fa-folder' }}"></i>
													@endif
													{{ str(data_get($iSubCat, 'name'))->limit(100) }}
													@if (config('settings.listings_list.count_categories_listings'))
														<span class="count">&nbsp;({{ $countPostsPerCat[data_get($iSubCat, 'id')]['total'] ?? 0 }})</span>
													@endif
												</a>
											</strong>
										@else
											<a href="{{ \App\Services\UrlGen::category($iSubCat, null, $city ?? null) }}" title="{{ data_get($iSubCat, 'name') }}">
												@if (in_array(config('settings.listings_list.show_category_icon'), [4, 5, 6, 8]))
													<i class="{{ data_get($iSubCat, 'icon_class') ?? 'fa-solid fa-folder' }}"></i>
												@endif
												{{ str(data_get($iSubCat, 'name'))->limit(100) }}
												@if (config('settings.listings_list.count_categories_listings'))
													<span class="count">&nbsp;({{ $countPostsPerCat[data_get($iSubCat, 'id')]['total'] ?? 0 }})</span>
												@endif
											</a>
										@endif
									</li>
								@endforeach
							</ul>
						</div>
					@else
						
						@includeFirst(
							[config('larapen.core.customizedViewPath') . 'search.inc.sidebar.categories.root', 'search.inc.sidebar.categories.root'],
							['countPostsPerCat' => $countPostsPerCat]
						)
					
					@endif
					
				@endif
			</div> --}}
            {{-- @includeFirst([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.fields', 'search.inc.sidebar.fields'])
			@includeFirst([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.categories', 'search.inc.sidebar.categories'])
            @includeFirst([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.cities', 'search.inc.sidebar.cities'])
			@if (!config('settings.listings_list.hide_date'))
				@includeFirst([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.date', 'search.inc.sidebar.date'])
			@endif
			@includeFirst([config('larapen.core.customizedViewPath') . 'search.inc.sidebar.price', 'search.inc.sidebar.price']) --}}

        </div>
    </aside>
</div>

@section('after_scripts')
    @parent
    <script>
        var baseUrl = '{{ request()->url() }}';
    </script>
@endsection
<script src="{{ asset('js/searchFilters.js') }}" defer></script>
