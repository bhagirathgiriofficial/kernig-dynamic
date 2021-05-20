<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Gallary\Gallary;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateGallary; 
use App\Http\Traits\UploadImage;

class GallaryController extends Controller
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
		* View Gallary
		* @author Bhagirath 
		* @create_at 20-Feb-2020
	*/

		public function index ()
		{
			return view('admin-panel.gallary.index');

		}

	/**
     * View Create Gallary.
     * 
     * @author Bhagirath 
	 * @create_at 20 -Feb- 2020
     */
	public function create()
	{
		return view('admin-panel.gallary.create');
	}
	/**
     * Check Gallary Name.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkGallaryTitle(Request $request)
    {

        $status = false;
        if (! is_null($request->image_title)) {
            $gallary = Gallary::where('image_title', $request['image_title'])->first();
            if (! is_null($gallary)) {
                if ($request->filled('id') && $gallary->image_id == dv($request['id'])) {
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
    * Store Gallary.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 20 Feb 2020
    */
    public function store(ValidateGallary $request)
    {

        $user                = auth()->user();
        $gallary             = false;
        $error_message       = null;

        // Upload chart
        $gallary_image_name = ""; 
        if ($request->hasFile('gallary_image')) 
        {
            $gallary_image = $this->uploadImage($request->file('gallary_image'), config('constants.gallary.images_path'), 75);
            if ($gallary_image['_status']) 
            {
                $gallary_image_name = $gallary_image['_data'];
            }
        }
        //------------------
        DB::beginTransaction();
        // Create Measurment
        try {
        // Set data
            $data = [
                'image_title'   => $request['image_title'],
                'image_desc'    => $request['image_description'],
                'gallary_image' => $gallary_image_name,
            ];
        //---------
            $gallary = Gallary::create($data);
            DB::commit();

        } catch (\Exception $e) {
            $gallary          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($gallary)) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Gallary']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.gallary.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Gallary']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.gallary.create')->withInput()->with(['notification' => $notification]);
        }
    }
                 /**
     * Get Gallary list.
     * 
     * @return response
     *  
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function getGallary(Request $request)
    {

        $auth_user = auth()->user();
        $gallary = Gallary::where(function($query) use ($request){
            if (!empty($request) && !empty($request->input('image_title')))
            {

                $query->whereRaw('lower(image_title) LIKE ?', [trim(strtolower('%'.$request->input('image_title'))).'%']);
            }
        })->orderBy('image_id', 'DESC')->get();

        return DataTables::of($gallary)
        ->addColumn('status', function ($gallary) {
            $status = '';
            if ( $gallary->image_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($gallary) {

            $action = '<a href="'.route('adminPanel.gallary.edit', ['id' => ev($gallary->image_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            return $action;
        })
        ->addColumn('gallary_image', function ($gallary) {

            $image = get_image_url(config('constants.gallary.images_path'),$gallary->gallary_image);
            if(!empty($image))
            {
                return '<img src="'.$image.'" width="50px"/>';
            }
            else
            {
                return 'N/A';
            }

        })
        ->addColumn('image_desc', function($gallary){
            if ($gallary->image_desc!="") {
                return $gallary->image_desc;
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('gallary_order', function($gallary){
                $order .= "<input type='number' name=id[] class='form-control text-left' value='".$gallary->image_id."' min='0' hidden/>";
                $order .= "<input type='number' name=order[] class='form-control text-left' value='".$gallary->gallary_order."' min='0'/>";

                return $order;
        })
        ->rawColumns([
            'action'             => 'action',
            'status'             => 'status',
            'gallary_image'      => 'gallary_image',
            'image_desc'         => 'image_desc',
            'gallary_order'      => 'gallary_order',
        ])->addIndexColumn()->make(true);
    }
    /**
    * Change order.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 16 April 2020
    */
    public function changeOrder(Request $request){

        foreach ($request['id'] as $key => $value) {
            DB::beginTransaction();
            try
            {
                $gallary = Gallary::find($value);
                $gallary->gallary_order = $request['order'][$key] ?? 0;
                $gallary->save();
                DB::commit();
            }
            catch (\Exception $e) {
                $gallary          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($gallary == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Gallary']),
                '_type'    => 'success'
            ];
        //-----------------=
            return redirect()->back()->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Gallary']),
                '_type'    => 'error'
            ];
        //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }
     /**
     * Destroy.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function destroy(Request $request)
    {
        $gallary         = Gallary::whereIn('image_id',$request['ids'])->delete();
                // Set response
        if ( $gallary == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Gallary']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Gallary']),
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
     * @created_at 12 Feb 2020
     */
    public function changeStatus(Request $request)
    {
        foreach ($request['ids'] as $value) {
            $gallary = Gallary::find($value);
            if ($gallary->image_status == 1) {
                $gallary->image_status = 0;
                $gallary->save();
            }
            else
            {
                $gallary->image_status = 1;
                $gallary->save();  
            }
        }
        // Set response
        if (!is_null($gallary)) {
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
     * View edit Gallary.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Bhagirath
     * @created_at 27 Feb 2020
     */
    public function edit(Request $request, $id)
    {
        $gallary = Gallary::where('image_id', dv($id))->first();
        if($gallary->gallary_image!=""){
            $image_url =  get_image_url(config('constants.gallary.images_path'),$gallary->gallary_image); 
        }
        $this->viewData['gallary'] = $gallary;
        $this->viewData['image_url'] = $image_url;
        return view('admin-panel.gallary.edit')->with($this->viewData);
    }

    /**
    * Update gallary.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 20 Feb 2020
    */
    public function update(ValidateGallary $request, $id)
    {
        $user             = auth()->user();
        $gallary         = false;
        $error_message    = null;

        $gallary = Gallary::find(dv($id));  

        // Upload chart
        $gallary_image_name = $gallary->gallary_image;
        if ($request->hasFile('gallary_image')) 
        {
            $gallary_image = $this->uploadImage($request->file('gallary_image'), config('constants.gallary.images_path'), 75);
            if ($gallary_image['_status']) 
            {
                $gallary_image_name = $gallary_image['_data'];
            }
        }

        //------------------
        DB::beginTransaction();
        // Create Measurment
        try {
        // Set data

            $gallary->image_title   = $request['image_title'];
            $gallary->image_desc    = $request['image_description'] ?? "";
            $gallary->gallary_image = $gallary_image_name;

        //---------
            $gallary->save();
            DB::commit();

        } catch (\Exception $e) {
            $gallary          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------
        if ($gallary == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Gallary']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.gallary.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Gallary']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.gallary.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }




}
