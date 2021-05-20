<?php
error_reporting(0);
    use Illuminate\Http\Request;

/*
      |--------------------------------------------------------------------------
      | API Routes
      |--------------------------------------------------------------------------
      |
      | Here is where you can register API routes for your application. These
      | routes are loaded by the RouteServiceProvider within a group which
      | is assigned the "api" middleware group. Enjoy building your API!
      |
     */
    //    Route::middleware('auth:api')->get('/user', function (Request $request)
//    {
//        return $request->user();
//    });

    Route::get('insert-country-data', 'api\ApiController@insertCountryData');
    Route::get('insert-user-data', 'api\ApiController@insertUserData');
    Route::get('insert-slider-data', 'api\ApiController@insertSliderData');
    Route::get('insert-faq-data', 'api\ApiController@insertFaqData');
    Route::get('insert-color-data', 'api\ApiController@insertColorData');
    Route::get('insert-accessories-data', 'api\ApiController@insertAccessoriesData');
    Route::get('insert-fabric-data', 'api\ApiController@insertFabricData');
    Route::get('insert-occasion-data', 'api\ApiController@insertOccasionData');
    Route::get('insert-size-data', 'api\ApiController@insertSizeData');
    Route::get('insert-testimonial-data', 'api\ApiController@insertTestimonialData');
    Route::get('insert-main-category-data', 'api\ApiController@insertMainCategoryData');
    Route::get('insert-category-data', 'api\ApiController@insertCategoryData');
    Route::get('insert-sub-category-data', 'api\ApiController@insertSubCategoryData');
    Route::get('insert-shipping-data', 'api\ApiController@insertShippingData');
    Route::get('insert-masterpages-data', 'api\ApiController@insertMasterpagesData');
    Route::get('insert-wishlist-data', 'api\ApiController@insertWishlistData');
    Route::get('insert-measurement-data', 'api\ApiController@insertMeasurementData');
    Route::get('insert-product-data', 'api\ApiController@insertProductData');
    Route::get('remove-duplicate-data', 'api\ApiController@removeDuplicateData');
    Route::get('update-slug', 'api\ApiController@updateSlug');
    Route::get('update-discount-price', 'api\ApiController@updateDiscountPrice');