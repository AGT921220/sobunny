<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Listing;
use Illuminate\Http\Request;
use Modules\CountryManage\app\Models\City;
use Modules\CountryManage\app\Models\State;

class CustomSearchListingController extends Controller
{

    public function index()
    {
        return 1;
    }
    public function store(Request $request)
    {
        $items = Listing::query()->where('status', 1)->where('is_published', 1)->get();
        return view('listing.listing-one', compact('items'));
        return $this->renderBlade('listing.listing-one', [
            // 'padding_top' => $padding_top,
            // 'padding_bottom' => $padding_bottom,
            // 'columns' => $columns,
            // 'listing_grid_and_list_view' => $listing_grid_and_list_view,
            // 'url_search_listings_list' => $url_search_listings_list,

            // 'state_on_off' => $state_on_off,
            // 'city_on_off' => $city_on_off,
            // 'country_on_off' => $country_on_off,
            // 'country_text' => $country_text,
            // 'state_text' => $state_text,
            // 'city_text' => $city_text,

            // 'listing_search_by_text_on_off' => $listing_search_by_text_on_off,
            // 'category_on_off' => $category_on_off,
            // 'subcategory_on_off' => $subcategory_on_off,
            // 'child_category_on_off' => $child_category_on_off,
            // 'rating_star_on_off' => $rating_star_on_off,
            // 'sort_by_on_off' => $sort_by_on_off,
            // 'google_map_style_class' => $google_map_style_class,
            // 'map_showing_btn' => $map_showing_btn,
            // 'static_text' => $static_text,
            // 'countries' => $countries,
            // 'categories' => $categories,
            // 'search_placeholder' => $search_placeholder,
            // 'text_search_value' => $text_search_value,
            // 'category_text' => $category_text,
            // 'subcategory_text' => $subcategory_text,
            // 'sub_categories' => $sub_categories,
            // 'child_category_text' => $child_category_text,
            // 'child_categories' => $child_categories,

            // 'date_posted_title' => $date_posted_title,
            // 'date_posted_value' => $date_posted_value,
            // 'date_posted' => $date_posted,
            // 'listing_condition_title' => $listing_condition_title,
            // 'listing_condition_value' => $listing_condition_value,
            // 'listing_condition' => $listing_condition,
            // 'listing_type_preferences_title' => $listing_type_preferences_title,
            // 'listing_type_preferences_value' => $listing_type_preferences_value,
            // 'listing_type_preferences' => $listing_type_preferences,

            // 'rating_stars' => $rating_stars,
            // 'sortby_search' => $sortby_search,
            // 'listings_state' => $listings_state,
            // 'listings_city' => $listings_city,
            // 'current_page_url' => $current_page_url,

            // // google map
            // 'all_listings_list_json' => $all_listings_list_json,
            // 'google_api_key' => $google_api_key,
            // 'listing_details_route' => $listing_details_route,
            // 'latitude' => $latitude,
            // 'longitude' => $longitude,
            // 'all_listings' => $all_listings,
            // 'google_map_maker_icon' => $google_map_maker_icon,
            // 'distance_radius_km_get' => $distance_radius_km_get,

            // // for google map filter
            // 'autocomplete_address' => $autocomplete_address,
            // 'location_city_name' => $location_city_name,
            // 'radius' => $radius,
            // 'min_price' => $min_price,
            // 'max_price' => $max_price,
            // 'location_on_off' => $location_on_off,
            // 'price_range_on_off' => $price_range_on_off,
            // 'max_price_start_value' => $max_price_start_value,
            // 'countryCodesStr' => $countryCodesStr,





            // 'genders' => $this->getAllGenders->__invoke(),
            // 'ethnicities' => $this->getAllEthnicitys->__invoke(),
            // 'ages' => $this->getAllAges->__invoke(),
            // 'breasts' => $this->getAllBreasts->__invoke(),
            // 'caters' => $this->getAllCaters->__invoke(),
            // 'bodyTypes' => $this->getAllBodyTypes->__invoke(),
            // 'eyeColors' => $this->getAllEyeColors->__invoke(),
            // 'hairColors' => $this->getAllHairColors->__invoke(),
            // 'serviceTypes' => $this->getAllServiceTypes->__invoke(),
            // 'servicings' => $this->getAllServicings->__invoke(),
            // 'heights' => $this->getAllHeighs->__invoke(),
        ]);

        dd($request->input());
    }

