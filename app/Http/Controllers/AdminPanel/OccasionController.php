<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Occasion\Occasion;
use App\Model\Product\ProductOccasion;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateOccasion;

class OccasionController extends Controller
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
    * View Occasions
    * @author Bhagirath 
    * @create_at 05-Feb-2020
    */

	public function index()
	{
		return view('admin-panel.occasion.index');
	}

    /**
     * Check Occasion Name.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkoccasionTitle(Request $request)
    {
        $status = false;

        if (! is_null($request->occasion_name)) {
            $occasion = Occasion::where('occasion_name', $request['occasion_name'])->first();
            if (! is_null($occasion)) {
                if ($request->filled('id') && $occasion->occasion_id == dv($request['id'])) {
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
    * Store Occasion.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 13 Feb 2020
    */
    public function store(ValidateOccasion $request)
    {
        $user            = auth()->user();
        $occasion          = false;
        $error_message   = null;

        DB::beginTransaction();
        // Create Occasion
        try {

            // Set data
            $data = [
                'occasion_name'              => $request['occasion_name'],   
            ];
            //---------

            $occasion = Occasion::create($data);
            
            DB::commit();
        } catch (\Exception $e) {
            $occasion          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($occasion)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Occasion']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.occasion.index')->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Occasion']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.occasion.create')->withInput()->with(['notification' => $notification]);
        }
    }

    /**
    * Get categoreis list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 13 Feb 2020
    */
    public function getOccasions(Request $request)
    {
        $auth_user = auth()->user();

        $occasions = Occasion::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('occasion_name')))
            {
                $query->whereRaw('lower(occasion_name) LIKE ? ',[trim(strtolower('%'.$request->input('occasion_name'))).'%']);
            }
        })->orderBy('occasion_id', 'DESC')->get();
        return DataTables::of($occasions)
        ->addColumn('status', function ($occasions) {
            $status = '';
            if ( $occasions->occasion_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($occasions) {

            $action = '<a href="'.route('adminPanel.occasion.edit', ['id' => ev($occasions->occasion_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

            return $action;
        })
        ->addColumn('occasion_order', function ($occasions) {

           $order .= "<input type='number' name=id[] class='form-control text-left' value='".$occasions->occasion_id."' hidden/>";
           $order .= "<input type='number' name=order[] title='Enter positive number only' class='form-control text-left' value='".$occasions->occasion_order."' min='0'/>";

           return $order;
       })
        ->rawColumns([
            'action'         => 'action',
            'status'         => 'status',
            'occasion_order' => 'occasion_order',
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
                $occasion = Occasion::find($value);
                if ($request['order'][$key] < 0) {
                    $occasion->occasion_order = 0;
                }
                else{
                    $occasion->occasion_order = $request['order'][$key] ?? 0;
                }
                $occasion->save();
                DB::commit();
            }
            catch (\Exception $e) {
                $occasion          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($occasion == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Occasion']),
                '_type'    => 'success'
            ];
        //-----------------=
            return redirect()->back()->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Occasion']),
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
    * @created_at 13 Feb 2020
    */
    public function destroy(Request $request)
    {
        $ids              = $request['ids'];
        $productOccasion  = ProductOccasion::withTrashed()->whereIn('occasion_id',$ids)->get();
        if (count($productOccasion)==0) {         
        $occasion         = Occasion::whereIn('occasion_id', $ids)->delete();

        // Set response
        if ( $occasion == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Occasion']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Occasion']),
                '_type'    => 'error'
            ];
        }
        //-------------
        }
        else{
            $response = [
                '_status'  => false,
                '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'Occasion']),
                '_type'    => 'error'
            ];
        }


        return response()->json($response, 200);
    }
    /**
    * View create Occasion.
    * 
    * @author Bhagirath 
    * @create_at 13-Feb-2020
    */
    public function create()
    {
        return view('admin-panel.occasion.create');
    }

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
            $occasion = Occasion::find($value);
            if ($occasion->occasion_status == 1) {
                $occasion->occasion_status = 0;
                $occasion->save();
            }
            else
            {
                $occasion->occasion_status = 1;
                $occasion->save();

            }
        }
// Set response
        if (!is_null($occasion)) {
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
    * View edit occasion.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 10 Feb 2020
    */
    public function edit(Request $request, $id)
    {
        $occasion = Occasion::where('occasion_id', dv($id))->first();
        $this->viewData['occasion'] = $occasion;

        return view('admin-panel.occasion.edit')->with($this->viewData);
    }

    /**
    * Update occasion.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 10 Feb 2020
    */
    public function update(ValidateOccasion $request, $id)
    {
        $user             = auth()->user();
        $occasion         = false;
        $error_message    = null;
        DB::beginTransaction();

        // Update occasion
        try {

            $occasion = Occasion::find(dv($id));
            $occasion->occasion_name = $request['occasion_name'];
            $occasion->save();

        //---------
            DB::commit();
        } catch (\Exception $e) {
            $occasion          = null;
            $error_message   = $e->getMessage();

            DB::rollback();
        }
        //----------------------

        if ($occasion == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Occasion']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.occasion.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Occasion']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.occasion.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
