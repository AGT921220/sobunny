<div class="catagoriesWraper mb-4">
    {{-- <form action="custom-search-listings" method="POST" enctype="multipart/form-data" id="searchListingsForm"> --}}
        {{-- <form action="listings" method="GET" enctype="multipart/form-data" id="searchListingsForm"> --}}
        @csrf


        <div class="cancel_apply_section_start text-end mb-2">
            <button type="button" class="filter-btn w-100 searchListings" 
            {{-- id="distance_wise_filter_apply" --}}
            >{{ __('Search') }}</button>
        </div>

        <div class="suburb_section_start">
            <input type="hidden" name="autocomplete_address" id="autocomplete_address">
            <input type="hidden" name="location_city_name" id="location_city_name">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <label class="cateTitle mb-2">{{ __('Location') }}</label>
            <input class="search-input form-control w-100 border-1 bg-white autocomplete_disable" name="autocomplete" id="autocomplete" placeholder="{{ __('Enter a Location') }}" type="text">
        </div>

    <!-- Gender Selector -->
    <div class="genders w-100">
        <select id="search_by_gender" class="genderSelect">
            <option value="">Gender</option>
            @foreach($genders as $item)
            <option @if(!empty(request()->get("gender_id")) && request()->get("gender_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Ethnicity Selector -->
    <div class="ethnicities w-100">
        <select id="search_by_ethnicity" class="ethnicitySelect">
            <option value="">Ethnicity</option>
            @foreach($ethnicities as $item)
            <option @if(!empty(request()->get("ethnicity_id")) && request()->get("ethnicity_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Age Selector -->
    <div class="ages w-100">
        <select id="search_by_age" class="ageSelect">
            <option value="">Age</option>
            @foreach($ages as $item)
            <option @if(!empty(request()->get("age_id")) && request()->get("age_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Breasts Selector -->
    <div class="breasts w-100">
        <select id="search_by_breasts" class="breastsSelect">
            <option value="">Breasts</option>
            @foreach($breasts as $item)
            <option @if(!empty(request()->get("breast_id")) && request()->get("breast_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Cater Selector -->
    <div class="caters w-100">
        <select id="search_by_cater" class="caterSelect">
            <option value="">Cater</option>
            @foreach($caters as $item)
            <option @if(!empty(request()->get("cater_id")) && request()->get("cater_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Body Type Selector -->
    <div class="body-types w-100">
        <select id="search_by_body_type" class="bodyTypeSelect">
            <option value="">Body Type</option>
            @foreach($bodyTypes as $item)
            <option @if(!empty(request()->get("body_type_id")) && request()->get("body_type_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Eye Color Selector -->
    <div class="eye-colors w-100">
        <select id="search_by_eye_color" class="eyeColorSelect">
            <option value="">Eye Color</option>
            @foreach($eyeColors as $item)
            <option @if(!empty(request()->get("eye_color_id")) && request()->get("eye_color_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Hair Color Selector -->
    <div class="hair-colors w-100">
        <select id="search_by_hair_color" class="hairColorSelect">
            <option value="">Hair Color</option>
            @foreach($hairColors as $item)
            <option @if(!empty(request()->get("hair_color_id")) && request()->get("hair_color_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Service Type Selector -->
    <div class="service-types w-100">
        <select id="search_by_service_type" class="serviceTypeSelect">
            <option value="">Service Type</option>
            @foreach($serviceTypes as $item)
            <option @if(!empty(request()->get("service_type_id")) && request()->get("service_type_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Servicing Selector -->
    <div class="servicings w-100">
        <select id="search_by_servicing" class="servicingSelect">
            <option value="">Servicing</option>
            @foreach($servicings as $item)
            <option @if(!empty(request()->get("servicing_id")) && request()->get("servicing_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Heights Selector -->
    <div class="heights w-100">
        <select id="search_by_heights" class="heightsSelect">
            <option value="">Height</option>
            @foreach($heights as $item)
            <option @if(!empty(request()->get("heights_id")) && request()->get("heights_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    {{-- </form> --}}
</div>
