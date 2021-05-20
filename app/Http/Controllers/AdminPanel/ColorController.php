<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Color\Color;
use App\Model\Product\ProductColor;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateColor;

class ColorController extends Controller 
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
    * View Colors
    * @author Bhagirath 
    * @create_at 05-Feb-2020
    */

    public function index()
    {
      return view('admin-panel.color.index');
  }

    /**
    * Check Color Name.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 09 Feb 2020
    */
    public function checkColorName(Request $request)
    {       
        $status = false;
        if (! is_null($request->color_name)) {
            $color = Color::where('color_name', $request['color_name'])->first();
            if (! is_null($color)) {
                if ($request->filled('id') && $color->color_id == dv($request['id'])) {
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
     * Check Color Code.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkColorCode(Request $request)
    {       

        $status = false;
        if (! is_null($request->colorpicker1)) {
            $color = Color::where('color_code', $request['colorpicker1'])->first();
            if (! is_null($color)) {
                if ($request->filled('id') && $color->color_id == dv($request['id'])) {
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
     * Store Color.
     * 
     * @return mixed
     *  
     * @author Bhagirath 
     * @created_at 07 Feb 2020
     */
     public function store(ValidateColor $request)
     {

        $user            = auth()->user();
        $color           = false;
        $error_message   = null;


        DB::beginTransaction();
        // Create Color
        try {

        // Set data
            $data = [
                'color_name'              => ucwords($request['color_name']),   
                'color_code'              => $request['colorpicker1'],
            ];
        //---------

            $color = Color::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $color          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($color)) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Color']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.color.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Color']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.color.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
    * Get categoreis list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 07 Feb 2020
    */
    public function getColors(Request $request)
    {

        $auth_user = auth()->user();

        $colors = Color::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('color_name')))
            {
                $query->whereRaw('lower(color_name) LIKE ? ',[trim(strtolower('%'.$request->input('color_name'))).'%']);
            }
        })->orderBy('color_id', 'DESC')->get();
        return DataTables::of($colors)
        ->addColumn('color', function ($colors){
            if($colors->color_code != "") {
                $color ='<div class="show-color" style="background:'.$colors->color_code.'"></div>';
            } 
            else {
                $color = 'N/A';
            }
            return $color;
        })
        ->addColumn('status', function ($colors) {
            $status = '';
            if ( $colors->color_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($colors) {

            $action = '<a href="'.route('adminPanel.color.edit', ['id' => ev($colors->color_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

            return $action;
        })
         ->addColumn('color_order', function ($colors) {

           $order .= "<input type='number' name=id[] class='form-control text-left' value='".$colors->color_id."' min='0' hidden/>";
           $order .= "<input type='number' name=order[] title='Enter only positive number' class='form-control text-left' value='".$colors->color_order."' min='0'/>";
           return $order;
        })
        ->rawColumns([
            'action'      => 'action',
            'status'      => 'status',
            'color'       => 'color',
            'color_order' => 'color_order',
        ])->addIndexColumn()->make(true);
    }
    /**
    * Destroy.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 07 Feb 2020
    */
    public function destroy(Request $request)
    {
        $ids            = $request['ids'];
        $productColor  = ProductColor::withTrashed()->whereIn('color_id', $ids)->get();
        if (count($productColor)==0) {
            $color         = Color::whereIn('color_id', $ids)->delete();

        // Set response
            if ( $color == true ) {
                $response = [
                    '_status'  => true,
                    '_message' => __('messages.record_deleted', ['record' => 'Color']),
                    '_type'    => 'success'
                ];
            } else {
                $response = [
                    '_status'  => false,
                    '_message' => __('messages.record_failed', ['record' => 'Color']),
                    '_type'    => 'error'
                ];
            }
        //-------------

            return response()->json($response, 200);
        }
        else{
           $response = [
            '_status'  => false,
            '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'Color']),
            '_type'    => 'error'
        ];
        return response()->json($response, 200);
    }
}
    /**
    * View create Color.
    * 
    * @author Bhagirath 
    * @create_at 07-Feb-2020
    */
    public function create()
    {

        return view('admin-panel.color.create');

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
            $color = Color::find($value);
            if ($color->color_status == 1) {
                $color->color_status = 0;
                $color->save();
            }
            else
            {
                $color->color_status = 1;
                $color->save();

            }
        }

            // Set response
        if (!is_null($color)) {
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
                $color = Color::find($value);
                if ($request['order'][$key] < 0) {
                    $color->color_order = 0;
                }
                else{
                    $color->color_order = $request['order'][$key] ?? 0;
                }
                $color->save();
                DB::commit();
            }
            catch (\Exception $e) {
                $color          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($color == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Color']),
                '_type'    => 'success'
            ];
        //-----------------=
            return redirect()->back()->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Color']),
                '_type'    => 'error'
            ];
        //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }
    /**
    * View edit color.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 20 Feb 2020
    */
    public function edit(Request $request, $id)
    {
        $color = Color::where('color_id', dv($id))->first();
        $this->viewData['color'] = $color;

        return view('admin-panel.color.edit')->with($this->viewData);
    }
    /**
    * Update Color.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 20 Feb 2020
    */
    public function update(ValidateColor $request, $id)
    {

        $user             = auth()->user();
        $color           = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Color
        try {

        // Set data
            $data = [
                'color_name'              => ucwords($request['color_name']),   
                'color_code'              => $request['colorpicker1'],
            ];
        //---------

            $color = Color::find(dv($id))->update($data);
            DB::commit();
        } 
        catch (\Exception $e) {
            $color          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if ($color == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Color']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.color.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Color']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.color.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