    // return $this->renderBlade('listing.listing-one', [
    //     'padding_top' => $padding_top,
    //     'padding_bottom' => $padding_bottom,
    //     'columns' => $columns,
    //     'listing_grid_and_list_view' => $listing_grid_and_list_view,
    //     'url_search_listings_list' => $url_search_listings_list,

    //     'state_on_off' => $state_on_off,
    //     'city_on_off' => $city_on_off,
    //     'country_on_off' => $country_on_off,
    //     'country_text' => $country_text,
    //     'state_text' => $state_text,
    //     'city_text' => $city_text,

    //     'listing_search_by_text_on_off' => $listing_search_by_text_on_off,
    //     'category_on_off' => $category_on_off,
    //     'subcategory_on_off' => $subcategory_on_off,
    //     'child_category_on_off' => $child_category_on_off,
    //     'rating_star_on_off' => $rating_star_on_off,
    //     'sort_by_on_off' => $sort_by_on_off,
    //     'google_map_style_class' => $google_map_style_class,
    //     'map_showing_btn' => $map_showing_btn,
    //     'static_text' => $static_text,
    //     'countries' => $countries,
    //     'categories' => $categories,
    //     'search_placeholder' => $search_placeholder,
    //     'text_search_value' => $text_search_value,
    //     'category_text' => $category_text,
    //     'subcategory_text' => $subcategory_text,
    //     'sub_categories' => $sub_categories,
    //     'child_category_text' => $child_category_text,
    //     'child_categories' => $child_categories,

    //     'date_posted_title' => $date_posted_title,
    //     'date_posted_value' => $date_posted_value,
    //     'date_posted' => $date_posted,
    //     'listing_condition_title' => $listing_condition_title,
    //     'listing_condition_value' => $listing_condition_value,
    //     'listing_condition' => $listing_condition,
    //     'listing_type_preferences_title' => $listing_type_preferences_title,
    //     'listing_type_preferences_value' => $listing_type_preferences_value,
    //     'listing_type_preferences' => $listing_type_preferences,

    //     'rating_stars' => $rating_stars,
    //     'sortby_search' => $sortby_search,
    //     'listings_state' => $listings_state,
    //     'listings_city' => $listings_city,
    //     'current_page_url' => $current_page_url,

    //     // google map
    //     'all_listings_list_json' => $all_listings_list_json,
    //     'google_api_key' => $google_api_key,
    //     'listing_details_route' => $listing_details_route,
    //     'latitude' => $latitude,
    //     'longitude' => $longitude,
    //     'all_listings' => $all_listings,
    //     'google_map_maker_icon' => $google_map_maker_icon,
    //     'distance_radius_km_get' => $distance_radius_km_get,

    //     // for google map filter
    //     'autocomplete_address' => $autocomplete_address,
    //     'location_city_name' => $location_city_name,
    //     'radius' => $radius,
    //     'min_price' => $min_price,
    //     'max_price' => $max_price,
    //     'location_on_off' => $location_on_off,
    //     'price_range_on_off' => $price_range_on_off,
    //     'max_price_start_value' => $max_price_start_value,
    //     'countryCodesStr' => $countryCodesStr,





    //     'genders' => $this->getAllGenders->__invoke(),
    //     'ethnicities' => $this->getAllEthnicitys->__invoke(),
    //     'ages' => $this->getAllAges->__invoke(),
    //     'breasts' => $this->getAllBreasts->__invoke(),
    //     'caters' => $this->getAllCaters->__invoke(),
    //     'bodyTypes' => $this->getAllBodyTypes->__invoke(),
    //     'eyeColors' => $this->getAllEyeColors->__invoke(),
    //     'hairColors' => $this->getAllHairColors->__invoke(),
    //     'serviceTypes' => $this->getAllServiceTypes->__invoke(),
    //     'servicings' => $this->getAllServicings->__invoke(),
    //     'heights' => $this->getAllHeighs->__invoke(),

    // ]);

}
