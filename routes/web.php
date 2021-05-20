<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Console\RouteListCommand;
use Laravel\Socialite\Facades\Socialite;

error_reporting(0);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Clear Cache Url
Route::get('/queue-work', function () {
    $exitCode = Artisan::call('queue:work');
    return redirect('/');
});

// Clear Cache Url
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:clear');
    return redirect('/');
});
// ---------------
// Storage Link Url
Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return redirect('/');
});
// ----------------

// ---------------
// Storage Link Url
Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return redirect('/');
});
// ----------------

// Route::get('/home', 'HomeController@index')->name('home');

// Admin panel
Route::prefix('admin-panel')->group(function () {

    // Auth
    Route::get('login', 'AdminPanel\Auth\LoginController@showLoginForm')->name('adminPanel.login');
    Route::post('login', 'AdminPanel\Auth\LoginController@login')->name('adminPanel.login');
    Route::get('logout', 'AdminPanel\Auth\LoginController@logout')->name('adminPanel.logout');
    Route::get('register', 'AdminPanel\Auth\RegisterController@showRegistrationForm')->name('adminPanel.register');
    Route::post('register', 'AdminPanel\Auth\RegisterController@register')->name('adminPanel.register');
    Route::get('password/reset', 'AdminPanel\Auth\ForgotPasswordController@showLinkRequestForm')->name('adminPanel.passwordRest');
    Route::post('password/email', 'AdminPanel\Auth\ForgotPasswordController@sendResetLinkEmail')->name('adminPanel.passwordEmail');
    Route::get('password/reset/{token}/{email}', 'AdminPanel\Auth\ResetPasswordController@showResetForm')->name('adminPanel.passwordRestPage');
    Route::post('password/reset', 'AdminPanel\Auth\ResetPasswordController@reset')->name('adminPanel.passwordRest');
    //-----

    // Dashboard
    Route::get('/', 'AdminPanel\DashboardController@index')->name('adminPanel.dashboard');
    Route::get('/dashboard', 'AdminPanel\DashboardController@index')->name('adminPanel.dashboard');
    // ---------


    // Users
    Route::prefix('users')->group(function () {
        Route::get('/',                 'UserController@index')->name('adminPanel.users.index');
        Route::get('/get-users',        'UserController@getUsers')->name('adminPanel.users.getUser');
        Route::any('/change-status',    'UserController@changeStatus')->name('adminPanel.users.changeStatus');
        Route::any('/download-excel',    'UserController@userExcel')->name('adminPanel.users.userExcel');
    });
    //-----

    // Accessory
    Route::prefix('accessory')->group(function () {
        Route::get('/',                     'AdminPanel\AccessoryController@index')->name('adminPanel.accessory.index');
        Route::post('/',                    'AdminPanel\AccessoryController@store')->name('adminPanel.accessory.store');
        Route::get('/get-accessories',       'AdminPanel\AccessoryController@getAccessories')->name('adminPanel.accessory.getAccessories');
        Route::get('/add',               'AdminPanel\AccessoryController@create')->name('adminPanel.accessory.create');
        Route::post('/change-status',       'AdminPanel\AccessoryController@changeStatus')->name('adminPanel.accessory.changeStatus');
        Route::any('/destroy',              'AdminPanel\AccessoryController@destroy')->name('adminPanel.accessory.destroy');
        Route::get('/check-accessory',       'AdminPanel\AccessoryController@checkAccessoryName')->name('adminPanel.accessory.checkAccessoryName');
        Route::get('/{id}/edit',            'AdminPanel\AccessoryController@edit')->name('adminPanel.accessory.edit');
        Route::post('/{id}/update',         'AdminPanel\AccessoryController@update')->name('adminPanel.accessory.update');
    });
    // ---------

    // Account Setting
    Route::prefix('account-setting')->group(function () {
        Route::get('/',                     'AdminPanel\AccountSettingController@index')->name('adminPanel.accountSetting.index');
        Route::post('{id}/update',           'AdminPanel\AccountSettingController@update')->name('adminPanel.accountSetting.update');
        Route::any('/destroy',              'AdminPanel\AccountSettingController@destroy')->name('adminPanel.accountSetting.destroy');
    });
    // ------------

    // Category
    Route::prefix('category')->group(function () {
        Route::get('/',                     'AdminPanel\CategoryController@index')->name('adminPanel.category.index');
        Route::post('/',                    'AdminPanel\CategoryController@store')->name('adminPanel.category.store');
        Route::get('/get-categoires',       'AdminPanel\CategoryController@getCategories')->name('adminPanel.category.getCategories');
        Route::get('/get-trash-categoires', 'AdminPanel\CategoryController@getTrashCategories')->name('adminPanel.category.getTrashCategories');
        Route::get('/add',               'AdminPanel\CategoryController@create')->name('adminPanel.category.create');
        Route::post('/change-status',       'AdminPanel\CategoryController@changeStatus')->name('adminPanel.category.changeStatus');
        Route::post('/change-order',        'AdminPanel\CategoryController@changeOrder')->name('adminPanel.category.changeOrder');
        Route::any('/destroy',              'AdminPanel\CategoryController@moveToTrash')->name('adminPanel.category.moveToTrash');
        Route::get('/view-trash',           'AdminPanel\CategoryController@viewTrash')->name('adminPanel.category.viewTrash');
        Route::get('/check-category',       'AdminPanel\CategoryController@checkCategoryName')->name('adminPanel.category.checkCategoryName');
        Route::get('/get-sub-parent-cat',   'AdminPanel\CategoryController@getSubParentCategory')->name('adminPanel.category.subParents');
        Route::get('/{id}/edit',            'AdminPanel\CategoryController@edit')->name('adminPanel.category.edit');
        Route::post('/{id}/update',         'AdminPanel\CategoryController@update')->name('adminPanel.category.update');
    });
    // --------

    // Color
    Route::prefix('color')->group(function () {
        Route::get('/',                     'AdminPanel\ColorController@index')->name('adminPanel.color.index');
        Route::post('/',                    'AdminPanel\ColorController@store')->name('adminPanel.color.store');
        Route::get('/get-colors',           'AdminPanel\ColorController@getColors')->name('adminPanel.color.getColors');
        Route::get('/add',               'AdminPanel\ColorController@create')->name('adminPanel.color.create');
        Route::post('/change-status',       'AdminPanel\ColorController@changeStatus')->name('adminPanel.color.changeStatus');
        Route::post('/change-order',       'AdminPanel\ColorController@changeOrder')->name('adminPanel.color.changeOrder');
        Route::any('/destroy',              'AdminPanel\ColorController@destroy')->name('adminPanel.color.destroy');
        Route::get('/check-color-name',     'AdminPanel\ColorController@checkColorName')->name('adminPanel.color.checkColorName');
        Route::get('/check-color-code',     'AdminPanel\ColorController@checkColorName')->name('adminPanel.color.checkColorCode');
        Route::get('/get-sub-parent-cat',   'AdminPanel\ColorController@getSubParentColor')->name('adminPanel.color.subParents');
        Route::get('/{id}/edit',            'AdminPanel\ColorController@edit')->name('adminPanel.color.edit');
        Route::post('/{id}/update',         'AdminPanel\ColorController@update')->name('adminPanel.color.update');
    });
    // -----


    // Country
    Route::prefix('country')->group(function () {
        Route::get('/',                    'AdminPanel\CountryController@index')->name('adminPanel.country.index');
        Route::post('/',                   'AdminPanel\CountryController@store')->name('adminPanel.country.store');
        Route::get('/get-countries',       'AdminPanel\CountryController@getCountries')->name('adminPanel.country.getcountries');
        Route::get('/add',              'AdminPanel\CountryController@create')->name('adminPanel.country.create');
        Route::any('/change-status',       'AdminPanel\CountryController@changeStatus')->name('adminPanel.country.changeStatus');
        Route::any('/destroy',             'AdminPanel\CountryController@destroy')->name('adminPanel.country.destroy');
        Route::get('/check-country',       'AdminPanel\CountryController@checkCountryTitle')->name('adminPanel.country.checkCountryTitle');
        Route::get('/{id}/edit',           'AdminPanel\CountryController@edit')->name('adminPanel.country.edit');
        Route::post('/{id}/update',        'AdminPanel\CountryController@update')->name('adminPanel.country.update');
    });
    // ---------


    // coupon
    Route::prefix('coupon')->group(function () {
        Route::get('/',                    'AdminPanel\CouponController@index')->name('adminPanel.coupon.index');
        Route::post('/',                   'AdminPanel\CouponController@store')->name('adminPanel.coupon.store');
        Route::get('/get-coupons',         'AdminPanel\CouponController@getCoupons')->name('adminPanel.coupon.getCoupons');
        Route::get('/add',              'AdminPanel\CouponController@create')->name('adminPanel.coupon.create');
        Route::any('/change-status',       'AdminPanel\CouponController@changeStatus')->name('adminPanel.coupon.changeStatus');
        Route::any('/destroy',             'AdminPanel\CouponController@destroy')->name('adminPanel.coupon.destroy');
        Route::get('/check-coupon',        'AdminPanel\CouponController@checkCouponCode')->name('adminPanel.coupon.checkCouponCode');
        Route::get('/{id}/edit',           'AdminPanel\CouponController@edit')->name('adminPanel.coupon.edit');
        Route::post('/{id}/update',        'AdminPanel\CouponController@update')->name('adminPanel.coupon.update');
    });
    // ---------

    // Fabric
    Route::prefix('fabric')->group(function () {
        Route::get('/',                     'AdminPanel\FabricController@index')->name('adminPanel.fabric.index');
        Route::post('/',                    'AdminPanel\FabricController@store')->name('adminPanel.fabric.store');
        Route::get('/get-fabrics',          'AdminPanel\FabricController@getfabrics')->name('adminPanel.fabric.getFabrics');
        Route::get('/add',               'AdminPanel\FabricController@create')->name('adminPanel.fabric.create');
        Route::post('/change-status',       'AdminPanel\FabricController@changeStatus')->name('adminPanel.fabric.changeStatus');
        Route::post('/change-order',       'AdminPanel\FabricController@changeOrder')->name('adminPanel.fabric.changeOrder');
        Route::any('/destroy',              'AdminPanel\FabricController@destroy')->name('adminPanel.fabric.destroy');
        Route::get('/check-fabric',         'AdminPanel\FabricController@checkfabricName')->name('adminPanel.fabric.checkFabricName');
        Route::get('/get-sub-parent-cat',   'AdminPanel\FabricController@getSubParentfabric')->name('adminPanel.fabric.subParents');
        Route::get('/{id}/edit',            'AdminPanel\FabricController@edit')->name('adminPanel.fabric.edit');
        Route::post('/{id}/update',         'AdminPanel\FabricController@update')->name('adminPanel.fabric.update');
    });
    // ------

    // Faq
    Route::prefix('faq')->group(function () {
        Route::get('/',                     'AdminPanel\FaqController@index')->name('adminPanel.faq.index');
        Route::post('/',                    'AdminPanel\FaqController@store')->name('adminPanel.faq.store');
        Route::get('/get-faq',              'AdminPanel\FaqController@getFaqs')->name('adminPanel.faq.getFaqs');
        Route::get('/add',               'AdminPanel\FaqController@create')->name('adminPanel.faq.create');
        Route::any('/change-status',        'AdminPanel\FaqController@changeStatus')->name('adminPanel.faq.changeStatus');
        Route::any('/destroy',              'AdminPanel\FaqController@destroy')->name('adminPanel.faq.destroy');
        Route::get('/check-faq-question',    'AdminPanel\FaqController@checkQuestion')->name('adminPanel.faq.checkQuestion');
        Route::get('/{id}/edit',            'AdminPanel\FaqController@edit')->name('adminPanel.faq.edit');
        Route::post('/{id}/update',         'AdminPanel\FaqController@update')->name('adminPanel.faq.update');
    });
    // ----------

    // Gallary
    Route::prefix('gallery')->group(function () {
        Route::get('/',                     'AdminPanel\GallaryController@index')->name('adminPanel.gallary.index');
        Route::post('/',                    'AdminPanel\GallaryController@store')->name('adminPanel.gallary.store');
        Route::get('/get-gallery',          'AdminPanel\GallaryController@getGallary')->name('adminPanel.gallary.getGallary');
        Route::get('/add',               'AdminPanel\GallaryController@create')->name('adminPanel.gallary.create');
        Route::any('/change-status',        'AdminPanel\GallaryController@changeStatus')->name('adminPanel.gallary.changeStatus');
        Route::post('/change-order',       'AdminPanel\GallaryController@changeOrder')->name('adminPanel.gallary.changeOrder');
        Route::any('/destroy',              'AdminPanel\GallaryController@destroy')->name('adminPanel.gallary.destroy');
        Route::get('/check-gallery',        'AdminPanel\GallaryController@checkGallaryTitle')->name('adminPanel.gallary.checkGallaryTitle');
        Route::get('/{id}/edit',            'AdminPanel\GallaryController@edit')->name('adminPanel.gallary.edit');
        Route::post('/{id}/update',         'AdminPanel\GallaryController@update')->name('adminPanel.gallary.update');
    });
    // ----------

    // Home Page Content
    Route::prefix('home-page-content')->group(function () {
        Route::get('/{type}',                     'AdminPanel\HomePageContentController@index')->name('adminPanel.homePageContent.index');
        Route::post('{type}/update',              'AdminPanel\HomePageContentController@update')->name('adminPanel.homePageContent.update');
    });
    // -----------------

    // Mesurement
    Route::prefix('measurement')->group(function () {
        Route::get('/',                     'AdminPanel\MeasurementController@index')->name('adminPanel.measurement.index');
        Route::post('/',                    'AdminPanel\MeasurementController@store')->name('adminPanel.measurement.store');
        Route::get('/get-measurement',      'AdminPanel\MeasurementController@getMeasurmenet')->name('adminPanel.measurement.getMeasurmenet');
        Route::get('/add',               'AdminPanel\MeasurementController@create')->name('adminPanel.measurement.create');
        Route::any('/change-status',        'AdminPanel\MeasurementController@changeStatus')->name('adminPanel.measurement.changeStatus');
        Route::any('/destroy',             'AdminPanel\MeasurementController@destroy')->name('adminPanel.measurement.destroy');
        Route::get('/check-measurement',    'AdminPanel\MeasurementController@checkMeasurementTitle')->name('adminPanel.measurement.checkMeasurementTitle');

        Route::get('/{id}/edit',            'AdminPanel\MeasurementController@edit')->name('adminPanel.measurement.edit');
        Route::post('/{id}/update',         'AdminPanel\MeasurementController@update')->name('adminPanel.measurement.update');
        Route::get('/{id}/detail-destroy',  'AdminPanel\MeasurementController@destroyDetail')->name('adminPanel.measurement.destroyDetail');
    });
    // -----------
    // News Letters
    Route::prefix('news-letter')->group(function () {
        Route::get('/',                     'AdminPanel\NewsLetterController@index')->name('adminPanel.newsLetter.index');
        Route::get('/get-news-letters',     'AdminPanel\NewsLetterController@getNewsLetters')->name('adminPanel.newsLetter.getNewsLetters');
        Route::any('/change-status',        'AdminPanel\NewsLetterController@changeStatus')->name('adminPanel.newsLetter.changeStatus');
        Route::any('/destroy',              'AdminPanel\NewsLetterController@destroy')->name('adminPanel.newsLetter.destroy');
    });
    // ----------

    // Contact Enquiry
    Route::prefix('enquiry')->group(function () {
        Route::get('/',                     'AdminPanel\EnquiryController@index')->name('adminPanel.enquiry.index');
        Route::get('/get-enquiries',        'AdminPanel\EnquiryController@getEnquiries')->name('adminPanel.enquiry.getEnquiries');
        Route::any('/change-status',        'AdminPanel\EnquiryController@changeStatus')->name('adminPanel.enquiry.changeStatus');
        Route::any('/destroy',              'AdminPanel\EnquiryController@destroy')->name('adminPanel.enquiry.destroy');
    });
    // ----------

    // Page
    Route::prefix('page')->group(function () {
        Route::get('/{id}',                 'AdminPanel\PageController@index')->name('adminPanel.page.index');
        Route::any('{id}/update',           'AdminPanel\PageController@update')->name('adminPanel.page.update');
    });
    // ----------

    // Products
    Route::prefix('product')->group(function () {
        Route::get('/',                     'AdminPanel\ProductController@index')->name('adminPanel.product.index');
        Route::post('/',                    'AdminPanel\ProductController@store')->name('adminPanel.product.store');
        Route::get('/get-products',         'AdminPanel\ProductController@getProducts')->name('adminPanel.product.getProducts');
        Route::get('/add',               'AdminPanel\ProductController@create')->name('adminPanel.product.create');
        Route::post('/change-status',       'AdminPanel\ProductController@changeStatus')->name('adminPanel.product.changeStatus');
        Route::any('/destroy',              'AdminPanel\ProductController@destroy')->name('adminPanel.product.destroy');
        Route::get('/check-product-name',   'AdminPanel\ProductController@checkProductName')->name('adminPanel.product.checkProductName');
        Route::get('/check-product-code',   'AdminPanel\ProductController@checkProductCode')->name('adminPanel.product.checkProductCode');
        Route::get('/{id}/edit',            'AdminPanel\ProductController@edit')->name('adminPanel.product.edit');
        Route::post('/{id}/update',         'AdminPanel\ProductController@update')->name('adminPanel.product.update');
        Route::post('/change-type',         'AdminPanel\ProductController@changeType')->name('adminPanel.product.changeType');
        Route::post('/change-stock-status', 'AdminPanel\ProductController@changeStockStatus')->name('adminPanel.product.changeStockStatus');
        Route::get('{id}/view',             'AdminPanel\ProductController@productDetails')->name('adminPanel.product.details');
        Route::post('remove-image',         'AdminPanel\ProductController@removeImage')->name('adminPanel.product.removeImage');
        // Product Excel Uplodation
        Route::get('/upload-excel',         'AdminPanel\ProductController@uploadExcelIndex')->name('adminPanel.product.uploadExcelIndex');
        Route::post('/upload-excel/store',  'AdminPanel\ProductController@uploadExcel')->name('adminPanel.product.uploadExcel');
        Route::get('/download-excel',       'AdminPanel\ProductController@downloadExcel')->name('adminPanel.product.downloadExcel');
        // -----------------------
        // Product Zip Uplodation
        Route::get('/upload-zip',         'AdminPanel\ProductController@uploadZipIndex')->name('adminPanel.product.uploadZipIndex');
        Route::post('/upload-zip/store',  'AdminPanel\ProductController@uploadZip')->name('adminPanel.product.uploadZip');
        // -----------------------
    });
    // --------

    // Product Enquiry
    Route::prefix('product/enquiry')->group(function () {
        Route::get('/',                     'AdminPanel\ProductEnquiryController@index')->name('adminPanel.productEnquiry.index');
        Route::get('/get-enquiries',        'AdminPanel\ProductEnquiryController@getEnquiries')->name('adminPanel.productEnquiry.getEnquiries');
        Route::any('/change-status',        'AdminPanel\ProductEnquiryController@changeStatus')->name('adminPanel.productEnquiry.changeStatus');
        Route::any('/destroy',              'AdminPanel\ProductEnquiryController@destroy')->name('adminPanel.productEnquiry.destroy');
    });
    // ----------

    // Product Review
    Route::prefix('product/review')->group(function () {
        Route::get('/',                     'AdminPanel\ProductReviewController@index')->name('adminPanel.productReview.index');
        Route::get('/get-reviews',          'AdminPanel\ProductReviewController@getEnquiries')->name('adminPanel.productReview.getEnquiries');
        Route::any('/change-status',        'AdminPanel\ProductReviewController@changeStatus')->name('adminPanel.productReview.changeStatus');
        Route::any('/destroy',              'AdminPanel\ProductReviewController@destroy')->name('adminPanel.productReview.destroy');
    });
    // ----------

    // Profile
    Route::get('/profile',                  'AdminPanel\ProfileController@index')->name('adminPanel.profile');
    Route::post('/profile/update',          'AdminPanel\ProfileController@update')->name('adminPanel.profile.update');
    Route::post('/profile/change-password', 'AdminPanel\ProfileController@changePassword')->name('adminPanel.profile.changePassword');
    // ---------



    // Order Details
    Route::prefix('order-details')->group(function () {
        Route::get('/{type}',                    'AdminPanel\OrderDetailsController@index')->name('adminPanel.orderDetails.index');
        Route::get('/{type}/get-order-details',  'AdminPanel\OrderDetailsController@getOrderDetails')->name('adminPanel.orderDetails.getOrderDetails');
        Route::get('view-trashed/get-trashed-order-details', 'AdminPanel\OrderDetailsController@getTashedOrderDetails')
            ->name('adminPanel.orderDetails.getTashedOrderDetails');
        Route::any('/change-status',             'AdminPanel\OrderDetailsController@changeStatus')->name('adminPanel.orderDetails.changeStatus');
        Route::any('/move-to-trash',             'AdminPanel\OrderDetailsController@moveToTrash')->name('adminPanel.orderDetails.moveToTrash');
        Route::any('/destroy',                   'AdminPanel\OrderDetailsController@destroy')->name('adminPanel.orderDetails.destroy');
        Route::get('/view-trashed',              'AdminPanel\OrderDetailsController@viewTrashed')->name('adminPanel.orderDetails.viewTrash');
        Route::any('/undo-deleted',              'AdminPanel\OrderDetailsController@undoDelete')->name('adminPanel.orderDetails.undoDelete');
        Route::get('{id}/view',                  'AdminPanel\OrderDetailsController@productOrderDetails')->name('adminPanel.orderDetails.productOrderDetails');
        Route::get('{id}/get-measurement',       'AdminPanel\OrderDetailsController@getMeasurmenets')->name('adminPanel.orderDetails.getMeasurmenets');
    });
    //-------------

    // Occasion
    Route::prefix('occasion')->group(function () {
        Route::get('/',                    'AdminPanel\OccasionController@index')->name('adminPanel.occasion.index');
        Route::post('/',                   'AdminPanel\OccasionController@store')->name('adminPanel.occasion.store');
        Route::get('/get-occasions',       'AdminPanel\OccasionController@getOccasions')->name('adminPanel.occasion.getOccasions');
        Route::get('/add',              'AdminPanel\OccasionController@create')->name('adminPanel.occasion.create');
        Route::any('/change-status',       'AdminPanel\OccasionController@changeStatus')->name('adminPanel.occasion.changeStatus');
        Route::post('/change-order',       'AdminPanel\OccasionController@changeOrder')->name('adminPanel.occasion.changeOrder');
        Route::any('/destroy',             'AdminPanel\OccasionController@destroy')->name('adminPanel.occasion.destroy');
        Route::get('/check-occasion',      'AdminPanel\OccasionController@checkoccasionTitle')->name('adminPanel.occasion.checkOccasionTitle');
        Route::get('/{id}/edit',           'AdminPanel\OccasionController@edit')->name('adminPanel.occasion.edit');
        Route::post('/{id}/update',        'AdminPanel\OccasionController@update')->name('adminPanel.occasion.update');
    });
    // ---------
    // Size
    Route::prefix('size')->group(function () {
        Route::get('/',                    'AdminPanel\SizeController@index')->name('adminPanel.size.index');
        Route::post('/',                   'AdminPanel\SizeController@store')->name('adminPanel.size.store');
        Route::get('/get-sizes',           'AdminPanel\SizeController@getSizes')->name('adminPanel.size.getSizes');
        Route::get('/add',              'AdminPanel\SizeController@create')->name('adminPanel.size.create');
        Route::any('/change-status',       'AdminPanel\SizeController@changeStatus')->name('adminPanel.size.changeStatus');
        Route::post('/change-order',       'AdminPanel\SizeController@changeOrder')->name('adminPanel.size.changeOrder');
        Route::any('/destroy',             'AdminPanel\SizeController@destroy')->name('adminPanel.size.destroy');
        Route::get('/check-size',          'AdminPanel\SizeController@checkSizeTitle')->name('adminPanel.size.checkSizeTitle');
        Route::get('/{id}/edit',           'AdminPanel\SizeController@edit')->name('adminPanel.size.edit');
        Route::post('/{id}/update',        'AdminPanel\SizeController@update')->name('adminPanel.size.update');
    });
    // -------

    // Blouse Design
    Route::prefix('blouse-design')->group(function () {
        Route::get('/',                    'AdminPanel\BlouseController@index')->name('adminPanel.blouse.index');
        Route::post('/',                   'AdminPanel\BlouseController@store')->name('adminPanel.blouse.store');
        Route::get('/get-designs',         'AdminPanel\BlouseController@getdesigns')->name('adminPanel.blouse.getDesigns');
        Route::get('/add',              'AdminPanel\BlouseController@create')->name('adminPanel.blouse.create');
        Route::any('/change-status',       'AdminPanel\BlouseController@changeStatus')->name('adminPanel.blouse.changeStatus');
        Route::post('/change-order',       'AdminPanel\BlouseController@changeOrder')->name('adminPanel.blouse.changeOrder');
        Route::any('/destroy',             'AdminPanel\BlouseController@destroy')->name('adminPanel.blouse.destroy');
        Route::get('/check-size',          'AdminPanel\BlouseController@checkBlouseTitle')->name('adminPanel.blouse.checkBlouseTitle');
        Route::get('/{id}/edit',           'AdminPanel\BlouseController@edit')->name('adminPanel.blouse.edit');
        Route::post('/{id}/update',        'AdminPanel\BlouseController@update')->name('adminPanel.blouse.update');
    });
    // ------------

    // Slider Image
    Route::prefix('slider-image')->group(function () {
        Route::get('/',                    'AdminPanel\SliderImageController@index')->name('adminPanel.slider.index');
        Route::post('/',                   'AdminPanel\SliderImageController@store')->name('adminPanel.slider.store');
        Route::get('/get-slider-images',   'AdminPanel\SliderImageController@getSliders')->name('adminPanel.slider.getSliders');
        Route::get('/add',              'AdminPanel\SliderImageController@create')->name('adminPanel.slider.create');
        Route::any('/change-status',       'AdminPanel\SliderImageController@changeStatus')->name('adminPanel.slider.changeStatus');
        Route::any('/destroy',             'AdminPanel\SliderImageController@destroy')->name('adminPanel.slider.destroy');
        Route::get('/check-size',          'AdminPanel\SliderImageController@checkSliderTitle')->name('adminPanel.slider.checkSliderTitle');
        Route::get('/{id}/edit',           'AdminPanel\SliderImageController@edit')->name('adminPanel.slider.edit');
        Route::post('/{id}/update',        'AdminPanel\SliderImageController@update')->name('adminPanel.slider.update');
    });
    // ------------

    // Saree Mesurement
    Route::prefix('saree-measurement')->group(function () {
        Route::get('/',                     'AdminPanel\SareeMeasurementController@index')->name('adminPanel.sareeMeasurement.index');
        Route::post('/',                    'AdminPanel\SareeMeasurementController@store')->name('adminPanel.sareeMeasurement.store');
        Route::get('/get-measurement',      'AdminPanel\SareeMeasurementController@getMeasurmenet')->name('adminPanel.sareeMeasurement.getMeasurmenet');
        Route::get('/add',               'AdminPanel\SareeMeasurementController@create')->name('adminPanel.sareeMeasurement.create');
        Route::any('/change-status',        'AdminPanel\SareeMeasurementController@changeStatus')->name('adminPanel.sareeMeasurement.changeStatus');
        Route::any('/destroy',              'AdminPanel\SareeMeasurementController@destroy')->name('adminPanel.sareeMeasurement.destroy');
        Route::get('/check-measurement',    'AdminPanel\SareeMeasurementController@checkMeasurementTitle')->name('adminPanel.sareeMeasurement.checkMeasurementTitle');

        Route::get('/{id}/edit',            'AdminPanel\SareeMeasurementController@edit')->name('adminPanel.sareeMeasurement.edit');
        Route::post('/{id}/update',         'AdminPanel\SareeMeasurementController@update')->name('adminPanel.sareeMeasurement.update');
    });
    // --------------

    // Salwar Mesurement
    Route::prefix('salwar-measurement')->group(function () {
        Route::get('/',                     'AdminPanel\SalwarMeasurementController@index')->name('adminPanel.salwarMeasurement.index');
        Route::post('/',                    'AdminPanel\SalwarMeasurementController@store')->name('adminPanel.salwarMeasurement.store');
        Route::post('/update',              'AdminPanel\SalwarMeasurementController@update')->name('adminPanel.salwarMeasurement.update');
        Route::any('/destroy',              'AdminPanel\SalwarMeasurementController@destroy')->name('adminPanel.salwarMeasurement.destroy');
    });
    // --------------

    // Shipping Charges
    Route::prefix('shipping-charges')->group(function () {
        Route::get('/',                          'AdminPanel\ShippingController@index')->name('adminPanel.shippingCharges.index');
        Route::post('/',                         'AdminPanel\ShippingController@store')->name('adminPanel.shippingCharges.store');
        Route::any('/get-shipping-countries',    'AdminPanel\ShippingController@getShippingCountries')->name('adminPanel.shippingCharges.getShippingCountries');
        Route::get('/add',                    'AdminPanel\ShippingController@create')->name('adminPanel.shippingCharges.create');
        Route::any('/change-status',             'AdminPanel\ShippingController@changeStatus')->name('adminPanel.shippingCharges.changeStatus');
        Route::any('/destroy',                   'AdminPanel\ShippingController@destroy')->name('adminPanel.shippingCharges.destroy');
        Route::get('/{id}/edit',                 'AdminPanel\ShippingController@edit')->name('adminPanel.shippingCharges.edit');
        Route::post('/{id}/update',              'AdminPanel\ShippingController@update')->name('adminPanel.shippingCharges.update');
    });
    // --------------

    // Testimonial
    Route::prefix('testimonial')->group(function () {
        Route::get('/',                     'AdminPanel\TestimonialController@index')->name('adminPanel.testimonial.index');
        Route::post('/',                    'AdminPanel\TestimonialController@store')->name('adminPanel.testimonial.store');
        Route::get('/get-testimonial',      'AdminPanel\TestimonialController@getTestimonials')->name('adminPanel.testimonial.getTestimonials');
        Route::get('/add',               'AdminPanel\TestimonialController@create')->name('adminPanel.testimonial.create');
        Route::any('/change-status',        'AdminPanel\TestimonialController@changeStatus')->name('adminPanel.testimonial.changeStatus');
        Route::post('/change-order',       'AdminPanel\TestimonialController@changeOrder')->name('adminPanel.testimonial.changeOrder');
        Route::any('/destroy',              'AdminPanel\TestimonialController@destroy')->name('adminPanel.testimonial.destroy');
        Route::get('/{id}/edit',            'AdminPanel\TestimonialController@edit')->name('adminPanel.testimonial.edit');
        Route::post('/{id}/update',         'AdminPanel\TestimonialController@update')->name('adminPanel.testimonial.update');
        Route::get('/{id}/detail-destroy',  'AdminPanel\TestimonialController@destroyDetail')->name('adminPanel.testimonial.destroyDetail');
    });
    // ----------

    // Transaction
    Route::prefix('transaction')->group(function () {
        Route::get('/',                     'AdminPanel\TransactionController@index')->name('adminPanel.transaction.index');
        Route::get('/get-transaction',      'AdminPanel\TransactionController@gettransactions')->name('adminPanel.transaction.getTransactions');
    });
    // ----------

});
//------------


