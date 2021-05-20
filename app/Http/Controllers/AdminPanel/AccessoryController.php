<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Accessories\Accessories;
use App\Model\Product\ProductAccessories;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateAccessory;

class AccessoryController extends Controller
{
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
    * View Accessory Index
    * @author Bhagirath 
    * @create_at 06 March 2020
    */

    public function index()
    {
      return view('admin-panel.accessory.index');
  }

    /**
    * Check Accessory Name.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 06 March 2020
    */
    public function checkAccessoryName(Request $request)
    {       
        $status = false;
        if (! is_null($request->accessory_name)) {
            $accessory = Accessories::where('accessory_name', $request['accessory_name'])->first();
            if (! is_null($accessory)) {
                if ($request->filled('id') && $accessory->accessory_id == dv($request['id'])) {
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
     * Store Accessory.
     * 
     * @return mixed
     *  
     * @author Bhagirath 
     * @created_at 07 March 2020
     */
    public function store(ValidateAccessory $request)
    {        
        $user                 = auth()->user();
        $accessory            = false;
        $error_message        = null;


        DB::beginTransaction();
        // Create Accessory
        try {

        // Set data
            $data = [
                'accessory_name'              => ucwords($request['accessory_name']),   
                'accessory_price'             => $request['accessory_price'],
            ];
        //---------

            $accessory = Accessories::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $accessory          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($accessory)) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Accessory']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.accessory.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Accessory']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.accessory.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
    * Get Accessories list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 07 March 2020
    */
    public function getAccessories(Request $request)
    {

        $auth_user = auth()->user();

        $accessories = Accessories::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('accessory_name')))
            {
                $query->whereRaw('lower(accessory_name) LIKE ? ',[trim(strtolower('%'.$request->input('accessory_name'))).'%']);
            }
        })->orderBy('accessory_id', 'DESC')->get();
        return DataTables::of($accessories)
        ->addColumn('status', function ($accessories) {
            $status = '';
            if ( $accessories->accessory_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('accessory_price', function($accessories){
            return '$ '.$accessories->accessory_price;
        })
        ->addColumn('action', function ($accessories) {

            $action = '<a href="'.route('adminPanel.accessory.edit', ['id' => ev($accessories->accessory_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

            return $action;
        })
        ->rawColumns([
            'action'          => 'action',
            'status'          => 'status',
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
        $ids                = $request['ids'];
        $productAccessories = ProductAccessories::withTrashed()->where('accessory_id',$ids)->get();

        if (count($productAccessories)==0) {
            // Set response
            $accessory         = Accessories::whereIn('accessory_id', $ids)->delete();
            if ( $accessory == true ) {
                $response = [
                    '_status'  => true,
                    '_message' => __('messages.record_deleted', ['record' => 'Accessory']),
                    '_type'    => 'success'
                ];
            } else {
                $response = [
                    '_status'  => false,
                    '_message' => __('messages.record_failed', ['record' => 'Accessory']),
                    '_type'    => 'error'
                ];
            }
            //-------------
        }
        else{
            $response = [
                '_status'  => false,
                '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'Accessory']),
                '_type'    => 'error'
            ];
        }

        return response()->json($response, 200);
    }
    /**
    * View create Accessory.
    * 
    * @author Bhagirath 
    * @create_at 07-March-2020
    */
    public function create()
    {

        return view('admin-panel.accessory.create');

    }

    /**
    * Change status.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 06 March 2020
    */
    public function changeStatus(Request $request)
    {

        foreach ($request['ids'] as $value) {
            $accessory = Accessories::find($value);
            if ($accessory->accessory_status == 1) {
                $accessory->accessory_status = 0;
                $accessory->save();
            }
            else
            {
                $accessory->accessory_status = 1;
                $accessory->save();

            }
        }
            // Set response
        if (!is_null($accessory)) {
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
    * View edit Accessory.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 06 March 2020
    */
    public function edit(Request $request, $id)
    {
        $accessory = Accessories::where('accessory_id', dv($id))->first();
        $this->viewData['accessory'] = $accessory;

        return view('admin-panel.accessory.edit')->with($this->viewData);
    }
    /**
    * Update Accessory.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 06 March 2020
    */
    public function update(ValidateAccessory $request, $id)
    {

        $user             = auth()->user();
        $accessory           = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Accessory
        try {

        // Set data
            $data = [
                'accessory_name'              => ucwords($request['accessory_name']),   
                'accessory_price'              => $request['accessory_price'],
            ];
        //---------

            $accessory = Accessories::find(dv($id))->update($data);
            DB::commit();
        } 
        catch (\Exception $e) {
            $accessory          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if ($accessory == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Accessory']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.accessory.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Accessory']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.accessory.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
