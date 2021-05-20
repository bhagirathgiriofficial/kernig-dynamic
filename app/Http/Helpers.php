<?php

use App\Notification;
use Illuminate\Support\Facades\Crypt;
use App\Model\Country\Country;
use App\Model\AccountSetting\AccountSetting;
use App\Model\Category\Category;
use App\Model\Slider\Slider;
use App\Model\HomePage\HomePage;
use App\Model\Product\Product;
use App\Model\Product\ProductOrder;
use App\Model\Testimonial\Testimonial;
use App\Model\Master_Page\Master_Page;
use App\Model\Transaction\Transaction;
use App\Model\User\UserWhishList;
use App\Model\Coupon\Coupon;
use App\Model\Product\ProductCart;
use App\Model\Accessories\Accessories;
use App\Model\Color\Color;
use App\Model\Fabric\Fabric;
use App\Model\Occasion\Occasion;
use App\Model\Size\Size;
use App\Model\Shipping\Shipping;
use App\Model\Measurement\SareeMeasurement;
use App\Model\Measurement\SalwarMeasurement;
use App\Model\Measurement\Measurement;
use App\Model\Faq\Faq;

if (!function_exists('ev')) {
    /**
     * Encrypt the given value.
     *
     * @param  string  $value
     * @return string
     */
    function ev($value)
    {
        return encrypt($value);
    }
}

if (!function_exists('dv')) {
    /**
     * Decrypt the given value.
     *
     * @param  string  $value
     * @return string
     */
    function dv($value)
    {
        $decrypted_value = null;

        try {
            $decrypted_value = decrypt($value);
        } catch (\Exception $e) {
            abort(404);
        }

        return $decrypted_value;
    }
}

if (!function_exists('get_image_url')) {
    /**
     * Get image url.
     *
     * @param  string  $value
     * @return string  $url
     *
     * @author Sumit
     * @created_at 19 July 2019
     */
    function get_image_url($path, $name)
    {
        // File system
        $file_system = config('filesystems.default');
        //------------
        if (!is_null($name) && Storage::disk($file_system)->exists($path . $name)) {
            return url('/public') . Storage::disk($file_system)->url($path . $name);
        } else {
            return null;
        }
    }
}



if (!function_exists('delete_image')) {
    /**
     * Delete image.
     *
     * @param  string  $value
     * @return boolean
     *
     * @author Sumit
     * @created_at 19 July 2019
     */
    function delete_image($path, $name)
    {
        // File system
        $file_system = config('filesystems.default');
        //------------

        if (Storage::disk($file_system)->exists($path . $name)) {
            return Storage::disk($file_system)->delete($path . $name);
        } else {
            return false;
        }
    }
}


if (!function_exists('show_user_image')) {
    /**
     * Delete image.
     *
     * @param  string  $value
     * @return boolean
     *
     * @author Sumit
     * @created_at 19 July 2019
     */
    function show_user_image($image = null, $name = null)
    {
        $url = get_image_url(config('constants.adminUsers.images_path'), $image);

        if (!is_null($url)) {
            $image = '<img src="' . $url . '" />';
        } else {
            $image = '<img src="' . Avatar::create($name)->toBase64() . '"/>';
        }

        return $image;
    }
}

if (!function_exists('create_select_options')) {
    /**
     * Create select option.
     *
     * @param  mixed  $data, $value, $key, $default
     * @return array
     *
     * @author Sumit
     * @created_at 22 July 2019
     */
    function create_select_options($data, $value, $key = null, $default = null)
    {
        $options = [];
        // Create options
        if ($data instanceof Illuminate\Database\Eloquent\Collection) {
            $options = array_column($data->toArray(), $value, $key);
        } else {
            $options = array_column($data, $value, $key);
        }
        //---------------

        // $options = array_prepend($options,"-- None --");


        // Set default option
        if (!is_null($default)) {
            $options = array_prepend($options, $default, '');
        }
        return $options;
    }
}

if (!function_exists('create_select_groups_options')) {
    /**
     * Create select groups option.
     *
     * @param  mixed  $data, $value, $key, $default
     * @return array
     *
     * @author Sumit
     * @created_at 22 July 2019
     */
    function create_select_groups_options($data, $child_column, $value, $key = null, $default = null)
    {
        $options = [];

        // Create options
        if ($data instanceof Illuminate\Database\Eloquent\Collection) {
            foreach ($data as $_value) {
                $options[$_value[$value]] = array_column($_value[$child_column]->toArray(), $value, $key);
            }
        } else {
            foreach ($data as $_value) {
                $options[$_value[$value]] = array_column($_value[$child_column], $value, $key);
            }
        }
        //---------------

        // Set default option
        if (!is_null($default)) {
            $options = array_prepend($options, $default, '');
        }
        //-------------------

        return $options;
    }
}

/**
 * Short function for print data
 *
 * @param Array or Object or string
 * @return formatted array or object
 *
 * @author Pratyush Bharti
 * @created_at 24 July 2019
 */
function p($p, $exit = 1)
{
    echo '<pre>';
    print_r($p);
    echo '</pre>';
    if ($exit == 1) {
        exit;
    }
}

/**
 * Short function for print data
 *
 * @param Integer
 * @return lastPage
 *
 * @author Pratyush Bharti
 * @created_at 24 July 2019
 */
function records_last_page($count)
{
    if ($count) {
        return ceil($count / config('constants.pagination_limit'));
    } else {
        return 1;
    }
}

if (!function_exists('hours_to_minutes')) {
    /**
     * Transform hours like "1:45" into the total number of minutes, "105".
     *
     * @param  $hours
     * @return $minutes
     *
     * @author Sumit
     * @created_at 08 Aug 2019
     */
    function hours_to_minutes($hours)
    {
        $minutes = 0;
        if (strpos($hours, ':') !== false) {
            // Split hours and minutes.
            list($hours, $minutes) = explode(':', $hours);
        }
        return $hours * 60 + $minutes;
    }
}

if (!function_exists('minutes_to_hours')) {
    /**
     * Transform hours like "1:45" into the total number of minutes, "105".
     *
     * @param  $minutes
     * @return $time
     *
     * @author Sumit
     * @created_at 08 Aug 2019
     */
    function minutes_to_hours($minutes)
    {
        $hours = (int)($minutes / 60);
        $minutes -= $hours * 60;
        return sprintf("%d:%02.0f", $hours, $minutes);
    }
}

if (!function_exists('push_notification')) {
    /**
     * push notification
     *
     * @author Khushbu
     * @created_at 27 Dec 2019
     */
    function push_notification($paper_id = null, $message, $fcm_token, $title = null, $notification_type = null, $user_id = null, $image = null, $link = null, $platform)
    {

        $data = json_encode(array(
            'title'                 => $title,
            'description'           => $message,
            'notification_type_id'  => $notification_type,
            'user_id'               => $user_id,
            'image'                 => $image,
            'link'                  => $link,
        ), true);

        if ($platform == "ANDROID") {
            $res = PushNotification::setService('fcm')
                ->setMessage([
                    'data' => [
                        'title'                 => $title,
                        'description'           => $message,
                        'notification_type_id'  => $notification_type,
                        'user_id'               => $user_id,
                        'image'                 => $image,
                        'link'                  => $link,
                    ],
                ])
                ->setApiKey('AAAAXD2UR7Q:APA91bFGewFf3L7Bn691hec8UkAwzC9k-3ri8tqdlwa9qpOXCguodCpylThM7g28wEpVTqJEDqVFSvSdmGPeWZLbvDMBORI6UJQraKCJwitymmmu1ZpHTEmTAexXTO-SgsLZrUNidBcn')
                ->setDevicesToken($fcm_token)
                ->send()
                ->getFeedback();

            // Save Notification
            $notification = new Notification();
            $notification->title                = $title;
            $notification->description          = $message;
            $notification->notification_type_id = $notification_type;
            $notification->user_id              = $user_id;
            $notification->image                = $image;
            $notification->link                 = $link;
            $notification->save();
            //------------------

        } else {
            $res = PushNotification::setService('fcm')
                ->setMessage([
                    'notification' => [
                        'title'                 => $title,
                        'description'           => $message,
                        'notification_type_id'  => $notification_type,
                        'user_id'               => $user_id,
                        'image'                 => $image,
                        'link'                  => $link,
                    ],
                    'data' => [
                        'data' => $data,
                    ],
                ])
                ->setApiKey('AAAAXD2UR7Q:APA91bFGewFf3L7Bn691hec8UkAwzC9k-3ri8tqdlwa9qpOXCguodCpylThM7g28wEpVTqJEDqVFSvSdmGPeWZLbvDMBORI6UJQraKCJwitymmmu1ZpHTEmTAexXTO-SgsLZrUNidBcn')
                ->setDevicesToken($fcm_token)
                ->send()
                ->getFeedback();

            // Save Notification
            $notification = new Notification();
            $notification->title                = $title;
            $notification->description          = $message;
            $notification->notification_type_id = $notification_type_id;
            $notification->user_id              = $user_id;
            $notification->image                = $image;
            $notification->link                 = $link;
            $notification->save();
            //------------------
        }

        return $res;
    }
}