// Website Urls

Route::prefix('/')->group(function () {
    Route::get('/', 'Frontend\HomeController@index');
    Route::get('/category/{category}/{sub_category?}/{sub_sub_category?}', 'Frontend\ProductController@view');
    Route::get('/product/{product_slug}', 'Frontend\ProductController@details');
    Route::get('sign-in', 'Frontend\UserController@showLogin');
    Route::post('subscribe-newsletter', 'Frontend\NewsLetterController@subscribe');
    Route::get('faq', function () {
        return view('frontend.faq');
    });
    Route::post('login', 'Frontend\UserController@login');
    Route::post('register', 'Frontend\UserController@register');
    Route::middleware(['websiteguard'])->group(function () {
        Route::get('cart', 'Frontend\CartController@index');
        Route::get('my-profile', 'Frontend\UserController@profile');
        Route::get('logout', 'Frontend\UserController@logout');
    });
    Route::get('forgot-password', function () {
        return view('frontend.reset-email');
    });
    Route::post('password/email', 'Frontend\UserController@sendResetLinkEmail')->name('frontend.passwordEmail');
    Route::get('password/reset/{temp_pass}/{email}', 'Frontend\UserController@showResetPasswordPage');
    Route::post('change-password', 'Frontend\UserController@changePassword');
    Route::get('/google-login', function () {
        return Socialite::driver('google')->redirect();
    });
    Route::get('/google-login/callback', 'Frontend\UserController@googleLogin');
    Route::get('/facebook-login', function () {
        $user = Socialite::driver('facebook')->user();

        // $user->token
    });
});
