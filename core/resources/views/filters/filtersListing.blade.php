<div class="catagoriesWraper mb-4">
    <!-- Gender Selector -->
    <div class="genders w-100">
        <select id="search_by_gender" name="gender_id" class="genderSelect">
            <option value="">Gender</option>
            @foreach($genders as $item)
            <option @if(!empty(request()->get("gender_id")) && request()->get("gender_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Ethnicity Selector -->
    <div class="ethnicities w-100">
        <select id="search_by_ethnicity" name="ethnicity_id" class="ethnicitySelect">
            <option value="">Ethnicity</option>
            @foreach($ethnicities as $item)
            <option @if(!empty(request()->get("ethnicity_id")) && request()->get("ethnicity_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Age Selector -->
    <div class="ages w-100">
        <select id="search_by_age" name="age_id" class="ageSelect">
            <option value="">Age</option>
            @foreach($ages as $item)
            <option @if(!empty(request()->get("age_id")) && request()->get("age_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Breasts Selector -->
    <div class="breasts w-100">
        <select id="search_by_breasts" name="breasts_id" class="breastsSelect">
            <option value="">Breasts</option>
            @foreach($breasts as $item)
            <option @if(!empty(request()->get("breasts_id")) && request()->get("breasts_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Cater Selector -->
    <div class="caters w-100">
        <select id="search_by_cater" name="cater_id" class="caterSelect">
            <option value="">Cater</option>
            @foreach($caters as $item)
            <option @if(!empty(request()->get("cater_id")) && request()->get("cater_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Body Type Selector -->
    <div class="body-types w-100">
        <select id="search_by_body_type" name="body_type_id" class="bodyTypeSelect">
            <option value="">Body Type</option>
            @foreach($bodyTypes as $item)
            <option @if(!empty(request()->get("body_type_id")) && request()->get("body_type_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Eye Color Selector -->
    <div class="eye-colors w-100">
        <select id="search_by_eye_color" name="eye_color_id" class="eyeColorSelect">
            <option value="">Eye Color</option>
            @foreach($eyeColors as $item)
            <option @if(!empty(request()->get("eye_color_id")) && request()->get("eye_color_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Hair Color Selector -->
    <div class="hair-colors w-100">
        <select id="search_by_hair_color" name="hair_color_id" class="hairColorSelect">
            <option value="">Hair Color</option>
            @foreach($hairColors as $item)
            <option @if(!empty(request()->get("hair_color_id")) && request()->get("hair_color_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Service Type Selector -->
    <div class="service-types w-100">
        <select id="search_by_service_type" name="service_type_id" class="serviceTypeSelect">
            <option value="">Service Type</option>
            @foreach($serviceTypes as $item)
            <option @if(!empty(request()->get("service_type_id")) && request()->get("service_type_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Servicing Selector -->
    <div class="servicings w-100">
        <select id="search_by_servicing" name="servicing_id" class="servicingSelect">
            <option value="">Servicing</option>
            @foreach($servicings as $item)
            <option @if(!empty(request()->get("servicing_id")) && request()->get("servicing_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Heights Selector -->
    <div class="heights w-100">
        <select id="search_by_heights" name="heights_id" class="heightsSelect">
            <option value="">Height</option>
            @foreach($heights as $item)
            <option @if(!empty(request()->get("heights_id")) && request()->get("heights_id") == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>