if (!function_exists('show_video_course_image')) {
    /**
     * Show image.
     *
     * @param  string  $value
     * @return boolean
     *
     * @author Khushbu
     * @created_at 09 Jan 2020
     */
    function show_video_course_image($image = null, $name = null)
    {
        $url = get_image_url(config('constants.video-course.image_path'), $image);

        if (!is_null($url)) {
            $image = '<img class="img-fluid" src="' . $url . '" />';
        } else {
            $image = '<img class="img-fluid" src="' . Avatar::create($name)->toBase64() . '"/>';
        }

        return $image;
    }
}

/**
 *  Get encrypted value
 * */
function get_encrypted_value($key, $encrypt = false)
{

    $encrypted_key = null;
    if (!empty($key)) {
        if ($encrypt == true) {
            $key = Crypt::encrypt($key);
        }
        $encrypted_key = $key;
    }
    return $encrypted_key;
}

/**
 *  Get decrypted value
 * */
function get_decrypted_value($key, $decrypt = false)
{
    $decrypted_key = null;
    if (!empty($key)) {
        if ($decrypt == true) {
            $key = Crypt::decrypt($key);
        }
        $decrypted_key = $key;
    }
    return $decrypted_key;
}


/**
 *  Add default blank option to select box
 * */
function add_blank_option($arr, $option)
{
    $arr_option = array();
    if (!empty($option)) {
        $arr_option[''] = $option;
    } else {
        $arr_option[''] = '';
    }
    // operator on array
    $result = $arr_option + $arr;
    return $result;
}


/**
 * get country list
 * Bhagirath
 * */
function getCountryList()
{
    $arrCountry    = [];
    $arrCountry    = Country::where('country_status', 1)->orderBy('country_name', 'ASC')->get();
    return $arrCountry;
}


/**
 * get account setting list
 * Bhagirath
 * */
function accountSettingData()
{
    $arrAccount    = [];
    $arrAccount    = AccountSetting::first();
    return $arrAccount;
}

/**
 * get categories list
 * Bhagirath
 * */
