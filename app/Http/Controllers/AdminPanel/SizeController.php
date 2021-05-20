<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Size\Size;
use App\Model\Product\ProductSize;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateSize;

class SizeController extends Controller
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
    * View Sizes
    * @author Bhagirath 
    * @create_at 05-Feb-2020
    */

    public function index()
    {
        return view('admin-panel.size.index');
    }

    /**
    * Check Size Name.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 09 Feb 2020
    */
    public function checkSizeTitle(Request $request)
    {
        $status = false;

        if (! is_null($request->size_name)) {
            $size = Size::where('size_measure', $request['size_name'])->first();

            if (! is_null($size)) {
                if ($request->filled('id') && $size->size_id == dv($request['id'])) {
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
    * Store Size.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 13 Feb 2020
    */
    public function store(ValidateSize $request)
    {
        $user            = auth()->user();
        $size            = false;
        $error_message   = null;

        DB::beginTransaction();
        // Create Size
        try {

        // Set data
            $data = [
                'size_measure'              => $request['size_name'],  
                'price_percent'             => $request['size_price'],

            ];
        //---------

            $size = Size::create($data);

            DB::commit();
        } catch (\Exception $e) {
            $size          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($size)) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Size']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.size.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Size']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.size.create')->withInput()->with(['notification' => $notification]);
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
    public function getSizes(Request $request)
    {
        $auth_user = auth()->user();

        $sizes = Size::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('Size_name')))
            {
                $query->whereRaw('lower(size_measure) LIKE ? ',[trim(strtolower('%'.$request->input('Size_name'))).'%']);
            }
        })->orderBy('size_id', 'DESC')->get();
        return DataTables::of($sizes)
        ->addColumn('size_measure', function($sizes){
            if ($sizes->size_measure == 0.00) {
                return $sizes->size_measure." (Unstitched)";
            }
            else{
                return $sizes->size_measure;
            }
        })
        ->addColumn('status', function ($sizes) {
            $status = '';
            if ( $sizes->size_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($sizes) {

            $action = '<a href="'.route('adminPanel.size.edit', ['id' => ev($sizes->size_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

            return $action;
        })
         ->addColumn('size_order', function ($sizes) {

             $order .= "<input type='number' name=id[] class='form-control text-left' value='".$sizes->size_id."' min='0' hidden/>";
             $order .= "<input type='number' name=order[] title='Enter only positive number' class='form-control text-left' value='".$sizes->size_order."' min='0'/>";

             return $order;
         })
        ->rawColumns([
            'action'      => 'action',
            'status'      => 'status',
            'size_order'  => 'size_order',
        ])->addIndexColumn()->make(true);
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
        $ids            = $request['ids'];
        $productSize    = ProductSize::withTrashed()->whereIn('size_id',$ids)->get();
        if (count($productSize)==0) {
            $size           = Size::whereIn('size_id', $ids)->delete();

        // Set response
            if ( $size == true ) {
                $response = [
                    '_status'  => true,
                    '_message' => __('messages.record_deleted', ['record' => 'Size']),
                    '_type'    => 'success'
                ];
            } else {
                $response = [
                    '_status'  => false,
                    '_message' => __('messages.record_failed', ['record' => 'Size']),
                    '_type'    => 'error'
                ];
            }
        //-------------
        }
        else{
            $response = [
                    '_status'  => false,
                    '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'Size']),
                    '_type'    => 'error'
                ];   
        }

        return response()->json($response, 200);
    }
    /**
     * View create Size.
     * 
     * @author Bhagirath 
     * @create_at 13-Feb-2020
     */
    public function create()
    {
        return view('admin-panel.size.create');
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
            $size = Size::find($value);
            if ($size->size_status == 1) {
                $size->size_status = 0;
                $size->save();
            }
            else
            {
                $size->size_status = 1;
                $size->save();

            }
        }


        // Set response
        if (!is_null($size)) {
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
    * View edit Size.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 10 Jan 2020
    */
    public function edit(Request $request, $id)
    {
        $size = Size::where('size_id', dv($id))->first();
        $this->viewData['size'] = $size;
        return view('admin-panel.size.edit')->with($this->viewData);
    }

    /**
    * Update Size.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 10 Jan 2020
    */
    public function update(ValidateSize $request, $id)
    {
        $user             = auth()->user();
        $size             = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Size
        try {

            $size = Size::find(dv($id));
            $size->size_measure  = $request['size_name'];
            $size->price_percent = $request['size_price'];
            $size->save();

        //---------

            DB::commit();
        }
        catch (\Exception $e) {
            $size          = null;
            $error_message   = $e->getMessage();

            DB::rollback();
        }
        //----------------------

        if ($size == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Size']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.size.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Size']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.size.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
                $size = Size::find($value);
                if ($request['order'][$key] < 0) {
                    $size->size_order = 0;
                }
                else{
                    $size->size_order = $request['order'][$key] ?? 0;
                }
                $size->save();
                DB::commit();
            }
            catch (\Exception $e) {
                $size          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($size == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Size']),
                '_type'    => 'success'
            ];
        //-----------------=
            return redirect()->back()->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Size']),
                '_type'    => 'error'
            ];
        //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }

}
