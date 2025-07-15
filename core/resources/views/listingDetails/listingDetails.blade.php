@if(!empty($listing->gender))
    <div class="col-4">
        {{ __('Gender:') }} <span class="text-bold"> {{ $listing->gender->name }} </span>
    </div>
@endif

@if(!empty($listing->ethnicity))
    <div class="col-4">
        {{ __('Ethnicity:') }} <span class="text-bold"> {{ $listing->ethnicity->name }} </span>
    </div>
@endif

@if(!empty($listing->age))
    <div class="col-4">
        {{ __('Age:') }} <span class="text-bold"> {{ $listing->age->name }} </span>
    </div>
@endif

@if(!empty($listing->breasts_id))
    <div class="col-4">
        {{ __('Breasts:') }} <span class="text-bold"> {{ $listing->breasts->name }} </span>
    </div>
@endif

@if(!empty($listing->cater_id))
    <div class="col-4">
        {{ __('Cater:') }} <span class="text-bold"> {{ $listing->cater->name }} </span>
    </div>
@endif

@if(!empty($listing->body_type_id))
    <div class="col-4">
        {{ __('Body Type:') }} <span class="text-bold"> {{ $listing->bodyType->name }} </span>
    </div>
@endif

@if(!empty($listing->eye_color_id))
    <div class="col-4">
        {{ __('Eye Color:') }} <span class="text-bold"> {{ $listing->eyeColor->name }} </span>
    </div>
@endif

@if(!empty($listing->hair_color_id))
    <div class="col-4">
        {{ __('Hair Color:') }} <span class="text-bold"> {{ $listing->hairColor->name }} </span>
    </div>
@endif

@if(!empty($listing->service_type_id))
    <div class="col-4">
        {{ __('Service Type:') }} <span class="text-bold"> {{ $listing->serviceType->name }} </span>
    </div>
@endif

@if(!empty($listing->servicing_id))
    <div class="col-4">
        {{ __('Servicing:') }} <span class="text-bold"> {{ $listing->servicing->name }} </span>
    </div>
@endif

@if(!empty($listing->heights_id))
    <div class="col-4">
        {{ __('Height:') }} <span class="text-bold"> {{ $listing->height }} </span>
    </div>
@endif