function catgeoriesData()
{
    $arrCategory    = [];
    $arrCategory    = Category::with(['subCategories' => function ($q) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        $q->orderBy('category_order', 'DESC');
        $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description');
        $q->with(['subSubCategories' => function ($q) {
            $q->where('category_status', 1);
            $q->orderBy('category_order', 'DESC');
            $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->orderBy('category_order', 'DESC')
        ->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description')
        ->get();
    return $arrCategory;
}


/**
 * get slider list
       @SB 4 march 2020
 * */
function sliderData()
{
    $arrSlider    = [];
    $arrSlider    = Slider::where('slider_status', 1)->get();
    return $arrSlider;
}

/**
 * get Home Page list
       @SB 4 march 2020
 * */
function homePageData()
{
    $arrHomePage    = [];
    $arrHomePage    = HomePage::get();
    return $arrHomePage;
}

/**
 * get Trending Products list
       @SB 4 march 2020
 * */
function trendingProductsData()
{
    $arrTrendingProducts    = [];

    $allCategory        = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        if ($subCategoryOne != '') {
            $q->where('category_slug', '=', $subCategoryOne);
        }
        $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            if ($categoryId != '') {
                $q->where('category_id', '=', $categoryId);
            }
        })
        ->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status')
        ->get();


    foreach ($allCategory as $mainCategorys) {
        $allCategoryData .= $mainCategorys['category_id'] . ',';
        foreach ($mainCategorys['subCategories'] as $allCategorys) {
            $allCategoryData .= $allCategorys['category_id'] . ',';
            foreach ($allCategorys['subSubCategories'] as $allSubCategorys) {
                $allCategoryData .= $allSubCategorys['category_id'] . ',';
            }
        }
    }

    $allCategoryData = substr($allCategoryData, 0, -1);
    $allCategorys    = explode(',', $allCategoryData);

    $arrTrendingProducts    = Product::with(['category' => function ($q) use ($allCategorys) {
        $q->join('categories', function ($join) use ($request) {
            $join->on('product_category.category_id', '=', 'categories.category_id');
        });
        $q->where('category_status', 1);
        $q->whereIn('categories.category_id', $allCategorys);
        $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id');
        $q->with(['parentCategory' => function ($q) {
            $q->where('category_status', 1);
            $q->orderBy('category_order', 'ASC');
            $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
        $q->with(['subCategory' => function ($q) {
            $q->where('category_status', 1);
            $q->orderBy('category_order', 'ASC');
            $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->WhereHas('category', function ($q) use ($allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            $q->where('category_status', 1);
            $q->whereIn('categories.category_id', $allCategorys);
            $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id');
            $q->with(['parentCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
            }]);
            $q->with(['subCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
            }]);
        })
        ->where('product_status', 1)
        ->where('out_of_stock', 2)
        ->where('hot_seller', 3)
        ->orderBy('updated_at', 'DESC')
        ->select('product_id', 'product_code', 'product_name', 'product_slug', 'hot_seller', 'product_image', 'product_image_small', 'product_price', 'product_discounted_price', 'product_status', 'out_of_stock')
        ->paginate(25);
    return $arrTrendingProducts;
}


/**
 * get Testimonial list
       @SB 4 march 2020
 * */
function testimonialData($testimonialHomePage = false)
{
    $arrTestimonial    = [];
    $arrTestimonial    = Testimonial::where('testimonial_status', 1)
        ->where(function ($q) use ($testimonialHomePage) {
            if ($testimonialHomePage != '') {
                $q->where('testimonial_homepage', 1);
            }
        })
        ->orderBy('testimonial_order', 'ASC')->orderBy('testimonial_id', 'DESC')
        ->paginate(25);
    return $arrTestimonial;
}


/**
 * get main categories list
 * Bhagirath
 * */
function mainCategoryData($categoryId)
{
    $arrCategory    = [];
    $arrCategory    = Category::where(function ($q) use ($categoryId) {
        if ($categoryId != '') {
            $q->where('category_root_id', $categoryId);
        }
    })
        ->where('category_subroot_id', '=', 0)
        ->where('category_status', 1)
        ->orderBy('category_order', 'ASC')
        ->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description')
        ->get();
    return $arrCategory;
}


/**
 * get Master Page Data
       @SB 4 march 2020
 * */
function masterPageData($pageId = false)
{
    $arrMasterPage    = [];
    $arrMasterPage    = Master_Page::where('page_status', 1)
        ->where(function ($q) use ($pageId) {
            if ($pageId != '') {
                $q->where('page_id', $pageId);
            }
        })
        ->first();
    return $arrMasterPage;
}


/**
 * get main categories data
 * Bhagirath
 * */
function masterCategoryData($categoryId, $subCategoryOne = false, $subCategoryTwo = false)
{
    $arrCategory    = [];
    $arrCategory    = Category::where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        if ($subCategoryOne == '' && $subCategoryTwo == '') {
            $q->where('category_id', $categoryId);
        } else if ($subCategoryOne != '' && $subCategoryTwo != '') {
            $q->where('category_slug', $subCategoryTwo);
        } else {
            $q->where('category_slug', $subCategoryOne);
        }
    })
        ->where('category_status', 1)
        ->orderBy('category_order', 'ASC')
        ->select('category_id', 'category_name', 'category_slug', 'category_heading', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_desc', 'category_meta_title', 'category_meta_keywords', 'category_meta_description')
        ->first();
    return $arrCategory;
}




/**
 *  Function name : Product Filter
 *  Get category , color , fabric name etc.
 * Bhagirath
 **/

function productFilters($productType = false, $categoryId = false, $subCategoryOne = false, $subCategoryTwo = false, $request = false)
{
    $arrColors      = [];
    $arrCategories  = [];
    $arrFabrics     = [];
    $arrOccasions   = [];
    $arrSizes       = [];

    if ($subCategoryOne != '') {
        $category       = Category::where('category_slug', $subCategoryOne)->first();
        $subCategory    = Category::where('category_subroot_id', $category->category_id)->count();
    }

    $allCategory        = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        if ($subCategoryOne != '') {
            $q->where('category_slug', '=', $subCategoryOne);
        }
        $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            if ($categoryId != '') {
                $q->where('category_id', '=', $categoryId);
            }
        })
        ->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status')
        ->get();
    foreach ($allCategory as $mainCategorys) {
        $allCategoryData .= $mainCategorys['category_id'] . ',';
        foreach ($mainCategorys['subCategories'] as $allCategorys) {
            $allCategoryData .= $allCategorys['category_id'] . ',';
            foreach ($allCategorys['subSubCategories'] as $allSubCategorys) {
                $allCategoryData .= $allSubCategorys['category_id'] . ',';
            }
        }
    }

    $allCategoryData = substr($allCategoryData, 0, -1);
    $allCategorys    = explode(',', $allCategoryData);

    $product        = Product::select(
        'products.product_id',
        'products.product_code',
        'products.product_name',
        'products.product_slug',
        'products.hot_seller',
        'products.product_price',
        'products.product_discounted_price',
        'products.product_image',
        'products.product_image_small',
        'products.product_status',
        DB::raw('(SELECT max(product_price) FROM products) as maxProductPrice')
    )
        ->with(['category' => function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->orderBy('category_order', 'ASC');
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);
            $q->with(['parentCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
            }]);
            $q->with(['subCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
            }]);
            $q->where('category_status', 1);
        }])
        ->WhereHas('category', function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->where('category_status', 1);
            $q->whereIn('categories.category_id', $allCategorys);
        })
        ->with(['color' => function ($q) use ($colorName) {
            $q->join('colors', function ($join) use ($request) {
                $join->on('product_color.color_id', '=', 'colors.color_id');
            });
            $q->where('color_status', 1);
            $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
        }])
        // Fabric
        ->with(['fabric' => function ($q) use ($fabricName) {
            $q->join('fabrics', function ($join) use ($request) {
                $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
            });
            $q->where('fabric_status', 1);
            $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
        }])
        // Occasions
        ->with(['occasion' => function ($q) use ($occasionName) {
            $q->join('occasions', function ($join) use ($request) {
                $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
            });
            $q->where('occasion_status', 1);
            $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
        }])
        // Size
        ->with(['size' => function ($q) use ($filterSize) {
            $q->join('sizes', function ($join) use ($request) {
                $join->on('product_size.size_id', '=', 'sizes.size_id');
            });
            $q->where('size_status', 1);
            $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
        }])
        ->where(function ($q) use ($productType, $request) {
            if ($productType == 1) {
                $q->where('hot_seller', 1);
            }
            if ($productType == 2) {
                $q->where('hot_seller', 2);
            }
            if ($productType == 3) {
                $q->where('hot_seller', 3);
            }

            if ($request['result'] != '') {
                $serachData = explode(" ", $_REQUEST['result']);
                $q->where('product_code', 'LIKE', '%' . $_REQUEST['result'] . '%');
                $q->orWhere('product_price', 'LIKE', '%' . $_REQUEST['result'] . '%');
                $q->orWhere('product_discount_percent', 'LIKE', '%' . $_REQUEST['result'] . '%');
                foreach ($serachData as $data) {
                    $q->orWhere('product_name', 'LIKE', '%' . $data . '%');
                    $q->orWhere('product_description', 'LIKE', '%' . $data . '%');
                }
            }
        })
        ->where('product_status', 1)
        ->where('out_of_stock', 2)
        ->orderBy('product_id', 'DESC')
        ->get()->toArray();

    foreach ($product as $products) {
        if ($products['product_price'] > $productPrice) {
            $productPrice = $products['product_price'];
        }

        if ($products['product_discounted_price'] != 0.00) {
            $disPrice = 100 - round($products['product_discounted_price'] * 100 / $products['product_price'], 2);

            if ($discountPrice < $disPrice) {
                $lessPrice     = $disPrice;
                $discountPrice = 100 - round($products['product_discounted_price'] * 100 / $products['product_price'], 2);
            }
        }

        foreach ($products['category'] as $categories) {
            $arrCategories[] = array(
                'category_id'          => $categories['category_id'],
                'category_name'        => $categories['category_name'],
                'category_slug'        => $categories['category_slug'],
                'category_order'       => $categories['category_order'],
                'parent_category'      => $categories['parent_category'],
                'sub_category'         => $categories['sub_category'],
            );
        }

        foreach ($products['color'] as $colors) {
            $arrColors[] = array(
                'color_id'          => $colors['color_id'],
                'color_name'        => $colors['color_name'],
                'color_slug'        => $colors['color_slug'],
                'color_code'        => $colors['color_code'],
            );
        }

        foreach ($products['fabric'] as $fabrics) {
            $arrFabrics[] = array(
                'fabric_id'          => $fabrics['fabric_id'],
                'fabric_name'        => $fabrics['fabric_name'],
                'fabric_slug'        => $fabrics['fabric_slug'],
            );
        }

        foreach ($products['occasion'] as $occasions) {
            $arrOccasions[] = array(
                'occasion_id'          => $occasions['occasion_id'],
                'occasion_name'        => $occasions['occasion_name'],
                'occasion_slug'        => $occasions['occasion_slug'],
            );
        }

        foreach ($products['size'] as $sizes) {
            $arrSizes[] = array(
                'size_id'             => $sizes['size_id'],
                'size_measure'        => $sizes['size_measure'],
            );
        }
    }

    $arrColors      = array_map("unserialize", array_unique(array_map("serialize", $arrColors)));
    $arrCategories  = array_map("unserialize", array_unique(array_map("serialize", $arrCategories)));
    $arrFabrics     = array_map("unserialize", array_unique(array_map("serialize", $arrFabrics)));
    $arrOccasions   = array_map("unserialize", array_unique(array_map("serialize", $arrOccasions)));
    $arrSizes       = array_map("unserialize", array_unique(array_map("serialize", $arrSizes)));

    usort($arrColors, function ($item1, $item2) {
        return $item1['color_name'] <=> $item2['color_name'];
    });

    usort($arrCategories, function ($item1, $item2) {
        return $item1['category_order'] <=> $item2['category_order'];
    });

    usort($arrFabrics, function ($item1, $item2) {
        return $item1['fabric_name'] <=> $item2['fabric_name'];
    });

    usort($arrOccasions, function ($item1, $item2) {
        return $item1['occasion_name'] <=> $item2['occasion_name'];
    });

    usort($arrSizes, function ($item1, $item2) {
        return $item1['size_measure'] <=> $item2['size_measure'];
    });

    $startPrice      = 0;
    $endPrice        = $productPrice;
    $finalPrice      = array();
    $plusPrice       = 100;

    // For Price
    for ($i = $startPrice; $i < $endPrice;)  //for loop
    {
        $firstPrice         = $i;
        $i                  = $i + $plusPrice;
        $lastPrice          = $i;
        $priceSlotKey       = $firstPrice . "-" . $lastPrice;
        $priceSlotValue     = '$ ' . $firstPrice . " to $ " . $lastPrice;
        $priceSlots         = ['key' => $priceSlotKey, 'value' => $priceSlotValue];
        array_push($finalPrice, $priceSlots); //add slot to array
    }


    // For Discount Price
    $startDiscountPrice      = 0;
    $endDiscountPrice        = $discountPrice;
    $finalDiscountPrice      = array();
    $plusDiscountPrice       = 10;

    for ($i = $startDiscountPrice; $i < $endDiscountPrice;)  //for loop
    {
        $firstDiscountPrice         = $i;
        $i                          = $i + $plusDiscountPrice;
        $lastDiscountPrice          = $i;
        $priceDiscountSlotKey       = $firstDiscountPrice . "-" . $lastDiscountPrice;
        $priceDiscountSlotValue     = $firstDiscountPrice . "-" . $lastDiscountPrice . "%";
        $priceDiscountSlots         = ['key' => $priceDiscountSlotKey, 'value' => $priceDiscountSlotValue];
        array_push($finalDiscountPrice, $priceDiscountSlots); //add slot to array
    }

    $produtFilterData['finalPrice']         = $finalPrice;
    $produtFilterData['discountPrice']      = $finalDiscountPrice;
    $produtFilterData['arrColors']          = $arrColors;
    $produtFilterData['arrCategories']      = $arrCategories;
    $produtFilterData['arrFabrics']         = $arrFabrics;
    $produtFilterData['arrOccasions']       = $arrOccasions;
    $produtFilterData['arrSizes']           = $arrSizes;

    return $produtFilterData;
}


/**
 *  Function name : All Products
 *  Get all products
 * Bhagirath
 **/

function productAll($productType = false, $categoryId = false, $subCategoryOne = false, $subCategoryTwo = false, $request = false, $filterData = false, $masterCategoryData = false)
{
    $arrProducts     = [];

    if ($filterData != '') {

        $filtercheckData    = explode('_', $filterData);
        $colorCheck         = Color::whereIn('color_slug', $filtercheckData)->where('color_status', 1)->count();
        $fabricCheck        = Fabric::whereIn('fabric_slug', $filtercheckData)->where('fabric_status', 1)->count();
        $occasionCheck      = Occasion::whereIn('occasion_slug', $filtercheckData)->where('occasion_status', 1)->count();
        $sizeCheck          = Size::whereIn('size_measure', $filtercheckData)->where('size_measure', '!=', 0)->where('size_status', 1)->count();
    }

    if ($subCategoryOne != '') {
        $category       = Category::where('category_slug', $subCategoryOne)->first();
        $subCategory    = Category::where('category_subroot_id', $category->category_id)->count();
    }

    $allCategory        = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        if ($subCategoryOne != '') {
            $q->where('category_slug', '=', $subCategoryOne);
        }
        $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            if ($categoryId != '') {
                $q->where('category_id', '=', $categoryId);
            }
        })
        ->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status')
        ->get();
    foreach ($allCategory as $mainCategorys) {
        $allCategoryData .= $mainCategorys['category_id'] . ',';
        foreach ($mainCategorys['subCategories'] as $allCategorys) {
            $allCategoryData .= $allCategorys['category_id'] . ',';
            foreach ($allCategorys['subSubCategories'] as $allSubCategorys) {
                $allCategoryData .= $allSubCategorys['category_id'] . ',';
            }
        }
    }

    $allCategoryData = substr($allCategoryData, 0, -1);
    $allCategorys    = explode(',', $allCategoryData);

    $products        = Product::select(
        'products.product_id',
        'products.product_code',
        'products.product_name',
        'products.product_slug',
        'products.hot_seller',
        'products.measurement_id',
        'products.product_price',
        'products.product_discounted_price',
        'products.product_categories',
        'products.product_colors',
        'products.product_fabrics',
        'products.product_occasions',
        'products.product_sizes',
        'products.product_accessories',
        'products.product_weight',
        'products.product_timetoship',
        'products.product_description',
        'products.product_notes',
        'products.product_views',
        'products.product_image',
        'products.product_image_small',
        'products.product_status',
        'products.out_of_stock',
        DB::raw('(SELECT avg(user_rating) FROM product_reviews where product_id = products.product_id and review_status = 2) as productRating')
    )
        ->with(['getImages' => function ($q) {
            $q->where('image_status', 1);
            $q->orderBy('image_order', 'ASC');
        }])
        ->with(['category' => function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);

            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        }])
        ->WhereHas('category', function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);
            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        })
        ->where('product_status', 1)

        ->with(['color' => function ($q) use ($filterData) {
            $q->join('colors', function ($join) use ($request) {
                $join->on('product_color.color_id', '=', 'colors.color_id');
            });

            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('color_slug', $filterData);
            }
            $q->where('color_status', 1);
            $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
        }])
        // Fabric
        ->with(['fabric' => function ($q) use ($filterData) {
            $q->join('fabrics', function ($join) use ($request) {
                $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
            });
            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('fabric_slug', $filterData);
            }
            $q->where('fabric_status', 1);
            $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
        }])
        // Occasions
        ->with(['occasion' => function ($q) use ($filterData) {
            $q->join('occasions', function ($join) use ($request) {
                $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
            });
            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('occasion_slug', $filterData);
            }
            $q->where('occasion_status', 1);
            $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
        }])
        // Size
        ->with(['size' => function ($q) use ($filterData) {
            $q->join('sizes', function ($join) use ($request) {
                $join->on('product_size.size_id', '=', 'sizes.size_id');
            });
            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('size_measure', $filterData);
            }
            $q->where('size_status', 1);
            $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
        }])
        ->where(function ($queryHas) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {

            if (!empty($filterData)) {
                $filterData      = explode('_', $filterData);

                if ($colorCheck != 0) {
                    $queryHas->whereHas('color', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('colors', function ($join) use ($request) {
                            $join->on('product_color.color_id', '=', 'colors.color_id');
                        });
                        $q->whereIn('color_slug', $filterData);
                        $q->where('color_status', 1);
                        $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
                    });
                }

                if ($fabricCheck != 0) {
                    $queryHas->whereHas('fabric', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('fabrics', function ($join) use ($request) {
                            $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
                        });
                        $q->whereIn('fabric_slug', $filterData);
                        $q->where('fabric_status', 1);
                        $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
                    });
                }

                if ($occasionCheck != 0) {
                    $queryHas->whereHas('occasion', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('occasions', function ($join) use ($request) {
                            $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
                        });
                        $q->whereIn('occasion_slug', $filterData);
                        $q->where('occasion_status', 1);
                        $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
                    });
                }

                if ($sizeCheck != 0) {
                    $queryHas->whereHas('size', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('sizes', function ($join) use ($request) {
                            $join->on('product_size.size_id', '=', 'sizes.size_id');
                        });
                        $q->whereIn('size_measure', $filterData);
                        $q->where('size_status', 1);
                        $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
                    });
                }
            }
        })
        ->where(function ($q) use ($productType, $sortBy, $request) {
            if ($productType == 1) {
                $q->where('hot_seller', 1);
            }
            if ($productType == 2) {
                $q->where('hot_seller', 2);
            }
            if ($productType == 3) {
                $q->where('hot_seller', 3);
            }

            if ($request['price'] != '') {
                $filterPricess = explode('-', $request['price']);
                $whereNetPrice = '(product_price >= ' . $filterPricess[0] . ' AND product_price <= ' . $filterPricess[1] . ')';
                $q->whereRaw('(' . $whereNetPrice . ')');
            }

            if ($request['discount_price'] != '') {

                $filterDiscount = explode('_', $request['discount_price']);
                if ($filterDiscount != '') {
                    $i = 0;
                    foreach ($filterDiscount as $filterDiscounts) {
                        $i++;
                        $filterDiscountss = explode('-', $filterDiscounts);
                        if ($i == 1) {
                            $whereDiscountPrice = '(product_discount_percent >= ' . $filterDiscountss[0] . ' AND product_discount_percent <= ' . $filterDiscountss[1] . ')';
                        } else {
                            $whereDiscountPrice .= 'OR (product_discount_percent >= ' . $filterDiscountss[0] . ' AND product_discount_percent <= ' . $filterDiscountss[1] . ')';
                        }
                    }
                    $q->whereRaw('(' . $whereDiscountPrice . ')');
                }
            }

            if ($request['result'] != '') {
                $serachData = explode(" ", $_REQUEST['result']);
                $q->where('product_code', 'LIKE', '%' . $_REQUEST['result'] . '%');
                $q->orWhere('product_price', 'LIKE', '%' . $_REQUEST['result'] . '%');
                $q->orWhere('product_discount_percent', 'LIKE', '%' . $_REQUEST['result'] . '%');
                foreach ($serachData as $data) {
                    $q->orWhere('product_name', 'LIKE', '%' . $data . '%');
                    $q->orWhere('product_description', 'LIKE', '%' . $data . '%');
                }
            }
        });

    if ($request['sortby'] == 'sortby') {
        $products = $products->orderBy('product_order', 'ASC');
        $products = $products->orderBy('product_id', 'DESC');
    } else if ($request['sortby'] == 'pricelow') {
        $products = $products->orderBy('product_price', 'ASC');
    } else if ($request['sortby'] == 'pricehigh') {
        $products = $products->orderBy('product_price', 'DESC');
    } else if ($request['sortby'] == 'toprated') {
        $products = $products->orderBy('productRating', 'DESC');
    } else if ($request['sortby'] == 'mostviews') {
        $products = $products->orderBy('product_views', 'DESC');
    } else {
        $products = $products->orderBy('product_order', 'ASC');
        $products = $products->orderBy('product_id', 'DESC');
    };

    $products = $products->paginate(12);
    return $products;
}

