<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Product\Product;
use App\Model\Color\Color;
use App\Model\Fabric\Fabric;
use App\Model\Size\Size;
use App\Model\Category\Category;
use App\Model\Occasion\Occasion;
use App\model\Accessories\Accessories;
use App\Model\Measurement\Measurement;
use App\Model\Product\ProductSize;
use App\Model\Product\ProductImage;
use App\Model\Product\ProductFabric;
use App\Model\Product\ProductColor;
use App\Model\Product\ProductCategory;
use App\Model\Product\ProductAccessories;
use App\Model\Product\ProductOccasion;
use App\Model\Product\ProductOrderDetail;
use Zend\Diactoros\Response;
use App\Model\User\UserWhishList;
use App\Http\Requests\AdminPanel\ValidateProduct;
use App\Http\Traits\UploadImage;
use App\CustomLib\ImageCompress;
use Excel;
use File;
use Zip;

class ProductController extends Controller
{
    use UploadImage;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * View Product
     * @author Bhagirath
     * @create_at 07 March-2020
     */

    public function index()
    {
        $categories  = catgeoriesData()->toArray(); // Function called from helper.
        $data = array('categories' => $categories);
        return view('admin-panel.product.index')->with($data);
    }

    /**
     * View create product.
     *
     * @author Bhagirath
     * @create_at 07 March-2020
     */
    public function create()
    {
        $sizes       = Size::orderBy('size_measure', 'ASC')->where('size_status', 1)->get();
        $colors      = Color::orderBy('color_name', 'ASC')->where('color_status', 1)->get();
        $fabrics     = Fabric::orderBy('fabric_name', 'ASC')->where('fabric_status', 1)->get();
        $occasions   = Occasion::orderBy('occasion_name', 'ASC')->where('occasion_status', 1)->get();
        $accessories = Accessories::orderBy('accessory_name', 'ASC')->where('accessory_status', 1)->get();
        $categories  = catgeoriesData()->toArray(); // Function called from helper.
        $measurement = Measurement::orderBy('measurement_title', 'ASC')->where('measurement_status', 1)->get();
        $data        = array(

            'sizes'       => $sizes,
            'colors'      => $colors,
            'fabrics'     => $fabrics,
            'occasions'   => $occasions,
            'accessories' => $accessories,
            'categories'  => $categories,
            'measurement' => $measurement,

        );
        return view('admin-panel.product.create')->with($data);
    }
    /**
     * Check product Name.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function checkproductName(Request $request)
    {
        $status = false;

        if (!is_null($request->product_name)) {
            $product = Product::where('product_name', $request['product_name'])->first();

            if (!is_null($product)) {
                if ($request->filled('id') && $product->product_id == dv($request['id'])) {
                    $status = true;
                } else {
                    $status = false;
                }
            } else {
                $status = true;
            }
        }

        return response()->json($status, 200);
    }
    /**
     * Check product code.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function checkProductCode(Request $request)
    {
        $status = false;

        if (!is_null($request->product_code)) {
            $product = Product::where('product_code', $request['product_code'])->first();
            if (!is_null($product)) {
                if ($request->filled('id') && $product->product_id == dv($request['id'])) {
                    $status = true;
                } else {
                    $status = false;
                }
            } else {
                $status = true;
            }
        }

        return response()->json($status, 200);
    }
    /**
     * Store product.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function store(ValidateProduct $request)
    {
        $product           = false;
        $error_message     = null;

        // Upload Default Image
        if ($request->hasFile('default_image')) {
            $default_image = $this->uploadImage($request->file('default_image'), config('constants.products.images_path'), null, $request['product_code']);
            if ($default_image['_status']) {
                $default_image_name = $default_image['_data'];
            }
        }

        if ($request->hasFile('product_image_small')) {
            $product_image_small = $this->uploadImage($request->file('product_image_small'), config('constants.products.thumb_images_path'), null, $request['product_code']);
            if ($product_image_small['_status']) {
                $product_image_small_name = $product_image_small['_data'];
            }
        }

        // ---------------------
        if ($request['category']) {
            $categories = implode(',', $request['category']);
        } else {
            $categories = "";
        }
        if ($request['color']) {
            $colors = implode(',', $request['color']);
        } else {
            $colors = "";
        }
        if ($request['fabric']) {
            $fabrics = implode(',', $request['fabric']);
        } else {
            $fabrics = "";
        }
        if ($request['occasion']) {
            $occasions = implode(',', $request['occasion']);
        } else {
            $occasions = "";
        }
        if ($request['size']) {
            $sizes = implode(',', $request['size']);
        } else {
            $sizes = "";
        }
        if ($request['accessory']) {
            $accessories = implode(',', $request['accessory']);
        } else {
            $accessories = "";
        }
        // To Calculate the discount percentage
        $discount_percent = 100 - ($request['product_discount'] * 100) / $request['product_price'];
        // ------------------------------------
        // Time to ship
        $timeToShip = $request['product_time'] . " days";
        // ------------
        DB::beginTransaction();
        // Create product
        try {
            // Set data
            $data = [
                'product_code'                => $request['product_code'],
                'product_name'                => ucwords($request['product_name']),
                'hot_seller'                => $request['hot_seller'],
                'measurement_id'              => $request['measurement'],
                'product_price'               => $request['product_price'],
                'product_discounted_price'    => $request['product_discount'],
                'product_order'               => $request['product_order'] ?? 0,
                'product_discount_percent'    => $discount_percent,
                'product_categories'          => $categories,
                'product_colors'              => $colors,
                'product_fabrics'             => $fabrics,
                'product_occasions'           => $occasions,
                'product_sizes'               => $sizes,
                'product_accessories'         => $accessories,
                'product_weight'              => $request['product_weight'],
                'product_timetoship'          => $timeToShip,
                'product_description'         => $request['product_description'],
                'product_notes'               => $request['product_notes'],
                'product_image'               => $default_image_name,
                'product_image_small'         => $product_image_small_name,
            ];
            //---------

            $product = Product::create($data);
            DB::commit();
            $_productId = $product->product_id;

            $ch = curl_init("https://www.bagteshfashion.com/generate_sitemap.php");
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = json_decode(curl_exec($ch));

            // Store into color mapping table
            foreach ($request['color'] as $key => $_color) {
                $_productColor                = new ProductColor;
                $_productColor->product_id    = $_productId;
                $_productColor->color_id      = $_color;
                $_productColor->save();
            }
            // ------------------------------

            // Store into accessory mapping table
            foreach ($request['accessory'] as $key => $_accessory) {
                $_productAccessory                = new ProductAccessories;
                $_productAccessory->product_id    = $_productId;
                $_productAccessory->accessory_id  = $_accessory;
                $_productAccessory->save();
            }
            // ------------------------------

            // Store into size mapping table
            foreach ($request['size'] as $key => $_size) {
                $_productSize              = new ProductSize;
                $_productSize->product_id  = $_productId;
                $_productSize->size_id     = $_size;
                $_productSize->save();
            }
            // ------------------------------

            // Store into occasion mapping table
            foreach ($request['occasion'] as $key => $_occasion) {
                $_productOccasion               = new ProductOccasion;
                $_productOccasion->product_id   = $_productId;
                $_productOccasion->occasion_id  = $_occasion;
                $_productOccasion->save();
            }
            // ------------------------------

            // Store into category mapping table
            foreach ($request['category'] as $key => $_category) {
                $_productCategory               = new ProductCategory;
                $_productCategory->product_id   = $_productId;
                $_productCategory->category_id  = $_category;
                $_productCategory->save();
            }
            // ------------------------------

            // Store into fabric mapping table
            foreach ($request['fabric'] as $key => $_fabric) {
                $_productFabric               = new ProductFabric;
                $_productFabric->product_id   = $_productId;
                $_productFabric->fabric_id    = $_fabric;
                $_productFabric->save();
            }
            // ------------------------------
            // Store into other image table
            foreach ($request['other_images'] as $key => $img) {
                if ($request->hasFile('other_images')) {
                    $other_images = $this->uploadImage($request->file('other_images')[$key], config('constants.products.images_path'), null);
                    if ($other_images['_status']) {
                        $other_image_name = $other_images['_data'];

                        $productImage = new ProductImage;
                        $productImage->product_image = $other_image_name;
                        $productImage->product_id    = $_productId;
                        $productImage->save();
                    }
                }
            }
            // ----------------------------

        } catch (\Exception $e) {
            $product        = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (!is_null($product)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Product']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.product.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Product']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.product.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     * Get categoreis list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function getProducts(Request $request)
    {
        $auth_user = auth()->user();
        $product = Product::with(["category" => function ($query) {
            $query->join("categories", function ($join) {
                $join->on("categories.category_id", "=", "product_category.category_id");
            });
            $query->select("product_category.category_id", "product_category.product_id", "categories.category_name");
        }])
            ->where(function ($query) use ($request) {
                if (!empty($request) && !empty($request->input('product_name'))) {
                    $query->whereRaw('lower(product_name) LIKE ? ', [trim(strtolower('%' . $request->input('product_name'))) . '%']);
                    $query->orWhereRaw('lower(product_code) LIKE ? ', [trim(strtolower('%' . $request->input('product_name'))) . '%']);
                }
            })
            ->where(function ($query) use ($request) {
                if (!empty($request) && !empty($request['category_id'])) {

                    $query->whereRaw('FIND_IN_SET(' . $request["category_id"] . ', product_categories)');
                }
            })
            ->orderBy('product_id', 'DESC')->get();

        return DataTables::of($product)
            ->addColumn('image', function ($product) {
                $image = get_image_url(config('constants.products.images_path'), $product->product_image);
                if (!empty($image)) {
                    return '<img src="' . $image . '" width="50px"/> ';
                } else {
                    return 'N\A';
                }
            })
            ->addColumn('status', function ($product) {
                $status = '';
                if ($product->product_status == 0) {
                    $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
                } else {
                    $status .= '<label class="badge badge-success">Active</label> &nbsp;';
                }
                return $status;
            })
            ->addColumn('action', function ($product) {

                $action = '<div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" id="exampleColorDropdown1"
            data-toggle="dropdown" aria-expanded="false">
            Action
            </button>
            <div class="dropdown-menu" aria-labelledby="exampleColorDropdown1" role="menu">
            <a href="' . route('adminPanel.product.edit', ['id' => ev($product->product_id)]) . '" class="dropdown-item" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i>Edit</a>
            <a href="' . route('adminPanel.product.details', ['id' => ev($product->product_id)]) . '" class="dropdown-item" title="View Details"><i class="icon fa fa-eye" aria-hidden="true"></i>Details</a>
            </div>
            </div>';

                return $action;
            })
            ->addColumn('category', function ($product) {
                $data .= "<ul class='list-unstyled'>";
                foreach ($product->category as $category) {
                    $data .= "<li>" . $category['category_name'] . "</li>";
                }
                $data .= "</ul>";
                return $data;
            })
            ->addColumn('type', function ($product) {

                $type .= '<select class="form-control" onchange="changeType(this)" data-id="' . ev($product->product_id) . '" style="font-size: 12px;">';
                if ($product->hot_seller == 0) {
                    $type .=  '<option value="0" selected>No</option>';
                } else {
                    $type .=  '<option value="0">No</option>';
                }
                if ($product->hot_seller == 1) {
                    $type .=  '<option value="1" selected>Yes</option>';
                } else {
                    $type .=  '<option value="1">Yes</option>';
                }
                return $type;
            })

            ->addColumn('out_of_stock', function ($product) {
                if ($product->out_of_stock == 1) {
                    $stock = '<label class="badge badge-warning"> No  </label>';
                } else {
                    $stock = '<label class="badge badge-success"> Yes  </label>';
                }
                return $stock;
            })
            ->rawColumns([
                'action'             => 'action',
                'type'               => 'type',
                'status'             => 'status',
                'image'              => 'image',
                'category'           => 'category',
            ])->addIndexColumn()->make(true);
    }

    /**
     * Destroy.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function destroy(Request $request)
    {
        $ids                  = $request['ids'];
        $_productColor        = ProductColor::whereIn('product_id', $ids)->delete();
        $_productSize         = ProductSize::whereIn('product_id', $ids)->delete();
        $_productAccessory    = ProductAccessories::whereIn('product_id', $ids)->delete();
        $_productOccasion     = ProductOccasion::whereIn('product_id', $ids)->delete();
        $_productCategory     = ProductCategory::whereIn('product_id', $ids)->delete();
        $_productFabric       = ProductFabric::whereIn('product_id', $ids)->delete();
        $_productImage        = ProductImage::whereIn('product_id', $ids)->delete();
        $_userWishList        = UserWhishList::whereIn('product_id', $ids)->delete();
        $product              = Product::whereIn('product_id', $ids)->delete();
        // Set response
        if ($product == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Product']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'product']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }
    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function changeStatus(Request $request)
    {

        foreach ($request['ids'] as $value) {
            $product = Product::find($value);
            if ($product->product_status == 1) {
                $product->product_status = 0;
                $product->save();
            } else {
                $product->product_status = 1;
                $product->save();
            }
        }

        // Set response
        if (!is_null($product)) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.status_changed'),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.status_change_failed'),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
     * View edit product.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Bhagirath
     * @created_at 03 March 2020
     */
    public function edit(Request $request, $id)
    {
        $product     = Product::find(dv($id));
        $otherImages = ProductImage::where('product_id', dv($id))->get();
        $sizes       = Size::orderBy('size_measure', 'ASC')->where('size_status', 1)->get();
        $colors      = Color::orderBy('color_name', 'ASC')->where('color_status', 1)->get();
        $fabrics     = Fabric::orderBy('fabric_name', 'ASC')->where('fabric_status', 1)->get();
        $occasions   = Occasion::orderBy('occasion_name', 'ASC')->where('occasion_status', 1)->get();
        $accessories = Accessories::orderBy('accessory_name', 'ASC')->where('accessory_status', 1)->get();
        $categories  = catgeoriesData()->toArray(); // Function called from helper.
        $measurement = Measurement::orderBy('measurement_title', 'ASC')->where('measurement_status', 1)->get();
        $data        = array(

            'product'     => $product,
            'sizes'       => $sizes,
            'colors'      => $colors,
            'fabrics'     => $fabrics,
            'occasions'   => $occasions,
            'accessories' => $accessories,
            'categories'  => $categories,
            'measurement' => $measurement,
            'otherImages' => $otherImages,

        );
        return view('admin-panel.product.edit')->with($data);
    }
    /**
     * Update product.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function update(ValidateProduct $request, $id)
    {
        $user             = auth()->user();
        $product          = false;
        $error_message    = null;

        DB::beginTransaction();
        $product            = Product::find(dv($request['id']));
        $default_image_name = $product->product_image;
        $product_image_small_name = $product->product_image_small;
        // Update Default Image
        if ($request->hasFile('default_image')) {

            // Remove old image
            if (!is_null($product->product_image)) {
                delete_image(config('constants.products.images_path'), $product->product_image);
            }
            //-----------------

            $default_image = $this->uploadImage($request->file('default_image'), config('constants.products.images_path'), null, $request['product_code']);
            if ($default_image['_status']) {
                $default_image_name = $default_image['_data'];
            }
        }

        if ($request->hasFile('product_image_small')) {

            // Remove old image
            if (!is_null($product->product_image_small)) {
                delete_image(config('constants.products.thumb_images_path'), $product->product_image_small);
            }
            //-----------------

            $product_image_small = $this->uploadImage($request->file('product_image_small'), config('constants.products.thumb_images_path'), null, $request['product_code']);
            if ($product_image_small['_status']) {
                $product_image_small_name = $product_image_small['_data'];
            }
        }

        // If discounted price is greater than original price
        if ($request['product_price'] > $request['product_discount']) {
            $price     = $request['product_price'];
            $discount  = $request['product_discount'];
        } else {
            $price     = $request['product_price'];
            $discount  = 0;
        }
        // --------------------------------------------------
        if ($request['category']) {
            $categories = implode(',', $request['category']);
        } else {
            $categories = "";
        }
        if ($request['color']) {
            $colors = implode(',', $request['color']);
        } else {
            $colors = "";
        }
        if ($request['fabric']) {
            $fabrics = implode(',', $request['fabric']);
        } else {
            $fabrics = "";
        }
        if ($request['occasion']) {
            $occasions = implode(',', $request['occasion']);
        } else {
            $occasions = "";
        }
        if ($request['size']) {
            $sizes = implode(',', $request['size']);
        } else {
            $sizes = "";
        }
        if ($request['accessory']) {
            $accessories = implode(',', $request['accessory']);
        } else {
            $accessories = "";
        }
        $discount_percent = 100 - ($request['product_discount'] * 100) / $request['product_price'];
        // Time to ship
        $timeToShip = $request['product_time'] . " days";
        // -----------
        // Create product
        try {
            // Set data

            $product->product_code              =  $request['product_code'];
            $product->product_name              =  ucwords($request['product_name']);
            $product->hot_seller              =  $request['hot_seller'];
            $product->measurement_id            =  $request['measurement'];
            $product->product_price             =  $request['product_price'];
            $product->product_discounted_price  =  $request['product_discount'];
            $product->product_order  =  $request['product_order'] ?? 0;
            $product->product_discount_percent  =  $discount_percent;
            $product->product_categories        =  $categories;
            $product->product_colors            =  $colors;
            $product->product_fabrics           =  $fabrics;
            $product->product_occasions         =  $occasions;
            $product->product_sizes             =  $sizes;
            $product->product_accessories       =  $accessories;
            $product->product_weight            =  $request['product_weight'];
            $product->product_timetoship        =  $timeToShip;
            $product->product_description       =  $request['product_description'];
            $product->product_notes             =  $request['product_notes'];
            $product->product_image             =  $default_image_name;
            $product->product_image_small       =  $product_image_small_name;

            $product->save();

            $ch = curl_init("https://www.bagteshfashion.com/generate_sitemap.php");
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = json_decode(curl_exec($ch));
            //---------
            DB::commit();

            // Update into color mapping table
            $_productColor  = ProductColor::where('product_id', dv($id))->delete();
            foreach ($request['color'] as $key => $_color) {
                $_productColor                = new ProductColor;
                $_productColor->product_id    = dv($id);
                $_productColor->color_id      = $_color;
                $_productColor->save();
            }
            // ------------------------------

            // Update into accessory mapping table
            $_productAccessory  = ProductAccessories::where('product_id', dv($id))->delete();
            foreach ($request['accessory'] as $key => $_accessory) {
                $_productAccessory                = new ProductAccessories;
                $_productAccessory->product_id    = dv($id);
                $_productAccessory->accessory_id  = $_accessory;
                $_productAccessory->save();
            }
            // ------------------------------

            // Update into size mapping table
            $_productSize  = ProductSize::where('product_id', dv($id))->delete();
            foreach ($request['size'] as $key => $_size) {
                $_productSize              = new ProductSize;
                $_productSize->product_id  = dv($id);
                $_productSize->size_id     = $_size;
                $_productSize->save();
            }
            // ------------------------------

            // Update into occasion mapping table
            $_productOccasion  = ProductOccasion::where('product_id', dv($id))->delete();
            foreach ($request['occasion'] as $key => $_occasion) {
                $_productOccasion               = new ProductOccasion;
                $_productOccasion->product_id   = dv($id);
                $_productOccasion->occasion_id  = $_occasion;
                $_productOccasion->save();
            }
            // ------------------------------

            // Update into category mapping table
            $_productCategory  = ProductCategory::where('product_id', dv($id))->delete();
            foreach ($request['category'] as $key => $_category) {
                $_productCategory               = new ProductCategory;
                $_productCategory->product_id   = dv($id);
                $_productCategory->category_id  = $_category;
                $_productCategory->save();
            }
            // ------------------------------

            // Update into fabric mapping table
            $_productFabric  = ProductFabric::where('product_id', dv($id))->delete();
            foreach ($request['fabric'] as $key => $_fabric) {
                $_productFabric               = new ProductFabric;
                $_productFabric->product_id   = dv($id);
                $_productFabric->fabric_id    = $_fabric;
                $_productFabric->save();
            }
            // ------------------------------
            // Update into other image table
            foreach ($request['other_images'] as $key => $img) {
                if ($request->hasFile('other_images')) {
                    $other_images = $this->uploadImage($request->file('other_images')[$key], config('constants.products.images_path'), null);
                    if ($other_images['_status']) {

                        $other_image_name = $other_images['_data'];

                        $productImage = new ProductImage;
                        $productImage->product_image = $other_image_name;
                        $productImage->product_id    = dv($id);
                        $productImage->save();
                    }
                }
            }
            // ----------------------------
        } catch (\Exception $e) {
            $product          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------
        if ($product == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Product']),
                '_type'    => 'success'
            ];
            //-----------------=
            return redirect()->route('adminPanel.product.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Product']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->route('adminPanel.product.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     *
     * Change the product type
     * @author: Bhagiath
     * 08 March 2020
     *
     */
    public function changeType(Request $request)
    {

        $product = Product::find(dv($request['id']));
        $product->hot_seller = $request['val'];
        $product->save();

        // Set response
        if (!is_null($product)) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.type_changed'),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.type_change_failed'),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
     *
     * Change stock status (out of stock)
     * @author Bhagirath
     * 12 March 2020
     *
     */
    public function changeStockStatus(Request $request)
    {
        foreach ($request['ids'] as $value) {
            $product = Product::find($value);
            if ($product->out_of_stock == 1) {
                $product->out_of_stock = 2;
                $product->save();
            } else {
                $product->out_of_stock = 1;
                $product->save();
            }
        }
        // Set response
        if (!is_null($product)) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.stock_status_changed'),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.stock_status_change_failed'),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }

    /**
     *
     * View product details
     * @author Bhagirath
     * 12 March 2020
     *
     */
    public function productDetails($id)
    {

        $product = Product::withTrashed()->with('getImages')
            ->with(['category' => function ($query) {
                $query->withTrashed();
                $query->join('categories', function ($join) {
                    $join->on('product_category.category_id', '=', 'categories.category_id');
                });
                $query->select('product_category.category_id', 'category_name', 'product_id');
            }])
            ->with(['color' => function ($query) {
                $query->withTrashed();
                $query->join('colors', function ($join) {
                    $join->on('product_color.color_id', '=', 'colors.color_id');
                });
                $query->select('product_color.color_id', 'color_name', 'product_id');
            }])
            ->with(['size' => function ($query) {
                $query->withTrashed();
                $query->join('sizes', function ($join) {
                    $join->on('product_size.size_id', '=', 'sizes.size_id');
                });
                $query->select('product_size.size_id', 'size_measure', 'product_id');
            }])
            ->with(['fabric' => function ($query) {
                $query->withTrashed();
                $query->join('fabrics', function ($join) {
                    $join->on('product_fabric.fabric_id', '=', 'fabrics.fabric_id');
                });
                $query->select('product_fabric.fabric_id', 'fabric_name', 'product_id');
            }])
            ->with(['occasion' => function ($query) {
                $query->withTrashed();
                $query->join('occasions', function ($join) {
                    $join->on('product_occasion.occasion_id', '=', 'occasions.occasion_id');
                });
                $query->select('product_occasion.occasion_id', 'occasion_name', 'product_id');
            }])
            ->with(['accessory' => function ($query) {
                $query->withTrashed();
                $query->join('accessories', function ($join) {
                    $join->on('product_accessories.accessory_id', '=', 'accessories.accessory_id');
                });
                $query->select('product_accessories.accessory_id', 'accessory_name', 'product_id');
            }])
            ->where('product_id', dv($id))->first();
        $data    = array(
            'product' => $product,
        );
        return view('admin-panel.product.details')->with($data);
    }

    /**
     *
     * Remove Image
     *
     * @return Boolean
     *
     * @author Bhagirath
     * @create_at 23 March 2020
     *
     */

    public function removeImage(Request $request)
    {
        $productImage = ProductImage::find(dv($request['id']));

        // Remove old image
        if (!is_null($productImage->product_image)) {
            delete_image(config('constants.products.images_path'), $productImage->product_image);
        }
        //-----------------

        $imagePath    = get_image_url(config('constants.products.images_path'), $productImage->product_image);

        $productImage->delete();
        if ($productImage == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Product Image']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Product Image']),
                '_type'    => 'error'
            ];
        }
        return response()->json($response, 200);
    }

    // Excel file uploadation
    /**
     *
     * Upload excel file view page
     *
     * @return Mixed
     *
     * @author Bhagirath
     * @create_at 26 March 2020
     *
     */
    public function uploadExcelIndex()
    {

        return view('admin-panel.product.upload-excel');
    }
    /**
     *
     * Upload excel data to table
     *
     * @return Mixed
     *
     * @author Bhagirath
     * @create_at 26 March 2020
     *
     */
    public function uploadExcel(Request $request)
    {
        $product           = null;
        $error_message     = null;
        $faultCount        = 0;
        $success           = 0;
        $path = $request->file('product_excel')->getRealPath();
        $data = Excel::load($path)->toArray();
        $totalRows = count($data);
        if ($totalRows > 0) {

            foreach ($data as $key => $row) {
                if (!empty($row['name']) && !empty($row['item_code'])) {
                    $product = Product::where("product_name", $row['name'])->orWhere("product_code", $row['item_code'])->get();
                    if (count($product)) {
                        $faultCount += 1;
                        continue;
                    }
                } else {
                    $faultCount += 1;
                    continue;
                }
                if ($row['category'] != "") {
                    $categories = explode(',', $row['category']);
                    $categoryData  = Category::whereIn('category_id', $categories)->get();
                    if (count($categories) != count($categoryData)) {
                        $faultCount += 1;
                        continue;
                    }
                }
                DB::beginTransaction();
                try {
                    $productData = array(
                        'product_code'              => $row['item_code'],
                        'product_name'              => ucwords($row['name']),
                        'product_categories'        => $row['category'],
                        'product_price'             => $row['price'],
                        'product_discounted_price'  => $row['discount_price'],
                        'product_colors'            => $row['color'],
                        'product_fabrics'           => $row['fabric'],
                        'product_occasions'         => $row['occasion'],
                        'product_sizes'             => $row['standard_size'],
                        'product_description'       => $row['description'],
                        'product_image'             => $row['image_name'],
                        'product_accessories'       => $row['accessories'],
                        'measurement_id'            => $row['measurement'],
                        'product_weight'            => $row['weight'],
                        'product_timetoship'        => $row['time_to_ship'] . " days",
                        'product_notes'             => $row['note'],
                        'hot_seller'              => $row['hot_seller'],
                    );
                    $product = Product::create($productData);
                    $_productId = $product->product_id;

                    // Category Ids for product
                    if ($row['category']) {

                        foreach ($categories as $key => $_category) {
                            $_productCategory               = new ProductCategory;
                            $_productCategory->product_id   = $_productId;
                            $_productCategory->category_id  = $_category;
                            $_productCategory->save();
                        }
                    }
                    // ---------------------
                    // Color Ids for products
                    if ($row['color']) {
                        $colors = explode(',', $row['color']);
                        foreach ($colors as $key => $_color) {
                            $_productColor                = new ProductColor;
                            $_productColor->product_id    = $_productId;
                            $_productColor->color_id      = $_color;
                            $_productColor->save();
                        }
                    }
                    // ---------------------
                    // Fabric Ids for product
                    if ($row['fabric']) {
                        $fabrics = explode(',', $row['fabric']);
                        foreach ($fabrics as $key => $_fabric) {
                            $_productFabric               = new ProductFabric;
                            $_productFabric->product_id   = $_productId;
                            $_productFabric->fabric_id    = $_fabric;
                            $_productFabric->save();
                        }
                    }
                    // ----------------------
                    // Occasion Ids for product
                    if ($row['occasion']) {
                        $occasions = explode(',', $row['occasion']);
                        foreach ($occasions as $key => $_occasion) {
                            $_productOccasion               = new ProductOccasion;
                            $_productOccasion->product_id   = $_productId;
                            $_productOccasion->occasion_id  = $_occasion;
                            $_productOccasion->save();
                        }
                    }
                    // --------------------
                    // Size Ids for product
                    if ($row['standard_size']) {
                        $sizes = explode(',', $row['standard_size']);
                        foreach ($sizes as $key => $_size) {
                            $_productSize              = new ProductSize;
                            $_productSize->product_id  = $_productId;
                            $_productSize->size_id     = $_size;
                            $_productSize->save();
                        }
                    }
                    // --------------------
                    // Accessories Ids for product
                    if ($row['accessories']) {
                        $accessories = explode(',', $row['accessories']);
                        foreach ($accessories as $key => $_accessory) {
                            $_productAccessory                = new ProductAccessories;
                            $_productAccessory->product_id    = $_productId;
                            $_productAccessory->accessory_id  = $_accessory;
                            $_productAccessory->save();
                        }
                    }
                    DB::commit();
                } /*try ends*/ catch (\Exception $e) {
                    $product         = null;
                    $error_message   = $e->getMessage();
                    DB::rollback();
                }
            } /*for each ends*/
        } /*if ends*/
        // if($product == null){
        //    p($error_message);
        // }
        if ($faultCount == $totalRows) {
            // Set notification
            $error_msg = "Please check the category id, also keep unique product name and product code in excel. No new product has been uploaded";
            $notification = [
                '_status'  => false,
                '_message' => $error_msg,
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->route('adminPanel.product.uploadExcelIndex')->withInput()->with(['notification' => $notification]);
        } else {
            // Set notification
            $success = $totalRows - $faultCount;
            $notification = [
                '_status'  => true,
                '_message' => __('messages.excel_file_uploaded', ['success' => $success, 'record' => 'Product']),
                '_type'    => 'success'
            ];
            //-----------------
            return redirect()->route('adminPanel.product.index')->with(['notification' => $notification]);
        }
    }
    /**
     * Demo excel download
     * @return file;
     * @author Bhagirath
     */
    public function downloadExcel()
    {

        $file = config('constants.productExcel.download_path') . 'demo-excel.xls';
        return response()->download($file, 'demo-excel.xls');
    }

    // -----------------------

    // Zip file uploadtion

    /**
     * Zip file upload view page
     *
     * @return Mixed
     * @author Bhagirath
     * @create_at 27 March 2020
     *
     */
    public function uploadZipIndex()
    {
        return view('admin-panel.product.upload-zip');
    }

    /**
     * Zip file store
     *
     * @return Boolean
     * @author Bhagirath
     * @create_at 27 March 2020
     *
     */
    public function uploadZip(Request $request)
    {

        $zip = Zip::open($request['product_zip']);
        // Use 0077 if destination folder does not exist.

        $zip->setMask(0755);
        // ---------------
        // Variable to store the images names
        $imageNames = $zip->listFiles();

        // ----------------------------------
        $result = $zip->extract("storage/app/public/uploads/images/product/product_image");
        // Path for thumb images
        $destinationThumbPath =  config('constants.products.thumb_images_path');
        // -------------------
        // if images extracted successfully.
        // create the thumbnail of each uploaded image.
        if ($result == 1) {
            foreach ($imageNames as $key => $defaultImageName) {

                if (!File::exists($destinationThumbPath)) {
                    File::makeDirectory($destinationThumbPath, 0777, true);
                }
                // Create thumbnail with compress
                $src = get_image_url(config('constants.products.images_path'), $defaultImageName); // Get Image
                $img = new ImageCompress; // Begin
                $img->set_img($src); // Set Path
                $img->set_quality(80); // Set Quality
                $img->set_size(200); // Set Pixel
                $img->save_img($destinationThumbPath . $defaultImageName); // Save Image
                $img->clear_cache();  // Clear Image Cache
            }
            $response = [
                '_status'  => true,
                '_message' => __('messages.zip_file_uploaded', ['record' => 'Product Image']),
                '_type'    => 'success'
            ];
            return redirect()->route('adminPanel.product.index')->with(['notification' => $response]);
        } else {
            $response = [
                '_status'  => true,
                '_message' => __('messages.zip_file_upload_failed', ['record' => 'product image']),
                '_type'    => 'success'
            ];
            return redirect()->back()->withInput()->with(['notification' => $response]);
        }
    }
    // -------------------
}
