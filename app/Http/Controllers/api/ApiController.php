<?php
    namespace App\Http\Controllers\api;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\Country\Country;
    use App\Model\User\User;
    use App\Model\Slider\Slider;
    use App\Model\Faq\Faq;
    use App\Model\Color\Color;
    use App\Model\Fabric\Fabric;
    use App\Model\Accessories\Accessories;
    use App\Model\Occasion\Occasion;
    use App\Model\Size\Size;
    use App\Model\Testimonial\Testimonial;
    use App\Model\Category\Category;
    use App\Model\Shipping\Shipping;
    use App\Model\Master_Page\Master_Page;
    use App\Model\User\UserWhishList;
    use App\Model\Measurement\Measurement;
    use App\Model\Measurement\MeasurementDetail;
    use App\Model\Product\Product;
    use App\Model\Product\ProductAccessories;
    use App\Model\Product\ProductCategory;
    use App\Model\Product\ProductColor;
    use App\Model\Product\ProductFabric;
    use App\Model\Product\ProductImage;
    use App\Model\Product\ProductOccasion;
    use App\Model\Product\ProductSize;
    use DB;
    use File;
    use App\CustomLib\ImageCompress;
    use Hash;
    use Mail;

    class ApiController extends Controller
    {

        public function __construct()
        {
            
        }


        /* Insert Country Data */

        public function insertCountryData(Request $request)
        {
            $arrOldCountry     = DB::connection('mysql2')->table('country')->get();

            foreach ($arrOldCountry as $countrys) {
                $countries                       = new Country;
                $countries->country_id           = $countrys->country_id;
                $countries->country_name         = $countrys->country_name;
                $countries->country_status       = $countrys->country_status;
                $countries->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert User Data */

        public function insertUserData(Request $request)
        {
            $arrOldUser     = DB::connection('mysql2')->table('user_details')->get();

            foreach ($arrOldUser as $users) {

                if($users->user_dcountry != ''){
                    $user_dcountry = $users->user_dcountry; 
                } else { 
                    $user_dcountry = 0;
                }

                $user                       = new User;
                $user->id                   = $users->user_id;
                $user->f_name               = $users->user_fname;
                $user->l_name               = $users->user_lname;
                $user->email                = $users->user_email;
                $user->mobile_number        = $users->user_phone;
                $user->address              = $users->user_daddress;
                $user->zip_code             = $users->user_dzipcode;
                $user->city                 = $users->user_dcity;
                $user->state                = $users->user_dstate;
                $user->country_id           = $user_dcountry;
                $user->password             = Hash::make($users->user_password);
                $user->email_verified_at    = date('Y-m-d');
                $user->user_status          = $users->user_status;
                $user->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }

        /* Insert Slider Data */

        public function insertSliderData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('slider')->get();

            foreach ($arrOld as $arrOlds) {
                $slider                         = new Slider;
                $slider->slider_id              = $arrOlds->slider_id;
                $slider->slider_title           = $arrOlds->slider_title;
                $slider->slider_description     = $arrOlds->slider_title;
                $slider->slider_link            = $arrOlds->slider_name;
                $slider->slider_image           = $arrOlds->slider_image;
                $slider->slider_status          = $arrOlds->slider_status;
                $slider->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }

        /* Insert Faq Data */

        public function insertFaqData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('faq')->get();

            foreach ($arrOld as $arrOlds) {
                $faq                    = new Faq;
                $faq->faq_id            = $arrOlds->id;
                $faq->faq_question      = $arrOlds->question;
                $faq->faq_answer        = $arrOlds->answer;
                $faq->faq_status        = $arrOlds->faq_status;
                $faq->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Color Data */

        public function insertColorData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('color')->get();

            foreach ($arrOld as $arrOlds) {
                $color                = new Color;
                $color->color_id      = $arrOlds->color_id;
                $color->color_name    = $arrOlds->color_name;
                $color->color_code    = $arrOlds->color;
                $color->color_order   = $arrOlds->color_order;
                $color->color_status  = $arrOlds->color_status;
                $color->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Accessories Data */

        public function insertAccessoriesData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('accessories')->get();

            foreach ($arrOld as $arrOlds) {
                $accessories                    = new Accessories;
                $accessories->accessory_id      = $arrOlds->sareeid;
                $accessories->accessory_name    = $arrOlds->s_title;
                $accessories->accessory_price   = $arrOlds->s_price;
                $accessories->accessory_status  = $arrOlds->status;
                $accessories->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Fabric Data */

        public function insertFabricData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('fabric')->get();

            foreach ($arrOld as $arrOlds) {
                $fabric                 = new Fabric;
                $fabric->fabric_id      = $arrOlds->f_id;
                $fabric->fabric_name    = $arrOlds->fabric_name;
                $fabric->fabric_order   = 0;
                $fabric->fabric_status  = $arrOlds->f_status;
                $fabric->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Occasion Data */

        public function insertOccasionData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('occasion')->get();

            foreach ($arrOld as $arrOlds) {
                $occasion                   = new Occasion;
                $occasion->occasion_id      = $arrOlds->o_id;
                $occasion->occasion_name    = $arrOlds->occasion_name;
                $occasion->occasion_order   = 0;
                $occasion->occasion_status  = $arrOlds->o_status;
                $occasion->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Size Data */

        public function insertSizeData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('prod_size')->get();

            foreach ($arrOld as $arrOlds) {
                $sizes                  = new Size;
                $sizes->size_id         = $arrOlds->size_id;
                $sizes->size_measure    = $arrOlds->size;
                $sizes->price_percent   = $arrOlds->price;
                $sizes->size_order      = $arrOlds->s_order;
                $sizes->size_status     = $arrOlds->s_status;
                $sizes->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Testimonial Data */

        public function insertTestimonialData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('client_view')->get();

            foreach ($arrOld as $arrOlds) {
                $testimonial                        = new Testimonial;
                $testimonial->testimonial_id        = $arrOlds->clientview_id;
                $testimonial->testimonial_name      = $arrOlds->clientview_fname;
                $testimonial->testimonial_message   = $arrOlds->clientview_comment;
                $testimonial->testimonial_place     = $arrOlds->clientview_place;
                $testimonial->testimonial_image     = $arrOlds->clientview_photo;
                $testimonial->testimonial_order     = $arrOlds->clientview_order;
                $testimonial->testimonial_status    = $arrOlds->clientview_status;
                $testimonial->save();
            }
            
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Main Category Data */

        public function insertMainCategoryData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('category')->where('category_location','=',0)->get();

            foreach ($arrOld as $arrOlds) {
                $category                               = new Category;
                $category->category_id                  = $arrOlds->category_id;
                $category->category_name                = $arrOlds->category_name;
                $category->category_slug                = $arrOlds->category_slug;
                $category->category_root_id             = $arrOlds->category_location;
                // $category->category_subroot_id          = '';
                $category->category_desc                = $arrOlds->category_description;
                // $category->category_image               = '';
                $category->size_chart                   = $arrOlds->sizechartimg;
                $category->category_order               = $arrOlds->s_order;
                $category->category_status              = $arrOlds->category_status;
                $category->category_meta_title          = $arrOlds->category_seotitle;
                $category->category_meta_keywords       = $arrOlds->category_seokeywords;
                $category->category_meta_description    = $arrOlds->category_seodescription;
                $category->save();
            }
                           
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }



        /* Insert Category Data */

        public function insertCategoryData(Request $request)
        {
            $categoryData = Category::where('category_root_id' ,0)->get();

            foreach($categoryData as $categoryDatas){
                $arrOld  = DB::connection('mysql2')->table('category')->where('category_location','=',$categoryDatas['category_id'])->get();
                foreach ($arrOld as $arrOlds) {
                    $category                               = new Category;
                    $category->category_id                  = $arrOlds->category_id;
                    $category->category_name                = $arrOlds->category_name;
                    $category->category_slug                = $arrOlds->category_slug;
                    $category->category_root_id             = $arrOlds->category_location;
                    // $category->category_subroot_id          = '';
                    $category->category_desc                = $arrOlds->category_description;
                    // $category->category_image               = '';
                    $category->size_chart                   = $arrOlds->sizechartimg;
                    $category->category_order               = $arrOlds->s_order;
                    $category->category_status              = $arrOlds->category_status;
                    $category->category_meta_title          = $arrOlds->category_seotitle;
                    $category->category_meta_keywords       = $arrOlds->category_seokeywords;
                    $category->category_meta_description    = $arrOlds->category_seodescription;
                    $category->save();
                }
            }
                           
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Sub Category Data */

        public function insertSubCategoryData(Request $request)
        {
            $categoryData = Category::where('category_root_id','!=',0)->get();

            foreach($categoryData as $categoryDatas){
                $arrOld  = DB::connection('mysql2')->table('category')->where('category_location','=',$categoryDatas['category_id'])->get();

                foreach ($arrOld as $arrOlds) {
                    $category                               = new Category;
                    $category->category_id                  = $arrOlds->category_id;
                    $category->category_name                = $arrOlds->category_name;
                    $category->category_slug                = $arrOlds->category_slug;
                    $category->category_root_id             = $categoryDatas['category_root_id'];
                    $category->category_subroot_id          = $arrOlds->category_location;
                    $category->category_desc                = $arrOlds->category_description;
                    // $category->category_image               = '';
                    $category->size_chart                   = $arrOlds->sizechartimg;
                    $category->category_order               = $arrOlds->s_order;
                    $category->category_status              = $arrOlds->category_status;
                    $category->category_meta_title          = $arrOlds->category_seotitle;
                    $category->category_meta_keywords       = $arrOlds->category_seokeywords;
                    $category->category_meta_description    = $arrOlds->category_seodescription;
                    $category->save();
                }
            }
                           
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Shipping Data */

        public function insertShippingData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('shpping')->get();
            foreach ($arrOld as $arrOlds) {

                $weight     = json_decode($arrOlds->weight);
                $shipCharge = json_decode($arrOlds->ship_charge);

                for ($i=1; $i <= 40; $i++) { 
                    $weightKey = 'weight'.$i;
                    $chargeKey = 'ship_charge'.$i;


                    if($weight->$weightKey != "" && $shipCharge->$chargeKey != "" ){

                        $shipping                           = new Shipping;
                        $shipping->shipping_country_id      = $arrOlds->country;
                        $shipping->shipping_weight          = $weight->$weightKey;
                        $shipping->shipping_price           = $shipCharge->$chargeKey;
                        $shipping->shipping_status          = $arrOlds->status;
                        $shipping->save();
                    }
                }
            }
                           
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Master Data */

        public function insertMasterPagesData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('master_pages')->get();
            foreach ($arrOld as $arrOlds) {
                $masterpages                            = new Master_Page;
                $masterpages->page_id                   = $arrOlds->masterpage_id;
                $masterpages->page_name                 = $arrOlds->masterpage_name;
                $masterpages->page_slug                 = $arrOlds->masterpage_webname;
                $masterpages->image_name                = $arrOlds->masterpage_image;
                $masterpages->page_meta_title           = $arrOlds->master_meta_title;
                $masterpages->page_meta_keyword         = $arrOlds->masterpage_metakeyword;
                $masterpages->page_meta_description     = $arrOlds->masterpage_metadescription;
                $masterpages->save();
            }
                           
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* Insert Wishlist Data */

        public function insertWishlistData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('wishlist')->get();
            foreach ($arrOld as $arrOlds) {
                $wishlist               = new UserWhishList;
                $wishlist->user_id      = $arrOlds->user_id;
                $wishlist->product_id   = $arrOlds->product_id;
                $wishlist->save();
            }
                           
            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }




        /* Insert Measurement Data */
        public function insertMeasurementData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('measurement')->get();
            foreach ($arrOld as $arrOlds) {

                $measurementTitle  = json_decode($arrOlds->measuerment_title);
                $MeasurementDetail = json_decode($arrOlds->measuerment_detail);
                
                $measurement                        = new Measurement;
                $measurement->measurement_id        = $arrOlds->m_id;
                $measurement->measurement_title     = $arrOlds->title;
                $measurement->measurement_price     = $arrOlds->mprice;
                $measurement->measurement_desc      = $arrOlds->discription;
                $measurement->measurement_chart     = $arrOlds->m_chart;
                $measurement->measurement_status    = $arrOlds->m_status;
                $measurement->save();

                for ($i=0; $i <= 25; $i++) { 
                    $measTitle  = $measurementTitle[$i];
                    $measDesc   = $MeasurementDetail[$i];

                    if($measTitle != "" && $measDesc != "" ){

                        $measurementDetails                         = new MeasurementDetail;
                        $measurementDetails->measurement_id         = $arrOlds->m_id;
                        $measurementDetails->measurement_title      = $measTitle;
                        $measurementDetails->title_description      = $measDesc;
                        $measurementDetails->save();
                    }
                }
            }

            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }



        /* Insert Product Data */
        public function insertProductData(Request $request)
        {
            $arrOld     = DB::connection('mysql2')->table('product')->get();
            foreach ($arrOld as $arrOlds) {

                $productCheck                       = Product::find($arrOlds->product_id);

                if($productCheck == ''){
                    $product                        = new Product;
                } else {
                    $product                        = Product::find($arrOlds->product_id);
                }

                $product->product_id                = $arrOlds->product_id;
                $product->product_code              = $arrOlds->product_code;
                $product->product_name              = $arrOlds->product_name;
                $product->product_slug              = $arrOlds->product_slug;

                if($arrOlds->product_quality == 'New'){
                $product->product_type              = 1;
                } else if($arrOlds->product_quality == 'Sale') {
                $product->product_type              = 2;
                } else {
                $product->product_type              = 3;
                }
                if($arrOlds->product_custom_mes != ''){
                $product->measurement_id            = $arrOlds->product_custom_mes;
                }
                $product->product_price             = $arrOlds->product_price;
                $product->product_discounted_price  = $arrOlds->product_dis_price;
                $product->product_discount_percent  = 100 - round($arrOlds->product_dis_price*100/$arrOlds->product_price,2);
                $product->product_categories        = $arrOlds->product_category;
                $product->product_colors            = $arrOlds->product_colour;
                $product->product_fabrics           = $arrOlds->product_feb;
                $product->product_occasions         = $arrOlds->product_occ;
                $product->product_sizes             = $arrOlds->prod_measure;
                $product->product_accessories       = $arrOlds->product_ass;
                $product->product_weight            = $arrOlds->product_weight;
                $product->product_timetoship        = $arrOlds->timetoship;
                $product->product_description       = $arrOlds->product_description;
                $product->product_notes             = $arrOlds->product_notes;
                $product->product_views             = $arrOlds->view;
                $product->product_image             = $arrOlds->product_popimage1;
                $product->product_status            = $arrOlds->product_status;

                if($arrOlds->product_status == 0){
                $product->out_of_stock              = 1;
                } else {
                $product->out_of_stock              = 2;
                }
                
                $product->created_at                = $arrOlds->product_date;
                $product->updated_at                = $arrOlds->product_date;
                $product->save();

                // Product Images
                // $productImagesCheck                 = ProductImage::where('product_id',$arrOlds->product_id)->first();
                // if(count($productImagesCheck) == 0){
                //     $productImages                  = new ProductImage;
                // } else {
                //     $productImages                  = ProductImage::find($productImagesCheck->id);
                // }

                // $productImages->product_id          = $arrOlds->product_id;
                // $productImages->product_image       = $arrOlds->product_popimage1;
                // $productImages->image_order         = 1;
                // $productImages->save();


                $category       = explode(',',$arrOlds->product_category);
                $color          = explode(',',$arrOlds->product_colour);
                $fabric         = explode(',',$arrOlds->product_feb);
                $occasion       = explode(',',$arrOlds->product_occ);
                $measurment     = explode(',',$arrOlds->prod_measure);
                $accessories    = explode(',',$arrOlds->product_ass);
                
                foreach ($category as $categories) {
                    if($categories != ''){

                        $categoryDataCheck = ProductCategory::where('product_id',$arrOlds->product_id)->where('category_id',$categories)->first();
                        if(count($categoryDataCheck) == 0){
                            $categoryData           = new ProductCategory;
                        } else {
                            $categoryData           = ProductCategory::find($categoryDataCheck->id);
                        }
                        
                        $categoryData->product_id   = $arrOlds->product_id;
                        $categoryData->category_id  = $categories;
                        $categoryData->save();
                    }
                }

                foreach ($color as $colors) {
                    if($colors != ''){

                        $colorDataCheck = ProductColor::where('product_id',$arrOlds->product_id)->where('color_id',$colors)->first();
                        if(count($colorDataCheck) == 0){
                            $colorData           = new ProductColor;
                        } else {
                            $colorData           = ProductColor::find($colorDataCheck->id);
                        }
                        $colorData->product_id   = $arrOlds->product_id;
                        $colorData->color_id     = $colors;
                        $colorData->save();
                    }
                }

                foreach ($fabric as $fabrics) {
                    if($fabrics != ''){

                        $fabricDataCheck = ProductFabric::where('product_id',$arrOlds->product_id)->where('fabric_id',$fabrics)->first();
                        if(count($fabricDataCheck) == 0){
                            $fabricData             = new ProductFabric;
                        } else {
                            $fabricData             = ProductFabric::find($fabricDataCheck->id);
                        }
                        
                        $fabricData->product_id     = $arrOlds->product_id;
                        $fabricData->fabric_id      = $fabrics;
                        $fabricData->save();
                    }
                }

                foreach ($occasion as $occasions) {
                    if($occasions != ''){

                        $occasionDataCheck = ProductOccasion::where('product_id',$arrOlds->product_id)->where('occasion_id',$occasions)->first();
                        if(count($occasionDataCheck) == 0){
                            $occasionData           = new ProductOccasion;
                        } else {
                            $occasionData           = ProductOccasion::find($occasionDataCheck->id);
                        }
                        $occasionData->product_id   = $arrOlds->product_id;
                        $occasionData->occasion_id  = $occasions;
                        $occasionData->save();
                    }
                }

                foreach ($measurment as $measurments) {
                    if($measurments != ''){
                        $measurmentDataCheck = ProductSize::where('product_id',$arrOlds->product_id)->where('size_id',$measurments)->first();
                        if(count($measurmentDataCheck) == 0){
                            $measurmentData             = new ProductSize;
                        } else {
                            $measurmentData             = ProductSize::find($measurmentDataCheck->id);
                        }
                        
                        $measurmentData->product_id     = $arrOlds->product_id;
                        $measurmentData->size_id        = $measurments;
                        $measurmentData->save();
                    }
                }

                foreach ($accessories as $accessoriess) {
                    if($accessoriess != ''){

                        $accessoriesDataCheck = ProductAccessories::where('product_id',$arrOlds->product_id)->where('accessory_id',$accessoriess)->first();
                        if(count($accessoriesDataCheck) == 0){
                            $accessoriesData            = new ProductAccessories;
                        } else {
                            $accessoriesData            = ProductAccessories::find($accessoriesDataCheck->id);
                        }

                        $accessoriesData->product_id    = $arrOlds->product_id;
                        $accessoriesData->accessory_id  = $accessoriess;
                        $accessoriesData->save();
                    }
                }
            }

            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }



        /* Update Slug Data */

        public function updateSlug(Request $request)
        {
            $colorData     = Color::get();
            foreach ($colorData as $colorDatas) {
                $color                = Color::find($colorDatas->color_id);
                $color->color_name    = $colorDatas->color_name;
                $color->save();
            }


            $fabricData     = Fabric::get();
            foreach ($fabricData as $fabricDatas) {
                $fabric                = Fabric::find($fabricDatas->fabric_id);
                $fabric->fabric_name    = $fabricDatas->fabric_name;
                $fabric->save();
            }

            $occasionData     = Occasion::get();
            foreach ($occasionData as $occasionDatas) {
                $occasion                = Occasion::find($occasionDatas->occasion_id);
                $occasion->occasion_name    = $occasionDatas->occasion_name;
                $occasion->save();
            }

            $accessoriesData     = Accessories::get();
            foreach ($accessoriesData as $accessoryData) {
                $accessory                    = Accessories::find($accessoryData->accessory_id);
                $accessory->accessory_name    = $accessoryData->accessory_name;
                $accessory->save();
            }

            $measurementsData     = Measurement::get();
            foreach ($measurementsData as $measurementData) {
                $measurement                       = Measurement::find($measurementData->measurement_id);
                $measurement->measurement_title    = $measurementData->measurement_title;
                $measurement->save();
            }

            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }


        /* update Discount Price Data */
        public function updateDiscountPrice(Request $request)
        {   
            $productData = Product::get();
            foreach ($productData as $productDatas) {

                $product                            = Product::find($productDatas->product_id);
                $product->product_discount_percent  = 100 - round($productDatas->product_discounted_price*100/$productDatas->product_price,2);
                $product->save();
            }

            $result_response['status']  = true;
            $result_response['message'] = "Success";
            return response()->json($result_response, 200);
        }



    }
    