/**
 *  Function name : All Products Previous Next
 *  Get all products Previous Next
 * Bhagirath
 **/

function productNextPrev($productType = false, $categoryId = false, $subCategoryOne = false, $subCategoryTwo = false, $request = false, $filterData = false, $masterCategoryData = false)
{
    $arrProducts     = [];

    if ($filterData != '') {

        $filtercheckData    = explode('_', $filterData);
        $colorCheck         = Color::whereIn('color_slug', $filtercheckData)->where('color_status', 1)->count();
        $fabricCheck        = Fabric::whereIn('fabric_slug', $filtercheckData)->where('fabric_status', 1)->count();
        $occasionCheck      = Occasion::whereIn('occasion_slug', $filtercheckData)->where('occasion_status', 1)->count();
        $sizeCheck          = Size::whereIn('size_measure', $filtercheckData)->where('size_measure', '!=', 0)->where('size_status', 1)->count();
    }

    if ($subCategoryOne != '') {
        $category       = Category::where('category_slug', $subCategoryOne)->first();
        $subCategory    = Category::where('category_subroot_id', $category->category_id)->count();
    }

    $allCategory        = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        if ($subCategoryOne != '') {
            $q->where('category_slug', '=', $subCategoryOne);
        }
        $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            if ($categoryId != '') {
                $q->where('category_id', '=', $categoryId);
            }
        })
        ->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status')
        ->get();
    foreach ($allCategory as $mainCategorys) {
        $allCategoryData .= $mainCategorys['category_id'] . ',';
        foreach ($mainCategorys['subCategories'] as $allCategorys) {
            $allCategoryData .= $allCategorys['category_id'] . ',';
            foreach ($allCategorys['subSubCategories'] as $allSubCategorys) {
                $allCategoryData .= $allSubCategorys['category_id'] . ',';
            }
        }
    }

    $allCategoryData = substr($allCategoryData, 0, -1);
    $allCategorys    = explode(',', $allCategoryData);

    $products        = Product::select(
        'products.product_id',
        'products.product_code',
        'products.product_name',
        'products.product_slug',
        'products.hot_seller',
        'products.measurement_id',
        'products.product_price',
        'products.product_discounted_price',
        'products.product_categories',
        'products.product_colors',
        'products.product_fabrics',
        'products.product_occasions',
        'products.product_sizes',
        'products.product_accessories',
        'products.product_weight',
        'products.product_timetoship',
        'products.product_description',
        'products.product_notes',
        'products.product_views',
        'products.product_image',
        'products.product_image_small',
        'products.product_status',
        'products.out_of_stock',
        DB::raw('(SELECT avg(user_rating) FROM product_reviews where product_id = products.product_id and review_status = 2) as productRating')
    )
        ->with(['getImages' => function ($q) {
            $q->where('image_status', 1);
            $q->orderBy('image_order', 'ASC');
        }])
        ->with(['category' => function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);

            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        }])
        ->WhereHas('category', function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);
            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        })
        ->where('product_status', 1)

        ->with(['color' => function ($q) use ($filterData) {
            $q->join('colors', function ($join) use ($request) {
                $join->on('product_color.color_id', '=', 'colors.color_id');
            });

            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('color_slug', $filterData);
            }
            $q->where('color_status', 1);
            $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
        }])
        // Fabric
        ->with(['fabric' => function ($q) use ($filterData) {
            $q->join('fabrics', function ($join) use ($request) {
                $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
            });
            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('fabric_slug', $filterData);
            }
            $q->where('fabric_status', 1);
            $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
        }])
        // Occasions
        ->with(['occasion' => function ($q) use ($filterData) {
            $q->join('occasions', function ($join) use ($request) {
                $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
            });
            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('occasion_slug', $filterData);
            }
            $q->where('occasion_status', 1);
            $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
        }])
        // Size
        ->with(['size' => function ($q) use ($filterData) {
            $q->join('sizes', function ($join) use ($request) {
                $join->on('product_size.size_id', '=', 'sizes.size_id');
            });
            if ($filterData != '') {
                $filterData      = explode('_', $filterData);
                $q->whereIn('size_measure', $filterData);
            }
            $q->where('size_status', 1);
            $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
        }])
        ->where(function ($queryHas) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {

            if (!empty($filterData)) {
                $filterData      = explode('_', $filterData);

                if ($colorCheck != 0) {
                    $queryHas->whereHas('color', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('colors', function ($join) use ($request) {
                            $join->on('product_color.color_id', '=', 'colors.color_id');
                        });
                        $q->whereIn('color_slug', $filterData);
                        $q->where('color_status', 1);
                        $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
                    });
                }

                if ($fabricCheck != 0) {
                    $queryHas->whereHas('fabric', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('fabrics', function ($join) use ($request) {
                            $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
                        });
                        $q->whereIn('fabric_slug', $filterData);
                        $q->where('fabric_status', 1);
                        $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
                    });
                }

                if ($occasionCheck != 0) {
                    $queryHas->whereHas('occasion', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('occasions', function ($join) use ($request) {
                            $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
                        });
                        $q->whereIn('occasion_slug', $filterData);
                        $q->where('occasion_status', 1);
                        $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
                    });
                }

                if ($sizeCheck != 0) {
                    $queryHas->whereHas('size', function ($q) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
                        $q->join('sizes', function ($join) use ($request) {
                            $join->on('product_size.size_id', '=', 'sizes.size_id');
                        });
                        $q->whereIn('size_measure', $filterData);
                        $q->where('size_status', 1);
                        $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
                    });
                }
            }
        })
        ->where(function ($q) use ($productType, $sortBy, $request) {
            if ($productType == 1) {
                $q->where('hot_seller', 1);
            }
            if ($productType == 2) {
                $q->where('hot_seller', 2);
            }
            if ($productType == 3) {
                $q->where('hot_seller', 3);
            }

            if ($request['price'] != '') {
                $filterPricess = explode('-', $request['price']);
                $whereNetPrice = '(product_price >= ' . $filterPricess[0] . ' AND product_price <= ' . $filterPricess[1] . ')';
                $q->whereRaw('(' . $whereNetPrice . ')');
            }

            if ($request['discount_price'] != '') {

                $filterDiscount = explode('_', $request['discount_price']);
                if ($filterDiscount != '') {
                    $i = 0;
                    foreach ($filterDiscount as $filterDiscounts) {
                        $i++;
                        $filterDiscountss = explode('-', $filterDiscounts);
                        if ($i == 1) {
                            $whereDiscountPrice = '(product_discount_percent >= ' . $filterDiscountss[0] . ' AND product_discount_percent <= ' . $filterDiscountss[1] . ')';
                        } else {
                            $whereDiscountPrice .= 'OR (product_discount_percent >= ' . $filterDiscountss[0] . ' AND product_discount_percent <= ' . $filterDiscountss[1] . ')';
                        }
                    }
                    $q->whereRaw('(' . $whereDiscountPrice . ')');
                }
            }

            if ($request['result'] != '') {
                $serachData = explode(" ", $_REQUEST['result']);
                $q->where('product_code', 'LIKE', '%' . $_REQUEST['result'] . '%');
                $q->orWhere('product_price', 'LIKE', '%' . $_REQUEST['result'] . '%');
                $q->orWhere('product_discount_percent', 'LIKE', '%' . $_REQUEST['result'] . '%');
                foreach ($serachData as $data) {
                    $q->orWhere('product_name', 'LIKE', '%' . $data . '%');
                    $q->orWhere('product_description', 'LIKE', '%' . $data . '%');
                }
            }
        });

    if ($request['sortby'] == 'sortby') {
        $products = $products->orderBy('product_id', 'DESC');
    } else if ($request['sortby'] == 'pricelow') {
        $products = $products->orderBy('product_price', 'ASC');
    } else if ($request['sortby'] == 'pricehigh') {
        $products = $products->orderBy('product_price', 'DESC');
    } else if ($request['sortby'] == 'toprated') {
        $products = $products->orderBy('productRating', 'DESC');
    } else if ($request['sortby'] == 'mostviews') {
        $products = $products->orderBy('product_views', 'DESC');
    } else {
        $products = $products->orderBy('product_id', 'DESC');
    };

    $products = $products->get();
    return $products;
}

