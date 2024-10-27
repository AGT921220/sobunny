@extends('frontend.layout.master')
@section('site_title')
    {{ __('Edit Listing') }}
@endsection
@section('style')
    <x-media.css/>
    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <style>
        input#pac-input {
            background-color: ghostwhite;
        }
        .select2-container .select2-selection--single {
            background-color: var(--white-bg);
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            position: relative;
            height: 48px;
            padding: 5px;
        }

        span.select2.select2-container.select2-container--default.select2-container--focus {
            width: 100% !important;
        }
        .select-itms span.select2{
            width: 100% !important;
        }


        .close{ border: none;  }
        .dashboard-switch-single{
            font-size: 20px;
        }
        .swal_delete_button{
            color: #da0000 !important;
        }
        /* Default styles for the input box */
        #pac-input {
            height: 3em;
            width:75%;
            margin-left: 140px;
            border: 1px solid;
            top: 4px;
            font-size: 16px;
        }

        /* Media query for screens smaller than 768px */
        @media (max-width: 1499px) {
            #pac-input {
                width: 100%;
                margin-left: 0;
            }
        }

        /*select tags start css*/
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e3e3e3;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #e3e3e3;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 20px;
        }
        .select2-selection__choice__display {
            font-size: 14px;
            color: #000;
            font-weight: 400;
        }
        /*select tags end css*/

        /* price and number css start   */
        label.infoTitle.position-absolute {
            top: 0;
            background-color: whitesmoke;
            left: 0;
            padding: 10px 15px;
        }
        .checkBox.position-absolute {
            right: 0;
            top: 0;
            background-color: whitesmoke;
            padding: 10px 15px;
        }

        input.effectBorder.checkBox__input {
            border: 2px solid #a3a3a3;
        }
        /* price and number css end   */

        button.btn.btn-info.media_upload_form_btn {
            background-color: rgb(239,246,255);
            border: none;
            color: rgb(59,130,246);
            outline: none;
            box-shadow: none;
        }

        .new_image_add_listing .attachment-preview {
            width: 200px;
            height: 200px;
            border-radius: 6px;
            overflow: hidden;
        }
        .new_image_add_listing .attachment-preview .thumbnail .centered img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
        }

        .new_image_gallery_add_listing .attachment-preview {
            width: 100px;
            height: 100px;
            border-radius: 6px;
            overflow: hidden;
        }
        .new_image_gallery_add_listing .attachment-preview .thumbnail .centered img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
        }

        .media-upload-btn-wrapper .img-wrap .rmv-span {
            padding: 0;
        }
    </style>
    <x-css.phone-number-css/>
