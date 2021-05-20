<?php

$constants = [];

/*
|--------------------------------------------------------------------------
| Global constants variables declaration.
|--------------------------------------------------------------------------
|
| Here is we are defining variables for the constants that can be used in
| more than one constants.
|
 */

/**
 * Images path.
 */

$images_path      =  'public/uploads/images/';
$zip_path         =  'public/uploads/zip/';
$thumb_image_path =  'storage/app/public/uploads/images/';
$download_path    =  'public/storage/downloads/';

$constants['adminUsers'] = [
    // Admin User Image Path
    'images_path' => $images_path . 'admin-users/',
    // ----------
];

$constants['category'] = [
    // Category Image Path
    'images_path' => $images_path . 'categories/',
    'sizeChart_path' => $images_path . 'categories/sizeChart/',
    // ----------
];

$constants['gallary'] = [
    // Measurement Image Path
    'images_path' => $images_path . 'gallary/',
    // ----------
];

$constants['measurement'] = [
    // Measurement Image Path
    'images_path' => $images_path . 'measurement/chart/',
    // ----------
];

$constants['salwarMeasurement'] = [
    //Salwar Measurement Image Path
    'images_path' => $images_path . 'measurement/salwar-measurement/',
    // ----------
];

$constants['blouseDesign'] = [
    // Blouse Desgin Image Path
    'images_path' => $images_path . 'blouse-desgin/',
    // ----------
];

$constants['slider'] = [
    // Slider Image Path
    'images_path' => $images_path . 'slider/',
    // ----------
];
$constants['page'] = [
    // Page Image Path
    'images_path' => $images_path . 'page/',
    // ----------
];

$constants['testimonials'] = [
    // Testimonial Image Path
    'images_path' => $images_path . 'testimonials/original/',
    'thumb_images_path' => $thumb_image_path . 'testimonials/',
    'images_path_thumb' => $images_path . 'testimonials/',
    // ----------
];

$constants['homePage'] = [
    // Home Page Image Path
    'images_path' => $images_path . 'homepage/',
    'images_path_thumb' => $images_path . 'homepage/thumb/',
    // ----------
];
$constants['accountSetting'] = [
    // Account Setting Image Path
    'images_path' => $images_path . 'account-setting/',
    // ----------
];
$constants['homePageContent'] = [
    // Home Page Content Image Path
    'images_path'       => $images_path . 'homepage/',
    'thumb_images_path' => $thumb_image_path . 'homepage/thumb/',
    // ----------
];
$constants['products'] = [

    // Product image path
    'images_path'       => $images_path . 'product/product_image/',
    'thumb_images_path' => $images_path . 'product/product_image/thumb/',
    'images_path_thumb' => $images_path . 'product/product_image/thumb/',
    // ------------------

    // Product Zip Path
    'zip_path'         => $zip_path . 'product/',
    // ---------------
    // Home Page Content Image Path
    'images_path' => $images_path . 'product/product_image/',
    'imageszoom_path'     => $images_path . 'product/product_imagezoom/',
    // ----------
];
$constants['productExcel'] = [

    //  Product Excel
    'download_path'   => $download_path . 'product-excel/',
    //  -------------

];
return $constants;