function productDetails($productSlug = false, $productId = false, $categoryId = false, $subCategoryOne = false, $subCategoryTwo = false)
{

    if ($subCategoryOne != '') {
        $category       = Category::where('category_slug', $subCategoryOne)->first();
        $subCategory    = Category::where('category_subroot_id', $category->category_id)->count();
    }

    $compareString  = strcmp($productSlug, $subCategoryTwo);
    $productDetails = Product::with(['category' => function ($q) use ($request, $categoryId, $subCategoryTwo, $subCategoryOne, $category, $subCategory, $compareString) {
        $q->join('categories', function ($join) use ($request) {
            $join->on('product_category.category_id', '=', 'categories.category_id');
        });

        if ($categoryId != '') {
            $q->where('categories.category_root_id', '=', $categoryId);
        }

        if ($compareString != 0) {
            $q->where('categories.category_slug', '=', $subCategoryTwo);
        }
        if ($subCategoryOne != '') {
            if ($subCategory != 0) {
                $q->where('categories.category_subroot_id', '=', $category->category_id);
            } else {
                $q->where('product_category.category_id', '=', $category->category_id);
            }
        }

        $q->where('category_status', 1);
        $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'size_chart');
        $q->with(['parentCategory' => function ($q) {
            $q->where('category_status', 1);
            $q->orderBy('category_order', 'ASC');
            $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
        }]);
        $q->with(['subCategory' => function ($q) {
            $q->where('category_status', 1);
            $q->orderBy('category_order', 'ASC');
            $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
        }]);
    }])

        ->WhereHas('category', function ($q) use ($request, $categoryId, $subCategoryTwo, $subCategoryOne, $category, $subCategory, $compareString) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });

            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($compareString != 0) {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('product_category.category_id', '=', $category->category_id);
                }
            }

            $q->where('category_status', 1);
            $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'size_chart');
            $q->with(['parentCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
            }]);
            $q->with(['subCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
            }]);
        })

        ->with(['getImages' => function ($q) {
            $q->where('image_status', 1);
            $q->orderBy('image_order', 'ASC');
        }])

        ->with(['color' => function ($q) use ($colorName) {
            $q->join('colors', function ($join) use ($request) {
                $join->on('product_color.color_id', '=', 'colors.color_id');
            });
            $q->where('color_status', 1);
            $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
        }])

        // Size
        ->with(['size' => function ($q) use ($filterSize) {
            $q->join('sizes', function ($join) use ($request) {
                $join->on('product_size.size_id', '=', 'sizes.size_id');
            });
            $q->where('size_status', 1);
            $q->orderBy('size_measure', 'ASC');
            $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
        }])

        ->with(['fabric' => function ($q) use ($fabricName) {
            $q->join('fabrics', function ($join) use ($request) {
                $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
            });
            $q->where('fabric_status', 1);
            $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
        }])

        // Measurement
        ->with(['measurement' => function ($q) {
            $q->where('measurement_status', 1);
            $q->with(['details' => function ($q) {
                $q->where('details_status', 1);
            }]);
        }])

        // Occasions
        ->with(['occasion' => function ($q) use ($occasionName) {
            $q->join('occasions', function ($join) use ($request) {
                $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
            });
            $q->where('occasion_status', 1);
            $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name');
        }])

        // Accessories
        ->with(['accessory' => function ($q) use ($occasionName) {
            $q->join('accessories', function ($join) use ($request) {
                $join->on('product_accessories.accessory_id', '=', 'accessories.accessory_id');
            });
            $q->where('accessory_status', 1);
        }])

        // Product Reviews
        ->with(['productReviews' => function ($q) {
            $q->where('review_status', 2);
            $q->orderBy('product_review_id', 'DESC');
            $q->limit(5);
        }])

        // Product Reviews
        ->with(['productReviewsCount' => function ($q) {
            $q->where('review_status', 2);
            $q->orderBy('product_review_id', 'DESC');
        }])

        ->where(function ($q) use ($productSlug, $productId) {
            if ($productSlug != '') {
                $q->where('product_slug', $productSlug);
            }

            if ($productId != '') {
                $q->where('product_id', $productId);
            }
        })
        ->first();
    if ($productDetails['category'][0]->category_root_id != 0) {
        if ($productDetails['category'][0]['parentCategory'] == '') {
            $productDetails = [];
        }
    }

    if ($productDetails['category'][0]->category_subroot_id != 0) {
        if ($productDetails['category'][0]['subCategory'] == '') {
            $productDetails = [];
        }
    }
    return $productDetails;
}

