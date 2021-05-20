<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Category\Category;
use App\Model\Product\ProductCategory;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateCategory;
use App\Http\Traits\UploadImage;

class CategoryController extends Controller
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
     * View Category
     * @author Bhagirath
     * @create_at 05-Feb-2020
     */

    public function index()
    {
        return view('admin-panel.category.index');
    }

    /**
     * View create Category.
     *
     * @author Bhagirath
     * @create_at 05-Feb-2020
     */
    public function create()
    {
        $categoreis = Category::where('category_root_id', '')->get();
        $isRootOptions = array(
            '1'  => 'Yes',
            '2'  => 'No',
        );
        $data = array(
            'categories'    => $categoreis,
            'isRootOptions' => $isRootOptions,
        );
        return view('admin-panel.category.create')->with($data);
    }

    public function getSubParentCategory(Request $request)
    {
        $subParentCategory = Category::select('*')
            ->where(['category_root_id' => $request['category_id'], 'category_subroot_id' => 0])
            ->get();
        if (count($subParentCategory)) {
            $response = [
                '_status' => true,
                '_message' => __('message.record_found', ['record' => 'Sub Parent Categories']),
                '_data' => $subParentCategory,
            ];
        } else {
            $response = [
                '_status' => false,
                '_message' => __('message.record_not_found', ['record' => 'Sub Parent Categories']),
                '_data' => [],
            ];
        }
        return response()->json($response, 200);
    }
    /**
     * Check Category Name.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkCategoryName(Request $request)
    {
        $status = false;

        if (!is_null($request->category_name)) {
            $category = Category::where('category_name', $request['category_name'])->first();

            if (!is_null($category)) {
                if ($request->filled('id') && $category->category_id == dv($request['id'])) {
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
     * Store category.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 06 Feb 2020
     */
    public function store(ValidateCategory $request)
    {

        $user              = auth()->user();
        $category          = false;
        $error_message     = null;

        // Upload chart
        if ($request->hasFile('category_image')) {

            $category_image = $this->uploadImage($request->file('category_image'), config('constants.category.images_path'), 75);
            if ($category_image['_status']) {
                $category_image_name = $category_image['_data'];
            }
        }
        //------------------
        if ($request->hasFile('category_chart')) {

            $size_chart = $this->uploadImage($request->file('category_chart'), config('constants.category.sizeChart_path'), 75);
            if ($size_chart['_status']) {
                $size_chart_name = $size_chart['_data'];
            }
        }
        //------------------
        DB::beginTransaction();

        if ($request['isRoot'] == "1") {
            $category_root_id = 0;
            $category_sub_root_id = 0;
        } else {
            $category_root_id      = $request['parent'];
            $category_sub_root_id  = $request['subParent'];
        }
        // Create Category
        try {

            // Set data
            $data = [
                'category_name'                 => ucwords($request['category_name']),
                'category_root_id'              => $category_root_id ?? 0,
                'category_subroot_id'           => $category_sub_root_id ?? 0,
                'category_image'                => $category_image_name ?? "None",
                'size_chart'                    => $size_chart_name,
                'category_desc'                 => $request['category_description'],
                'category_meta_title'           => $request['meta_title'],
                'category_meta_description'     => $request['meta_description'],
                'category_meta_keywords'        => $request['meta_keywords'],
                'category_heading'              => $request['category_heading']
            ];
            //---------

            $category = Category::create($data);


            $ch = curl_init("https://www.bagteshfashion.com/generate_sitemap.php");
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = json_decode(curl_exec($ch));


            DB::commit();
        } catch (\Exception $e) {
            $category        = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (!is_null($category)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Category']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.category.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Category']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.category.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     * Get categoreis list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 06 Feb 2020
     */
    public function getCategories(Request $request)
    {

        $auth_user = auth()->user();
        $categories = Category::with('parent_cat')->with('sub_category')->where(function ($query) use ($request, $auth_user) {
            if (!empty($request) && !empty($request->input('category_name'))) {
                $query->whereRaw('lower(category_name) LIKE ? ', [trim(strtolower('%' . $request->input('category_name'))) . '%']);
            }
        })->orderBy('category_id', 'DESC')->get();
        return DataTables::of($categories)
            ->addColumn('image', function ($categories) {
                $image = get_image_url(config('constants.category.images_path'), $categories->category_image);
                if (!empty($image)) {
                    return '<img src="' . $image . '" width="50px"/> ';
                } else {
                    return "N/A";
                }
            })
            ->addColumn('parent_category', function ($categories) {
                if ($categories->parent_cat->category_id != 0) {
                    return $categories->parent_cat->category_name;
                } else {
                    return "None";
                }
            })
            ->addColumn('sub_category', function ($categories) {
                if ($categories->sub_category->category_id != 0) {
                    return $categories->sub_category->category_name;
                } else {
                    return "None";
                }
            })
            ->addColumn('status', function ($categories) {
                $status = '';
                if ($categories->category_status == 0) {
                    $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
                } else {
                    $status .= '<label class="badge badge-success">Active</label> &nbsp;';
                }
                return $status;
            })
            ->addColumn('action', function ($categories) {

                $action = '<a href="' . route('adminPanel.category.edit', ['id' => ev($categories->category_id)]) . '" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

                return $action;
            })
            ->addColumn('category_order', function ($categories) {
                $order .= "<input type='number' name=id[] class='form-control text-left' value='" . $categories->category_id . "' min='0' hidden/>";
                $order .= "<input type='number' name=order[] title='Enter only positive numbers' class='form-control text-left' value='" . $categories->category_order . "' min='0'/>";
                return $order;
            })
            ->rawColumns([
                'action'             => 'action',
                'status'             => 'status',
                'description'        => 'description',
                'image'              => 'image',
                'chart'              => 'chart',
                'sub_category'       => 'sub_category',
                'parent_category'    => 'parent_category',
                'category_order'     => 'category_order',
            ])->addIndexColumn()->make(true);
    }
    /**
     * Get trashed categoreis list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 06 Feb 2020
     */
    // public function getTrashCategories(Request $request)
    // {

    //     $auth_user = auth()->user();
    //     $categories = Category::onlyTrashed()->with('parent_cat')->with('sub_category')->where(function($query) use ($request, $auth_user)
    //     {
    //         if (!empty($request) && !empty($request->input('category_name')))
    //         {
    //             $query->whereRaw('lower(category_name) LIKE ? ',[trim(strtolower('%'.$request->input('category_name'))).'%']);
    //         }
    //     })->orderBy('category_id', 'DESC')->get();
    //     return DataTables::of($categories)
    //     ->addColumn('image', function ($categories)
    //     {
    //         $image = get_image_url(config('constants.category.images_path'), $categories->category_image);
    //         if(!empty($image))
    //         {
    //             return '<img src="'.$image.'" width="50px"/> ';
    //         }
    //         else{
    //             return "N/A";
    //         }
    //     })
    //     ->addColumn('parent_category',function($categories)
    //     {
    //         if ($categories->parent_cat->category_id !=0) {
    //             return $categories->parent_cat->category_name;
    //         }
    //         else
    //         {
    //             return "None";
    //         }
    //     })
    //     ->addColumn('sub_category',function($categories)
    //     {
    //         if ($categories->sub_category->category_id !=0) {
    //             return $categories->sub_category->category_name;
    //         }
    //         else
    //         {
    //             return "None";
    //         }
    //     })
    //     ->addColumn('chart', function ($categories)
    //     {
    //         if ($categories->size_chart!="") {
    //             $sizeChart = get_image_url(config('constants.category.sizeChart_path'), $categories->size_chart);
    //             if(!empty($sizeChart))
    //             {
    //                 return '<img src="'.$sizeChart.'" width="50px"/> ';
    //             }
    //             else{
    //                 return "N/A";
    //             }
    //         }
    //         else
    //         {
    //                 return "N/A";
    //         }
    //     })
    //     ->addColumn('status', function ($categories) {
    //         $status = '';
    //         if ( $categories->category_status == 0 ){
    //             $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
    //         } else {
    //             $status .= '<label class="badge badge-success">Active</label> &nbsp;';
    //         }
    //         return $status;
    //     })
    //     ->addColumn('action', function ($categories) {

    //         $action = '<a href="'.route('adminPanel.category.edit', ['id' => ev($categories->category_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

    //         return $action;
    //     })
    //     ->addColumn('category_order', function ($categories) {
    //         $order .= "<input type='number' name=id[] class='form-control text-left' value='".$categories->category_id."' min='0' hidden/>";
    //         $order .= "<input type='number' name=order[] class='form-control text-left' value='".$categories->category_order."' min='0'/>";
    //         return $order;
    //     })
    //     ->rawColumns([
    //         'action'             => 'action',
    //         'status'             => 'status',
    //         'description'        => 'description',
    //         'image'              => 'image',
    //         'chart'              => 'chart',
    //         'sub_category'       => 'sub_category',
    //         'parent_category'    => 'parent_category',
    //         'category_order'     => 'category_order',
    //     ])->addIndexColumn()->make(true);
    // }

    /**
     * Move to trash.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 16 April 2020
     */
    public function moveToTrash(Request $request)
    {

        $ids            = $request['ids'];

        $category         = Category::whereIn('category_id', $ids)->delete();

        // $product   =  ProductCategory::whereIn('category_id',$ids)->get();
        // if(count($product) > 0){
        //     $response = [
        //         '_status'  => false,
        //         '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'category']),
        //         '_type'    => 'error'
        //     ];
        //     return response()->json($response, 200);
        // }
        // elseif (count(Category::whereIn('category_root_id',$ids)->orWhereIn('category_subroot_id',$ids)->get()) > 0) {
        //     $response = [
        //         '_status'  => false,
        //         '_message' => __('messages.cannot_delete_main_category', ['record' => 'category']),
        //         '_type'    => 'error'
        //     ];
        //     return response()->json($response, 200);
        // }
        // else
        // {
        //     $category         = Category::whereIn('category_id', $ids)->delete();
        // }
        // Set response

        if ($category == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Category']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'category']),
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
     * @created_at 16 April 2020
     */
    // public function viewTrash()
    // {
    //     return view("admin-panel.category.trash");
    // }
    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 10 Feb 2020
     */
    public function changeStatus(Request $request)
    {

        foreach ($request['ids'] as $value) {
            $category = Category::find($value);
            if ($category->category_status == 1) {
                $category->category_status = 0;
                $category->save();
            } else {
                $category->category_status = 1;
                $category->save();
            }
        }

        // Set response
        if (!is_null($category)) {
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
     * View edit category.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Bhagirath
     * @created_at 03 March 2020
     */
    public function edit(Request $request, $id)
    {
        // to select the category to be edited
        $category       = Category::where('category_id', dv($id))->first();
        $category_image = get_image_url(config('constants.category.images_path'), $category->category_image);
        $size_chart     = get_image_url(config('constants.category.sizeChart_path'), $category->size_chart);
        // ----------------------------------

        // to select the list of parent root categories
        $categories = Category::where('category_root_id', 0)->get();
        // --------------------------------------------

        // to select the list of categoreis belonging to the parent categories
        $sub_categories = Category::where('category_root_id', $category->category_root_id)->where('category_subroot_id', '=', 0)->get();
        // ------------------------------------------------------------------

        // ViewData Array
        $this->viewData['category_image'] = $category_image;
        $this->viewData['size_chart']     = $size_chart;
        $this->viewData['category']       = $category;
        $this->viewData['categories']     = $categories;
        $this->viewData['sub_categories'] = $sub_categories;
        // -------------

        return view('admin-panel.category.edit')->with($this->viewData);
    }

    /**
     * Change order.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 16 April 2020
     */
    public function changeOrder(Request $request)
    {

        foreach ($request['id'] as $key => $value) {
            DB::beginTransaction();
            try {
                $category = Category::find($value);
                if ($request['order'][$key] < 0) {
                    $category->category_order = 0;
                } else {
                    $category->category_order = $request['order'][$key] ?? 0;
                }
                $category->save();
                DB::commit();
            } catch (\Exception $e) {
                $category          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($category == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Category']),
                '_type'    => 'success'
            ];
            //-----------------=
            return redirect()->back()->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Category']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     * Update category.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function update(ValidateCategory $request, $id)
    {

        $user             = auth()->user();
        $category         = false;
        $error_message    = null;

        DB::beginTransaction();


        $category            = Category::find(dv($request['id']));
        $category_image_name = $category->category_image;
        $size_chart_name     = $category->size_chart;

        // Upload image
        if ($request->hasFile('category_image')) {
            $category_image = $this->uploadImage($request->file('category_image'), config('constants.category.images_path'), 75);
            if ($category_image['_status']) {
                $category_image_name = $category_image['_data'];
            }
        }
        //--------------
        // Upload chart
        if ($request->hasFile('category_chart')) {
            $size_chart = $this->uploadImage($request->file('category_chart'), config('constants.category.sizeChart_path'), 75);
            if ($size_chart['_status']) {
                $size_chart_name = $size_chart['_data'];
            }
        }
        //-------------
        if ($request['isRoot'] == "1") {
            $category_root_id = 0;
            $category_sub_root_id = 0;
        } else {
            $category_root_id      = $request['parent'];
            $category_sub_root_id  = $request['subParent'];
        }
        // Create Category
        try {

            // Set data
            $category->category_name             = ucwords($request['category_name']);
            $category->category_root_id          = $category_root_id ?? 0;
            $category->category_subroot_id       = $category_sub_root_id ?? 0;
            $category->category_image            = $category_image_name;
            $category->size_chart                = $size_chart_name;
            $category->category_desc             = $request['category_description'];
            $category->category_meta_title       = $request['meta_title'];
            $category->category_meta_description = $request['meta_description'];
            $category->category_meta_keywords    = $request['meta_keywords'];
            $category->category_heading          = $request['category_heading'];
            $category->save();
            //---------
            $ch = curl_init("https://www.bagteshfashion.com/generate_sitemap.php");
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = json_decode(curl_exec($ch));

            DB::commit();
        } catch (\Exception $e) {
            $category          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------
        if ($category == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Category']),
                '_type'    => 'success'
            ];
            //-----------------=
            return redirect()->route('adminPanel.category.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Category']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->route('adminPanel.category.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