@endsection
@section('content')
    <div class="add-listing-wrapper mt-4">
        <!--Nav Bar Tabs markup start -->
        <!--Nav Bar Tabs markup start -->
        <div style="display: none" class="nav nav-pills" id="add-listing-tab"
             role="tablist" aria-orientation="vertical">
            <a class="nav-link  stepIndicator active stepForm_btn__previous"
               id="listing-info-tab"
               data-bs-toggle="pill"
               href="#listing-info"
               role="tab"
               aria-controls="listing-info"
               aria-selected="true">
                <span class="nav-link-number">{{ __('1') }}</span>
                {{__('Listing Info')}}
            </a>

            <a class="nav-link  stepIndicator"
               id="location-tab"
               data-bs-toggle="pill"
               href="#media-uploads"
               role="tab"
               aria-controls="media-uploads"
               aria-selected="true">
                <span class="nav-link-number">{{ __('2') }}</span>
                {{__('Location')}}
            </a>
        </div>

        <form action="{{route('user.edit.listing', $listing->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div  class="add-listing-content-wrapper mt-4">
                <div class="tab-content add-listing-content" id="add-listing-tabContent">
                    <!-- listing Info start-->
                    <div  class="tab-pane fade step active show" id="listing-info" role="tabpanel" aria-labelledby="listing-info-tab">
                        <!--Post your add-->
                        <div class="post-your-add section-padding2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mt-3 mb-2">
                                            <x-validation.frontend-error />
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-8">
                                        <div class="post-add-wraper">
                                            <div class="item-name box-shadow1 p-24">
                                                <label for="item-name">{{ __('Item Name') }} <span class="text-danger">*</span> </label>
                                                <input type="text" name="title" id="title" value="{{ $listing->title }}" class="input-filed w-100" placeholder="{{ __('Item Name') }}">

                                                <div class="input-form input-form2 permalink_label">
                                                    <label for="title" class="mt-4"> {{__('Permalink')}}  <span class="text-danger">*</span>  </label>
                                                    <span id="slug_show" class="display-inline"></span>
                                                    <span id="slug_edit" class="display-inline">
                                                        <button class="btn btn-warning btn-sm slug_edit_button">  <i class="las la-edit"></i> </button>
                                                        <input class="listing_slug input-filed w-100" name="slug" value="{{$listing->slug}}" id="slug" style="display: none" type="text">
                                                        <button class="red-btn btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="about-item box-shadow1 p-24 mt-4">
                                                <h3 class="head4">{{ __('About Item') }}</h3>
                                                <form action="#" class="about-item-form">
                                                    <div class="row g-3 mt-3">



                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('Gender') }} <span class="text-danger">*</span></label>
                                                                <select name="gender_id" id="gender" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Gender') }}</option>
                                                                    @foreach ($genders as $cat)
                                                                        <option value="{{ $cat->id }}" @if($listing->gender_id == $cat->id) selected @endif>
                                                                            {{ $cat->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('Ethnicity') }} <span class="text-danger">*</span></label>
                                                                <select name="ethnicity_id" id="ethnicity" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Ethnicity') }}</option>
                                                                    @foreach ($ethnicities as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->ethnicity_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="item-age-wraper">
                                                                <label for="item-age">{{ __('Age') }} <span class="text-danger">*</span></label>
                                                                <select name="age_id" id="age" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Age') }}</option>
                                                                    @foreach ($ages as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->age_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        



                                                    </div>
    
                                                    <div class="row g-3 mt-3">
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('Breasts') }} <span class="text-danger">*</span></label>
                                                                <select name="breasts_id" id="breasts" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Breasts') }}</option>
                                                                    @foreach ($breasts as $cat)
                                                                        <option value="{{ $cat->id }}" @if($listing->breast_id == $cat->id) selected @endif>
                                                                            {{ $cat->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('Caters') }} <span class="text-danger">*</span></label>
                                                                <select name="cater_id" id="cater" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Cater') }}</option>
                                                                    @foreach ($caters as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->cater_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-4">
                                                            <div class="item-age-wraper">
                                                                <label for="item-age">{{ __('Body Type') }} <span class="text-danger">*</span></label>
                                                                <select name="body_type_id" id="body_type" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Body Type') }}</option>
                                                                    @foreach ($bodyTypes as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->body_type_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-3 mt-3">
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('EyeColor') }} <span class="text-danger">*</span></label>
                                                                <select name="eye_color_id" id="eyeColor" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select EyeColor') }}</option>
                                                                    @foreach ($eyeColors as $cat)
                                                                        <option value="{{ $cat->id }}" @if($listing->eyecolor_id == $cat->id) selected @endif>
                                                                            {{ $cat->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('HairColor') }} <span class="text-danger">*</span></label>
                                                                <select name="hair_color_id" id="HairColor" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select HairColor') }}</option>
                                                                    @foreach ($hairColors as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->hair_color_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-4">
                                                            <div class="item-age-wraper">
                                                                <label for="item-age">{{ __('Service Type') }} <span class="text-danger">*</span></label>
                                                                <select name="service_type_id" id="service_type" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Service Type') }}</option>
                                                                    @foreach ($serviceTypes as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->service_type_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-3 mt-3">
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('Servicing') }} <span class="text-danger">*</span></label>
                                                                <select name="servicing_id" id="servicing" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Servicing') }}</option>
                                                                    @foreach ($servicings as $cat)
                                                                        <option value="{{ $cat->id }}" @if($listing->servicing_id == $cat->id) selected @endif>
                                                                            {{ $cat->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-4">
                                                            <div class="item-catagory-wraper">
                                                                <label for="item-catagory">{{ __('Heights') }} <span class="text-danger">*</span></label>
                                                                <select name="heights_id" id="heights" class="select-itms select2_activation">
                                                                    <option value="">{{ __('Select Heights') }}</option>
                                                                    @foreach ($heights as $item)
                                                                        <option value="{{ $item->id }}" @if($listing->height_id == $item->id) selected @endif>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                </form>
                                            </div>
                                            <div class="description box-shadow1 p-24 mt-4">
                                                <label for="description">{{ __('Description') }} <span class="text-danger">*</span> <span class="text-danger">{{ __('(minimum 150 characters.)') }}</span> </label>
                                                <textarea name="description" id="description" rows="6" class="input-filed w-100 textarea--form summernote" placeholder="{{__('Enter a Description')}}">{{ $listing->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="right-sidebar">
                                            {{-- <div class="box-shadow1 price p-24"> --}}
                                                {{-- <div class="price-wraper">
                                                    <label for="price">{{ __('Price') }} <span class="text-danger">*</span> </label>
                                                    <input type="number" name="price" id="price" value="{{$listing->price}}" class="input-filed w-100 mb-3" placeholder="{{__('0.00')}}">
                                                    <div class="negotiable">
                                                        <label>
                                                            <input type="checkbox" class="custom-check-box" name="negotiable" id="negotiable"  value="{{$listing->negotiable}}" @if($listing->negotiable == 1) checked @endif>
                                                            <span class="ms-2">{{ __('Negotiable') }}</span>
                                                        </label>
                                                    </div>
                                                </div> --}}
                                            {{-- </div> --}}
                                            <div class="box-shadow1 hode-phone-number p-24 mt-3">
                                                <label class="hide-number">
                                                    <input type="checkbox" name="phone_hidden" id="phone_hidden" value="{{$listing->phone_hidden}}" @if($listing->phone_hidden == 1) checked @endif class="custom-check-box" >
                                                    <span class="black-font"> {{ __('Hide My Phone Number') }}</span>
                                                </label>
                                                <div class="input-group mt-3">
                                                    <input type="hidden" id="country-code" name="country_code" value="{{$listing->phone}}">
                                                    <input type="tel" class="input-filed w-100" name="phone" id="phone" value="{{$listing->phone}}" placeholder="{{__('Phone')}}">
                                                    <span id="phone_availability"></span>
                                                    <div class="d-none">
                                                        <span id="error-msg" class="hide"></span>
                                                        <p id="result" class="d-none"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="upload-img text-center mt-3">
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap new_image_add_listing">
                                                        {!! render_attachment_preview_for_admin($listing->image ?? '') !!}
                                                    </div>
                                                    <input type="hidden" name="image" value="{{$listing->image ?? ''}}">
                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                            data-btntitle="{{__('Select Image')}}"
                                                            data-modaltitle="{{__('Upload Image')}}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#media_upload_modal">
                                                        {{ __('Click to browse & Upload Featured Image') }}
                                                    </button>
                                                    <small>{{ __('image format: jpg,jpeg,png,gif,webp')}}</small> <br>
                                                    <small>{{ __('recommended size 810x450') }}</small>
                                                </div>
                                            </div>

                                            <div class="picture mt-3">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="upload-img text-center mt-3">
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap new_image_gallery_add_listing">
                                                                    {!! render_gallery_image_attachment_preview($listing->gallery_images ?? '') !!}
                                                                </div>
                                                                <input type="hidden" name="gallery_images" value="{{$listing->gallery_images}}">
                                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                                        data-btntitle="{{__('Select Image')}}"
                                                                        data-modaltitle="{{__('Upload Image')}}"
                                                                        data-mulitple="true"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#media_upload_modal">
                                                                    {{__('Click to Upload Gallery Images')}}
                                                                </button>
                                                                <small>{{ __('image format: jpg,jpeg,png,gif,webp')}}</small> <br>
                                                                <small>{{ __('recommended size 810x450') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- start previous / next buttons -->
                                            <div class="continue-btn mt-3">
                                                <div class="btn-wrapper mb-10 d-flex justify-content-end gap-3">
                                                    <button class="red-btn w-100 d-block" style="border: none" id="nextBtn" type="button">{{__('Continue')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- listing Info end-->

                    <!-- location start-->
                    <div class="tab-pane fade step" id="media-uploads" role="tabpanel" aria-labelledby="media-uploads-tab">
                        <div class="post-your-add add-location section-padding2">
                            <div class="container-1920 plr1">
                                <div class="row">
                                    <div class="col-xl-2">
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="address box-shadow1 p-24">
                                            @if(get_static_option('google_map_settings_on_off') == null)
                                                <div class="address-wraper">
                                                    <div class="row g-3">
                                                        <div class="col-sm-4">
                                                            <div class="country">
                                                                <label for="country">{{ __('Select Your Country') }}</label>
                                                                <select name="country_id" id="country_id" class="select2_activation">
                                                                    <option value="">{{ __('Select Country') }}</option>
                                                                    @foreach($all_countries as $country)
                                                                        <option value="{{ $country->id }}" @if($country->id == $listing->country_id) selected @endif>{{ $country->country }}</option>
                                                                    @endforeach
                                                                </select><br>
                                                                <span class="country_info"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="country">
                                                                <label for="country">{{ __('Select Your State') }}</label>
                                                                <select name="state_id" id="state_id" class="get_country_state select2_activation">
                                                                    <option value="">{{ __('Select State') }}</option>
                                                                    @foreach($all_states as $state)
                                                                        <option value="{{ $state->id }}" @if($state->id == $listing->state_id) selected @endif>{{ $state->state }}</option>
                                                                    @endforeach
                                                                </select> <br>
                                                                <span class="state_info"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="country">
                                                                <label for="country">{{ __('Select Your City') }}</label>
                                                                <select name="city_id" id="city_id" class="get_state_city select2_activation">
                                                                    <option value="">{{ __('Select City') }}</option>
                                                                    @if(!empty($listing->city_id))
                                                                        @foreach($all_cities as $city)
                                                                            <option value="{{ $city->id }}" @if($city->id == $listing->city_id) selected @endif>{{ $city->city }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select><br>
                                                                <span class="city_info"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!--Google Map -->
                                                <div class="location-map mt-3">
                                                    <label class="infoTitle">{{ __('Google Map Location') }}
                                                        <a href="https://drive.google.com/file/d/1BwDAjSLAeb4LaxzOkrdsgGO_Io2jM6S6/view?usp=sharing" target="_blank">
                                                            <strong class="text-warning">{{__('Video link')}}</strong>
                                                        </a><small class="text-info">{{__('Search your location, pick a location')}} </small>
                                                    </label>
                                                    <div class="input-form input-form2">
                                                        <div class="map-warper dark-support rounded overflow-hidden">
                                                            <input id="pac-input" class="controls rounded" type="text" placeholder="{{ __('Search your location')}}"/>
                                                            <div id="map_canvas" style="height: 480px"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="address-text mt-3">
                                                <input type="hidden" name="latitude" id="latitude" value="{{$listing->lat}}">
                                                <input type="hidden" name="longitude" id="longitude" value="{{$listing->lon}}">
                                                <label for="address-text">{{ __('Address') }}</label>
                                                <input type="text" class="w-100 input-filed" name="address" id="user_address" value="{{ $listing->address }}" placeholder="{{__('Address')}}">
                                            </div>
                                        </div>
                                        <div class="video box-shadow1 p-24 mt-3 mb-3">
                                            <label for="vedio-link">{{ __('Video Url') }}</label>
                                            <input type="text"  class="input-filed w-100" name="video_url" id="video_url" value="{{ $listing->video_url}}" placeholder="{{__('youtube url')}}">
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="right-sidebar">

                                            <div class="box-shadow1 feature p-24">
                                                <label class="is_featured">
                                                    <input type="checkbox" name="is_featured" id="is_featured" value="{{$listing->is_featured}}" @if($listing->is_featured == 1) checked @endif class="custom-check-box feature_disable_color">
                                                    <span class="ms-2">{{ __('Feature This Ad') }}</span>
                                                </label>
                                                @if($user_featured_listing_enable === false)
                                                    <p>{{ __('To feature this ad, you will need to subscribe to a.') }}
                                                        <a href="{{ url('/' . $membership_page_url ?? 'x') }}">{{ __('Paid Membership') }}</a>
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="box-shadow1 tags p-24 mt-3">
                                                <label for="tags">{{ __('Tags') }}</label>
                                                <div class="select-itms">
                                                    <select name="tags[]" id="tags" class="select2_activation" multiple autocomplete="off">
                                                        @foreach($tags as $tag)
                                                            <option value="{{ $tag->id }}" @if($listing->tags->contains($tag->id)) selected @endif>{{ $tag->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small>{{ __('Select Your tags name or new tag name type') }}</small>
                                                </div>
                                            </div>

                                            <!-- start previous / next buttons -->
                                            <div class="continue-btn mt-3">
                                                <div class="btn-wrapper mb-10 d-flex justify-content-end gap-3">
                                                    <button class="red-btn w-100 d-block" id="prevBtn" type="button">{{__('Previous')}}</button>
                                                    <button class="red-btn w-100 d-block" id="submitBtn" type="submit">{{__('Update Listing')}}</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <x-media.markup :type="'web'"/>
@endsection
@section('scripts')
    <x-frontend.js.phone-number-check-for-listing/>
    <x-media.js :type="'web'"/>
    @if(!empty(get_static_option('google_map_settings_on_off')))
        <x-map.google-map-api-key-set/>
        <x-map.google-map-listing-js/>
    @endif
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/frontend/js/multi-step.js')}}"></script>
    <x-summernote.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <x-frontend.js.new-tag-add-js/>
    @if(moduleExists('Membership'))
        @if(membershipModuleExistsAndEnable('Membership'))
            @include('membership::frontend.listing.membership-listing-add-js')
        @endif
    @endif
    <x-listings.feature-ad-js :featuredenable="$user_featured_listing_enable"/>
    <x-listings.edit-condition-authenticity :condition="$listing->condition" :authenticity="$listing->authenticity"/>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                // phone hidden
                $(document).on('change','#negotiable',function(e) {
                    if ($(this).is(':checked')) {
                        let negotiable = 1;
                        $('#negotiable').val(negotiable);
                    }else{
                        let negotiable = 0;
                        $('#negotiable').val(negotiable);
                    }
                });

                // phone hidden
                $(document).on('change','#phone_hidden',function(e) {
                    e.preventDefault();
                    if ($(this).is(':checked')) {
                        let phone_hidden = 1;
                        $('#phone_hidden').val(phone_hidden);
                    }else{
                        let phone_hidden = 0;
                        $('#phone_hidden').val(phone_hidden);
                    }
                });

                //Permalink Code
                var sl =  $('.listing_slug').val();
                var url = `{{url('/listing/')}}/` + sl;
                var data = $('#slug_show').text(url).css('color', 'blue');


                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    //remove multiple space to single
                    finalSlug = slug.replace(/  +/g, ' ');
                    // remove all white spaces single or multiple spaces
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.listing_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.listing_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `{{url('/listing/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.listing_slug').hide();
                });

                $('#category').on('change',function(){
                    let category_id = $(this).val();
                    $.ajax({
                        method:'post',
                        url:"{{route('get.subcategory')}}",
                        data:{category_id:category_id},
                        success:function(res){
                            if(res.status=='success'){
                                let alloptions = "<option value=''>{{__('Select Sub Category')}}</option>";
                                let allSubCategory = res.sub_categories;
                                $.each(allSubCategory,function(index,value){
                                    alloptions +="<option value='" + value.id + "'>" + value.name + "</option>";
                                });
                                $(".subcategory").html(alloptions);
                                $('#subcategory').niceSelect('update');
                            }
                        }
                    })
                });

                // listing sub category and Age
                $(document).on('change','#subcategory', function() {
                    var sub_cat_id = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('get.subcategory.with.child.category') }}",
                        data: {
                            sub_cat_id: sub_cat_id
                        },
                        success: function(res) {

                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Age')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Age')}}</li>";
                                var allChildCategory = res.child_category;

                                $.each(allChildCategory, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.name + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.name + "</li>";
                                });

                                $("#child_category").html(alloptions);
                                $(".child_category_wrapper ul.list").html(allList);
                                $(".child_category_wrapper").find(".current").html("Select Age");
                            }
                        }
                    });
                });

                // change country and get state
                $(document).on('change','#country_id', function() {
                    let country = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.state.all') }}",
                        data: {
                            country: country
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select State')}}</option>";
                                let all_state = res.states;
                                $.each(all_state, function(index, value) {
                                    all_options += "<option value='" + value.id +
                                        "'>" + value.state + "</option>";
                                });
                                $(".get_country_state").html(all_options);
                                $(".state_info").html('');
                                if(all_state.length <= 0){
                                    $(".state_info").html('<span class="text-danger"> {{ __('No state found for selected country!') }} <span>');
                                }
                            }
                        }
                    })
                })

                // change state and get city
                $('#state_id').on('change', function() {
                    let state = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.city.all') }}",
                        data: {
                            state: state
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select City')}}</option>";
                                let all_city = res.cities;
                                $.each(all_city, function(index, value) {
                                    all_options += "<option value='" + value.id +
                                        "'>" + value.city + "</option>";
                                });
                                $(".get_state_city").html(all_options);

                                $(".city_info").html('');
                                if(all_city.length <= 0){
                                    $(".city_info").html('<span class="text-danger"> {{ __('No city found for selected state!') }} <span>');
                                }
                            }
                        }
                    })
                });

            });
        })(jQuery)
    </script>

    @if(session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
@endsection