function previousProduct($productType = false, $categoryId = false, $subCategoryOne = false, $subCategoryTwo = false, $request = false, $filterData = false, $masterCategoryData = false, $page = false)
{
    $arrProducts     = [];
    if ($subCategoryOne != '') {
        $category       = Category::where('category_slug', $subCategoryOne)->first();
        $subCategory    = Category::where('category_subroot_id', $category->category_id)->count();
    }

    $allCategory        = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        if ($subCategoryOne != '') {
            $q->where('category_slug', '=', $subCategoryOne);
        }
        $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            if ($categoryId != '') {
                $q->where('category_id', '=', $categoryId);
            }
        })
        ->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status')
        ->get();
    foreach ($allCategory as $mainCategorys) {
        $allCategoryData .= $mainCategorys['category_id'] . ',';
        foreach ($mainCategorys['subCategories'] as $allCategorys) {
            $allCategoryData .= $allCategorys['category_id'] . ',';
            foreach ($allCategorys['subSubCategories'] as $allSubCategorys) {
                $allCategoryData .= $allSubCategorys['category_id'] . ',';
            }
        }
    }

    $allCategoryData = substr($allCategoryData, 0, -1);
    $allCategorys    = explode(',', $allCategoryData);

    $products        = Product::select(
        'products.product_id',
        'products.product_code',
        'products.product_name',
        'products.product_slug',
        'products.hot_seller',
        'products.measurement_id',
        'products.product_price',
        'products.product_discounted_price',
        'products.product_categories',
        'products.product_colors',
        'products.product_fabrics',
        'products.product_occasions',
        'products.product_sizes',
        'products.product_accessories',
        'products.product_weight',
        'products.product_timetoship',
        'products.product_description',
        'products.product_notes',
        'products.product_views',
        'products.product_image',
        'products.product_image_small',
        'products.product_status',
        'products.out_of_stock',
        DB::raw('(SELECT avg(user_rating) FROM product_reviews where product_id = products.product_id and review_status = 2) as productRating')
    )
        ->with(['getImages' => function ($q) {
            $q->where('image_status', 1);
            $q->orderBy('image_order', 'ASC');
        }])
        ->with(['category' => function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);

            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        }])
        ->WhereHas('category', function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);
            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        })
        ->where('product_status', 1)

        ->with(['color' => function ($q) use ($filterData) {
            $q->join('colors', function ($join) use ($request) {
                $join->on('product_color.color_id', '=', 'colors.color_id');
            });
            $q->where('color_status', 1);
            $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
        }])
        // Fabric
        ->with(['fabric' => function ($q) use ($filterData) {
            $q->join('fabrics', function ($join) use ($request) {
                $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
            });
            $q->where('fabric_status', 1);
            $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
        }])
        // Occasions
        ->with(['occasion' => function ($q) use ($filterData) {
            $q->join('occasions', function ($join) use ($request) {
                $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
            });
            $q->where('occasion_status', 1);
            $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
        }])
        // Size
        ->with(['size' => function ($q) use ($filterData) {
            $q->join('sizes', function ($join) use ($request) {
                $join->on('product_size.size_id', '=', 'sizes.size_id');
            });
            $q->where('size_status', 1);
            $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
        }])
        ->where(function ($queryHas) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
        })
        ->where(function ($q) use ($productType, $sortBy, $request) {
            if ($productType == 1) {
                $q->where('hot_seller', 1);
            }
            if ($productType == 2) {
                $q->where('hot_seller', 2);
            }
            if ($productType == 3) {
                $q->where('hot_seller', 3);
            }
        });


    if ($page == 0) {
        $products = $products->orderBy('product_id', 'ASC');
        $start_prev = $page > 1 ? $page - 1 : 0;
    } else {
        $products = $products->orderBy('product_id', 'DESC');
        $start_prev = $page > 1 ? $page - 1 : 0;
    }

    $products = $products->offset($start_prev)->limit(1)->first();
    return $products;
}

function nextProduct($productType = false, $categoryId = false, $subCategoryOne = false, $subCategoryTwo = false, $request = false, $filterData = false, $masterCategoryData = false, $page = false, $tot_rec = false)
{
    $arrProducts     = [];
    if ($subCategoryOne != '') {
        $category       = Category::where('category_slug', $subCategoryOne)->first();
        $subCategory    = Category::where('category_subroot_id', $category->category_id)->count();
    }

    $allCategory        = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
        $q->where('category_status', 1);
        $q->where('category_subroot_id', '=', 0);
        if ($subCategoryOne != '') {
            $q->where('category_slug', '=', $subCategoryOne);
        }
        $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            if ($subCategoryTwo != '') {
                $q->where('category_slug', '=', $subCategoryTwo);
            }
            $q->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status');
        }]);
    }])
        ->where('category_root_id', '=', 0)
        ->where('category_status', 1)
        ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            if ($categoryId != '') {
                $q->where('category_id', '=', $categoryId);
            }
        })
        ->select('category_id', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status')
        ->get();
    foreach ($allCategory as $mainCategorys) {
        $allCategoryData .= $mainCategorys['category_id'] . ',';
        foreach ($mainCategorys['subCategories'] as $allCategorys) {
            $allCategoryData .= $allCategorys['category_id'] . ',';
            foreach ($allCategorys['subSubCategories'] as $allSubCategorys) {
                $allCategoryData .= $allSubCategorys['category_id'] . ',';
            }
        }
    }

    $allCategoryData = substr($allCategoryData, 0, -1);
    $allCategorys    = explode(',', $allCategoryData);

    $products        = Product::select(
        'products.product_id',
        'products.product_code',
        'products.product_name',
        'products.product_slug',
        'products.hot_seller',
        'products.measurement_id',
        'products.product_price',
        'products.product_discounted_price',
        'products.product_categories',
        'products.product_colors',
        'products.product_fabrics',
        'products.product_occasions',
        'products.product_sizes',
        'products.product_accessories',
        'products.product_weight',
        'products.product_timetoship',
        'products.product_description',
        'products.product_notes',
        'products.product_views',
        'products.product_image',
        'products.product_image_small',
        'products.product_status',
        'products.out_of_stock',
        DB::raw('(SELECT avg(user_rating) FROM product_reviews where product_id = products.product_id and review_status = 2) as productRating')
    )
        ->with(['getImages' => function ($q) {
            $q->where('image_status', 1);
            $q->orderBy('image_order', 'ASC');
        }])
        ->with(['category' => function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);

            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        }])
        ->WhereHas('category', function ($q) use ($productType, $categoryId, $subCategoryOne, $subCategoryTwo, $category, $subCategory, $allCategorys) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categoryId != '') {
                $q->where('categories.category_root_id', '=', $categoryId);
            }
            if ($subCategoryTwo != '') {
                $q->where('categories.category_slug', '=', $subCategoryTwo);
            }
            if ($subCategoryTwo == '' && $subCategoryOne != '') {
                if ($subCategory != 0) {
                    $q->where('categories.category_subroot_id', '=', $category->category_id);
                } else {
                    $q->where('categories.category_id', '=', $category->category_id);
                }
            }
            $q->whereIn('categories.category_id', $allCategorys);
            $q->select('product_category.id', 'product_category.product_id', 'categories.category_id', 'categories.category_name', 'categories.category_slug', 'categories.category_root_id', 'categories.category_subroot_id', 'categories.category_status', 'categories.size_chart', 'categories.category_desc', 'categories.category_order', 'categories.category_meta_title', 'categories.category_meta_keywords', 'categories.category_meta_description');
            $q->where('categories.category_status', 1);
        })
        ->where('product_status', 1)

        ->with(['color' => function ($q) use ($filterData) {
            $q->join('colors', function ($join) use ($request) {
                $join->on('product_color.color_id', '=', 'colors.color_id');
            });
            $q->where('color_status', 1);
            $q->select('product_color.product_id', 'product_color.color_id', 'color_name', 'color_slug', 'color_code');
        }])
        // Fabric
        ->with(['fabric' => function ($q) use ($filterData) {
            $q->join('fabrics', function ($join) use ($request) {
                $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
            });
            $q->where('fabric_status', 1);
            $q->select('product_fabric.product_id', 'product_fabric.fabric_id', 'fabric_name', 'fabric_slug');
        }])
        // Occasions
        ->with(['occasion' => function ($q) use ($filterData) {
            $q->join('occasions', function ($join) use ($request) {
                $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
            });
            $q->where('occasion_status', 1);
            $q->select('product_occasion.product_id', 'product_occasion.occasion_id', 'occasion_name', 'occasion_slug');
        }])
        // Size
        ->with(['size' => function ($q) use ($filterData) {
            $q->join('sizes', function ($join) use ($request) {
                $join->on('product_size.size_id', '=', 'sizes.size_id');
            });
            $q->where('size_status', 1);
            $q->select('product_size.product_id', 'product_size.size_id', 'size_measure');
        }])
        ->where(function ($queryHas) use ($request, $filterData, $colorCheck, $fabricCheck, $occasionCheck, $sizeCheck) {
        })
        ->where(function ($q) use ($productType, $sortBy, $request) {
            if ($productType == 1) {
                $q->where('hot_seller', 1);
            }
            if ($productType == 2) {
                $q->where('hot_seller', 2);
            }
            if ($productType == 3) {
                $q->where('hot_seller', 3);
            }
        });

    if ($page + 1 == $tot_rec) {
        $products = $products->orderBy('product_id', 'ASC');
        $next_pre = $page < $tot_rec - 1 ? $page + 1 : $tot_rec - 1;
    } else {
        $products = $products->orderBy('product_id', 'DESC');
        $next_pre = $page < $tot_rec - 1 ? $page + 1 : $tot_rec - 1;
    }

    $products = $products->offset($next_pre)->limit(1)->first();
    return $products;
}


