<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\BlouseDesign\BlouseDesign;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateBlouse;
use App\Http\Traits\UploadImage;

class BlouseController  extends Controller
{
    use UploadImage;
   /**
     * Update a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
      $this->middleware('auth.admin');
    }

    /**
    * View Blouses
    * @author Bhagirath 
    * @create_at 15 Feb 2020
    */
	public function index()
	{
		return view('admin-panel.blouse-design.index');
	}

	/**
     * Check Blouse Name.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 15 Feb 2020
    */
    public function checkBlouseTitle(Request $request)
    {
        $status = false;
        if (! is_null($request->blouse_title)) {
            $designs = BlouseDesign::where('blouse_design_name', $request['blouse_title'])->first();
            if (! is_null($designs)) {
                if ($request->filled('id') && $designs->blouse_design_id == dv($request['id'])) {
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
    * Store Blouse.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 15 Feb 2020
    */

    public function store(ValidateBlouse $request)
    {
    	
        $user            = auth()->user();
        $designs            = false;
        $error_message   = null;

        // Upload chart
        $blouse_design_image_name = "";
        if ($request->hasFile('blouse_design_image')) 
        {
            $blouse_design_image = $this->uploadImage($request->file('blouse_design_image'), config('constants.blouseDesign.images_path'), 75);
            if ($blouse_design_image['_status']) 
            {
              $blouse_design_image_name = $blouse_design_image['_data'];
            }
        }
        
        //------------------
       DB::beginTransaction();
        // Create Blouse Design
        try {
        // Set data
        $designs = new BlouseDesign;
        $designs->blouse_design_name    = $request['blouse_title'];  
        $designs->blouse_design_image   = $blouse_design_image_name;
        //---------
        $designs->save();
        DB::commit();
        }
        catch (\Exception $e) {
        $designs          = null;
        $error_message   = $e->getMessage();
        DB::rollback();
        }
        //----------------------

        if (! is_null($designs)) {
        // Set notification
        $notification = [
            '_status'  => true,
            '_message' => __('messages.record_created', ['record' => 'Blouse Design']),
            '_type'    => 'success'
        ];
        //-----------------

        return redirect()->route('adminPanel.blouse.index')->with(['notification' => $notification]);

        } else {
        // Set notification
        $notification = [
            '_status'  => false,
            '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Blouse Design']),
            '_type'    => 'error'
        ];
        //-----------------
        return redirect()->route('adminPanel.blouse.create')->withInput()->with(['notification' => $notification]);

        }
    }

    /**
    * Get designs list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 15 Feb 2020
    */
    public function getdesigns(Request $request)
    {
        $auth_user = auth()->user();

        $designs = BlouseDesign::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('blouse_title')))
            {
                $query->whereRaw('lower(blouse_design_name) LIKE ? ',[trim(strtolower('%'.$request->input('blouse_title'))).'%']);
            }
        })->orderBy('blouse_design_id', 'DESC')->get();
        
        return DataTables::of($designs)
        ->addColumn('status', function ($designs) {
            $status = '';
            if ( $designs->blouse_design_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($designs) {

            $action = '<a href="'.route('adminPanel.blouse.edit', ['id' => ev($designs->blouse_design_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            
            return $action;
        })
        ->addColumn('chart',function($designs){
            if ($designs->blouse_design_image != "") {
               $image_url = get_image_url(config('constants.blouseDesign.images_path'),$designs->blouse_design_image);
               if ($image_url) {
                return '<img src="'.$image_url.'" width="50px"/>';
                }
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('blouse_design_order', function ($designs) {
            $order .= "<input type='number'  name=id[] class='form-control text-left' value='".$designs->blouse_design_id."' min='0' hidden/>";
            $order .= "<input type='number' title='Enter only positive numbers' name=order[] class='form-control text-left' value='".$designs->blouse_design_order."' min='0'/>";
            return $order;
        })
        ->rawColumns([
            'chart'                   => 'chart',
            'action'                  => 'action',
            'status'                  => 'status',
            'blouse_design_order'     => 'blouse_design_order',
        ])->addIndexColumn()->make(true);
    }

    /**
    * Destroy.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 15 Feb 2020
    */
    public function destroy(Request $request)
    {

        
        $designs         = BlouseDesign::whereIn('blouse_design_id', $request['ids'])->delete();
        // Set response
        if ( $designs == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Blouse Design']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Blouse Design']),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
    * View create Blouse Design.
    * 
    * @author Bhagirath 
    * @create_at 15-Feb-2020
    */
    public function create()
    {
        return view('admin-panel.blouse-design.create');
    }

    /**
    * Change status.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 15 Feb 2020
    */
    public function changeStatus(Request $request)
    {
        
        foreach ($request['ids'] as $value) {
            $designs = BlouseDesign::find($value);
            if ($designs->blouse_design_status == 1) {
                $designs->blouse_design_status = 0;
                $designs->save();
            }
            else
            {
                $designs->blouse_design_status = 1;
                $designs->save();

            }
        }

        // Set response
            if (!is_null($designs)) {
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
    * View edit Blouse.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 15 Feb 2020
    */
    public function edit(Request $request, $id)
    {
        $design = BlouseDesign::where('blouse_design_id', dv($id))->first();
        $image_url = get_image_url(config('constants.blouseDesign.images_path'),$design->blouse_design_image);
        $this->viewData['design']       = $design;
        $this->viewData['image_url']    = $image_url; 
        return view('admin-panel.blouse-design.edit')->with($this->viewData);
    }

    /**
     * Update Blouse.
     * 
     * @return mixed
     *  
     * @author Bhagirath
     * @created_at 26 Feb 2020
     */
    public function update(ValidateBlouse $request, $id)
    {
        $user             = auth()->user();
        $designs          = false;
        $error_message    = null;
        // Upload chart
        $designs = BlouseDesign::find(dv($id)); 
        // To store the old image name if now new image is uploaded.
        $blouse_design_image_name = $designs->blouse_design_image; 
        if ($request->hasFile('blouse_design_image')) 
        {
            $blouse_design_image = $this->uploadImage($request->file('blouse_design_image'), config('constants.blouseDesign.images_path'), 75);
            if ($blouse_design_image['_status']) 
            {
                $blouse_design_image_name = $blouse_design_image['_data'];
            }
        }
        //------------------
        DB::beginTransaction();
        // Update Blouse Design
        try {
        // Set data
            $designs->blouse_design_name    = $request['blouse_title'];  
            $designs->blouse_design_image   = $blouse_design_image_name;
        //---------
            $designs->save();
            DB::commit();
        }
        catch (\Exception $e) {
            $designs          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if ($designs == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Blouse Design']),
                '_type'    => 'success'
            ];
        //-----------------
            return redirect()->route('adminPanel.blouse.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Blouse Design']),
                '_type'    => 'error'
            ];
        //-----------------
            return redirect()->route('adminPanel.blouse.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
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
               $blouseDesign = BlouseDesign::find($value);
               if ($request['order'][$key] < 0) {
                $blouseDesign->blouse_design_order =  0;
               }    
               else{
                $blouseDesign->blouse_design_order = $request['order'][$key] ?? 0;
               }
               $blouseDesign->save();
                DB::commit();
            }
            catch (\Exception $e) {
                $blouseDesign          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($blouseDesign == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Blouse Design']),
                '_type'    => 'success'
            ];
        //-----------------=
            return redirect()->back()->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Blouse Design']),
                '_type'    => 'error'
            ];
        //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }

}