/**
 * get Related Products list
       @SB 17 march 2020
 * */
function relatedProducts($productId = false, $categorySlug = false)
{
    $arrRelatedProducts    = [];
    $arrRelatedProducts    = Product::with(['category' => function ($q) use ($categorySlug) {
        $q->join('categories', function ($join) use ($request) {
            $join->on('product_category.category_id', '=', 'categories.category_id');
        });
        if ($categorySlug != '') {
            $q->where('category_slug', $categorySlug);
        }
        $q->where('category_status', 1);
        $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id');
    }])
        ->WhereHas('category', function ($q) use ($categorySlug) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });
            if ($categorySlug != '') {
                $q->where('category_slug', $categorySlug);
            }
            $q->where('category_status', 1);
            $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id');
        });
    if ($productId != '') {
        $arrRelatedProducts     = $arrRelatedProducts->where('product_id', '!=', $productId);
    }

    $arrRelatedProducts     = $arrRelatedProducts->where('product_status', 1)
        ->where('out_of_stock', 2)
        ->orderBy('product_id', 'DESC')
        ->select('product_id', 'product_code', 'product_name', 'product_slug', 'hot_seller', 'product_image_small', 'product_image', 'product_price', 'product_discounted_price', 'product_status', 'out_of_stock')
        ->paginate(4);
    return $arrRelatedProducts;
}


/**
 * get Check Wishlist list
       @SB 18 march 2020
 * */

function checkWishlist($userId, $productId)
{
    $wishlist  = UserWhishList::where(['user_id' => $userId, 'product_id' => $productId])->count();
    return $wishlist;
}

/**
 * get Coupon Data
       @SB 25 march 2020
 * */

function couponData($couponCode = false)
{

    $start_date = date('Y-m-d');
    $end_date   = date('Y-m-d');

    $couponData  = Coupon::where(function ($query) use ($request, $start_date, $end_date, $couponCode) {
        $query->where('coupon_status', "=", 1);
        if ($couponCode != '') {
            $query->where('coupon_code', '=', $couponCode);
        }
        $query->whereDate('start_date', '<=', $start_date);
        $query->whereDate('end_date', '>=', $end_date);
    })->get();
    return $couponData;
}

function couponDataCheck($couponCode = false)
{

    if (session('couponCode') != '') {
        $couponCode = session('couponCode');
    }
    $start_date = date('Y-m-d');
    $end_date   = date('Y-m-d');

    $couponData  = Coupon::where(function ($query) use ($request, $start_date, $end_date, $couponCode) {
        $query->where('coupon_status', "=", 1);
        if ($couponCode != '') {
            $query->where('coupon_code', '=', $couponCode);
        }
        $query->whereDate('start_date', '<=', $start_date);
        $query->whereDate('end_date', '>=', $end_date);
    })->get();
    return $couponData;
}

/**
 * get Coupon Data
       @SB 25 march 2020
 * */

function shippingCharges($countryId = false, $totalProductWeight = false)
{

    if ($countryId == '') {
        $shippingCharges = '0.00';
    } else {
        $shipping = Shipping::where('shipping_country_id', $countryId)->where('shipping_weight', $totalProductWeight)->first();
        if (count($shipping) != 0) {
            $shippingCharges = $shipping->shipping_price;
        } else {
            $shippingCharges = '0.00';
        }
    }

    return $shippingCharges;
}

/**
 * get Saree Measurement Data
       @SB 27 march 2020
 * */

function sareeMeasurement($sareeMeasurementId = false)
{

    $sareeMeasurement = SareeMeasurement::leftJoin('measurements', function ($join) {
        $join->on('saree_measurements.saree_custom_id', '=', 'measurements.measurement_id');
    })
        ->where(function ($query) use ($request, $sareeMeasurementId) {
            $query->where('saree_measurement_status', "=", 1);
            if ($sareeMeasurementId != '') {
                $sareeMeasurementId = explode(',', $sareeMeasurementId);
                $query->whereIn('saree_measurement_id', $sareeMeasurementId);
            }
        })
        ->get();
    return $sareeMeasurement;
}


/**
 * get Salwar Measurement Data
       @SB 30 march 2020
 * */

function salwarMeasurement($salwarMeasurementId = false)
{

    $salwarMeasurement = SalwarMeasurement::where(function ($query) use ($request, $salwarMeasurementId) {
        if ($salwarMeasurementId != '') {
            $query->where('salwar_measurement_id', '=', $salwarMeasurementId);
        }
    })->with('topMeasurement')->with('bottomMeasurement')->get();
    return $salwarMeasurement;
}


/**
 * Check Category Slug
       @SB 31 march 2020
 * */

function checkCategorySlug($categorySlug)
{
    $checkCategorySlug = Category::where('category_slug', $categorySlug)->count();
    return $checkCategorySlug;
}

/**
 * Check size Measure
       @SB 2 April 2020
 * */

function sizeMeasure($sizeId)
{
    $sizeMeasure = Size::where('size_id', $sizeId)->first();
    return $sizeMeasure;
}

/**
 * Check measurement
       @SB 3 April 2020
 * */

function measurement($measurementId)
{
    $measurement = Measurement::where('measurement_id', $measurementId)->first();
    return $measurement;
}


/* Order and its detail data of loggedin user */

function getOrderList($userId = false, $productOrderId = false, $orderNumber = false)
{
    $user_id            = $userId;
    $orderNumber        = $orderNumber;
    $product_order_id   = $productOrderId;
    $orderData          = [];

    $productOrder = ProductOrder::with(['productOrderDetail.product' => function ($q) {
        $q->with(['category' => function ($q) use ($request) {
            $q->join('categories', function ($join) use ($request) {
                $join->on('product_category.category_id', '=', 'categories.category_id');
            });

            $q->where('category_status', 1);
            $q->select('product_category.product_id', 'product_category.category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'size_chart');
            $q->with(['parentCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
            }]);
            $q->with(['subCategory' => function ($q) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_status', 'size_chart');
            }]);
        }]);
        $q->select('product_id', 'product_slug', 'product_status');
        $q->where('product_status', 1);
    }])
        ->where(function ($q) use ($orderNumber, $product_order_id, $user_id) {
            if (!empty($orderNumber)) {
                $q->where('order_number', $orderNumber);
            }
            if (!empty($product_order_id)) {
                $q->where('product_order_id', $product_order_id);
            }
            if (!empty($user_id)) {
                $q->where('user_id', $user_id);
            }
        })
        ->orderBy('product_order_id', 'DESC')
        ->get();
    return $productOrder;
}


/**
 * get categories Filter list
 * Bhagirath
 * */
function catgeoriesFilterData($categoryId = false, $subCategoryOne = false, $subCategoryTwo = false)
{
    $arrCategory    = [];
    if ($subCategoryTwo == '') {
        $arrCategory    = Category::with(['subCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
            $q->where('category_status', 1);
            $q->where('category_subroot_id', '=', 0);
            $q->orderBy('category_order', 'ASC');
            if ($subCategoryOne != '') {
                $q->where('category_slug', '=', $subCategoryOne);
            }
            $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description');
            $q->with(['subSubCategories' => function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
                $q->where('category_status', 1);
                $q->orderBy('category_order', 'ASC');
                $q->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description');
            }]);
        }])
            ->where('category_root_id', '=', 0)
            ->where('category_status', 1)

            ->where(function ($q) use ($categoryId, $subCategoryOne, $subCategoryTwo) {
                $q->orderBy('category_order', 'ASC');
                if ($categoryId != '') {
                    $q->where('category_id', '=', $categoryId);
                }
            })
            ->select('category_id', 'category_name', 'category_slug', 'category_root_id', 'category_subroot_id', 'category_order', 'category_status', 'category_meta_title', 'category_meta_keywords', 'category_meta_description')
            ->get();
    }
    return $arrCategory;
}

function checkCartProduct()
{
    $cart = session()->get('cart');

    foreach ($cart as $key => $value) {
        $product = productDetails('', $value['product_id']);
        if ($product->product_status == 0) {
            unset($cart[$value['product_id'] . '' . $value['product_size']]);
            session()->put('cart', $cart);
            userCartUpdate();
        }
    }
}


function checkRecentlyProduct()
{
    $recentlyViews = session()->get('recentlyViews');

    foreach ($recentlyViews as $key => $value) {
        $product = productDetails('', $value['product_id']);
        if ($product->product_status == 0) {
            unset($recentlyViews[$value['product_id']]);
            session()->put('recentlyViews', $recentlyViews);
        }
    }
}


function userCartUpdate()
{
    $resultData['userData']  = Auth::guard('frontend')->user();

    if ($resultData['userData']->id != '') {
        $productCart = ProductCart::where('user_id', $resultData['userData']->id)->first();
        if ($productCart == '') {
            $cart      = new ProductCart;
        } else {
            $cart      = ProductCart::find($productCart->product_cart_id);
        }

        $cart->user_id               = $resultData['userData']->id;
        $cart->cart                  = json_encode(session('cart'));
        $cart->assessories           = json_encode(session('assessories'));
        $cart->custom_measurment     = json_encode(session('custom_measurment'));
        $cart->saree_measurment      = json_encode(session('saree_measurment'));
        $cart->salwar_measurment     = json_encode(session('salwar_measurment'));
        $cart->save();
    }
}


function addToCart()
{
    $resultData['userData']     = Auth::guard('frontend')->user();
    $cartProduct                = ProductCart::where('user_id', $resultData['userData']->id)->first();
    $cart                       = session()->get('cart');
    $assessories                = session()->get('assessories');
    $custom_measurment          = session()->get('custom_measurment');
    $saree_measurment           = session()->get('saree_measurment');
    $salwar_measurment          = session()->get('salwar_measurment');
    $productCart                = json_decode($cartProduct->cart);
    $productAccessories         = json_decode($cartProduct->assessories);
    $productCustom              = json_decode($cartProduct->custom_measurment);
    $productSaree               = json_decode($cartProduct->saree_measurment);
    $productSalwar              = json_decode($cartProduct->salwar_measurment);

    foreach ($productCart as $key => $value) {
        $product = Product::find($value->product_id);
        if (!$product) {
        } else {
            // if cart is empty then this the first product
            if (!$cart) {
                $cart = [
                    $value->product_id . '' . $value->product_size => [
                        "product_id"                        => $value->product_id,
                        "product_name"                      => $product->product_name,
                        "product_size"                      => $value->product_size,
                        "product_quantity"                  => $value->product_quantity,
                        "product_price"                     => $product->product_price,
                        "product_discounted_price"          => $product->product_discounted_price,
                        "accessories"                       => $value->accessories,
                        "saree_measurment_price"            => $value->saree_measurment_price,
                        "salwar_kameez_measurement_price"   => $value->salwar_kameez_measurement_price,
                    ]
                ];
                session()->put('cart', $cart);
            }

            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$value->product_id . '' . $value->product_size])) {
                $totalQty = $cart[$value->product_id . '' . $value->product_size]['product_quantity'] + $value->product_quantity;
                if ($totalQty <= 5) {
                    $cart[$value->product_id . '' . $value->product_size]['product_quantity'] == $totalQty;
                    session()->put('cart', $cart);
                } else {
                    $cart[$value->product_id . '' . $value->product_size]['product_quantity'] = 5;
                    session()->put('cart', $cart);
                }
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$value->product_id . '' . $value->product_size] = [
                "product_id"                        => $value->product_id,
                "product_name"                      => $product->product_name,
                "product_size"                      => $value->product_size,
                "product_quantity"                  => $value->product_quantity,
                "product_price"                     => $product->product_price,
                "accessories"                       => $value->accessories,
                "product_discounted_price"          => $product->product_discounted_price,
                "saree_measurment_price"            => $value->saree_measurment_price,
                "salwar_kameez_measurement_price"   => $value->salwar_kameez_measurement_price,
            ];
            session()->put('cart', $cart);
        }
    }

    foreach ($productCustom as $key => $value) {
        $product = Product::find($value->product_id);
        if (!$product) {
        } else {
            if (!$custom_measurment) {
                $custom_measurment = [
                    $value->product_id => [
                        "product_id"                    => $value->product_id,
                        "measurement_in"                => $value->measurement_in,
                        "customMeasurement"             => $value->customMeasurement,
                        "other"                         => $value->other,
                    ]
                ];
                session()->put('custom_measurment', $custom_measurment);
            }

            $custom_measurment[$value->product_id] = [
                "product_id"                    => $value->product_id,
                "measurement_in"                => $value->measurement_in,
                "customMeasurement"             => $value->customMeasurement,
                "other"                         => $value->other,
            ];
            session()->put('custom_measurment', $custom_measurment);
        }
    }

    foreach ($productSaree as $key => $value) {
        $product = Product::find($value->product_id);
        if (!$product) {
        } else {
            if (!$saree_measurment) {
                $saree_measurment = [
                    $value->product_id . '' . $value->saree_measurement_id => [
                        "product_id"                    => $value->product_id,
                        "saree_measurement_id"          => $value->saree_measurement_id,
                        "measurement_in"                => $value->measurement_in,
                        "sareeMeasurement"              => $value->sareeMeasurement,
                        "other"                         => $value->other,
                    ]
                ];
                session()->put('saree_measurment', $saree_measurment);
            }

            $saree_measurment[$value->product_id . '' . $value->saree_measurement_id] = [
                "product_id"                    => $value->product_id,
                "saree_measurement_id"          => $value->saree_measurement_id,
                "measurement_in"                => $value->measurement_in,
                "sareeMeasurement"              => $value->sareeMeasurement,
                "other"                         => $value->other,
            ];
            session()->put('saree_measurment', $saree_measurment);
        }
    }

    foreach ($productSalwar as $key => $value) {
        $product = Product::find($value->product_id);
        if (!$product) {
        } else {
            if (!$salwar_measurment) {
                $salwar_measurment = [
                    $value->product_id => [
                        "product_id"                    => $value->product_id,
                        "measurement_in"                => $value->measurement_in,
                        "measurement"                   => $value->measurement,
                        "bottom_pattern"                => $value->bottom_pattern,
                        "salwarTopMeasurement"          => $value->salwarTopMeasurement,
                        "salwarBottomMeasurement"       => $value->salwarBottomMeasurement,
                        "other"                         => $value->other,
                    ]
                ];
                session()->put('salwar_measurment', $salwar_measurment);
            }

            $salwar_measurment[$value->product_id] = [
                "product_id"                    => $value->product_id,
                "measurement_in"                => $value->measurement_in,
                "measurement"                   => $value->measurement,
                "bottom_pattern"                => $value->bottom_pattern,
                "salwarTopMeasurement"          => $value->salwarTopMeasurement,
                "salwarBottomMeasurement"       => $value->salwarBottomMeasurement,
                "other"                         => $value->other,
            ];
            session()->put('salwar_measurment', $salwar_measurment);
        }
    }
}


/**
 * get Accessories Data
       @SB 21 april 2020
 * */

function accessories($accessoriesId = false)
{

    $accessories = Accessories::where(function ($query) use ($request, $accessoriesId) {
        $query->where('accessory_status', "=", 1);
        if ($accessoriesId != '') {
            $accessoriesId = explode(',', $accessoriesId);
            $query->whereIn('accessory_id', $accessoriesId);
        }
    })
        ->get();
    return $accessories;
}


function transactionFailed()
{
    $resultData['userData']             = Auth::guard('frontend')->user();
    $transaction                        = new Transaction;
    $transaction->user_id               = $resultData['userData']->id;
    $transaction->order_id              = 0;
    $transaction->paypal_payment_id     = session('paypal_payment_id');
    $transaction->transaction_amount    = session('subTotal');
    $transaction->transaction_status    = 0;
    $transaction->save();
}

function checkRecentProduct()
{
    $recentlyViews = session()->get('recentlyViews');
    foreach ($recentlyViews as $key => $value) {
        $product = Product::find($value['product_id']);
        if ($product->product_status == 0 || $product == '') {
            unset($recentlyViews[$value['product_id'] . '' . $value['product_size']]);
            session()->put('recentlyViews', $recentlyViews);
        }
    }
}

/**
 * @author Bhagirath
 * @create_at 27-April-2020
 * @return date
 */
function dateTimeStamp($date)
{
    $date = date_create($date);
    return date_format($date, "Y-m-d H:i:s");
}

/**
 * @author Bhagirath
 * @create_at 28-April-2020
 * @return URL
 * to get the site logo
 */
function getSiteLogo()
{
    $account = AccountSetting::select('site_logo')->first();
    return  get_image_url(config('constants.accountSetting.images_path'), $account->site_logo);
}


/**
 * @author Bhagirath
 * @create_at 28-April-2020
 * @return string
 * to get the site name
 */
function getSiteName()
{
    $account = AccountSetting::select('site_name')->first();
    return  $account->site_name;
}

function getFaqs()
{
    $faqs = Faq::where('faq_status', 1)->orderBy('faq_id', 'DESC')->get();
    return $faqs;
}


/**
 * To get the hot seller products
 * @return Hot seller products (Object)
 */
function getHotSellerProduct()
{
    $hotSellerProducts =  Product::where('hot_seller', 1)->get();
    return $hotSellerProducts;
}
