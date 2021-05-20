<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Coupon\Coupon;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateCoupon;

class CouponController extends Controller
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
		* View Coupons
		* @author Bhagirath 
		* @create_at 05-Feb-2020
	*/

	public function index()
	{
		return view('admin-panel.coupon.index');
	}

	/**
     * Check Coupon Name.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkCouponCode(Request $request)
    {
        $status = false;
        if (! is_null($request->coupon_code)) {
            $coupon = Coupon::where('coupon_code', $request['coupon_code'])->first();
            if (! is_null($coupon)) {
                if ($request->filled('id') && $coupon->coupon_id == dv($request['id'])) {
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
     * Store Coupon.
     * 
     * @return mixed
     *  
     * @author Bhagirath 
     * @created_at 13 Feb 2020
     */
     public function store(ValidateCoupon $request)
     {

        $user            = auth()->user();
        $coupon          = false;
        $error_message   = null;

        
        DB::beginTransaction();
        // Create Coupon
        try {

            // Set data
            $data = [
                'coupon_code'              => $request['coupon_code'],   
                'discount'                 => $request['coupon_discount'],
                'start_price'              => $request['price_start'],
                'end_price'                => $request['price_end'],
                'start_date'               => date("Y-m-d", strtotime($request['start_date'])),
                'end_date'                 => date("Y-m-d", strtotime($request['end_date'])),
            ];
            //---------

            $coupon = Coupon::create($data);
            
            DB::commit();
        } catch (\Exception $e) {
            $coupon          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($coupon)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Coupon']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.coupon.index')->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Coupon']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.coupon.create')->withInput()->with(['notification' => $notification]);
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
     public function getCoupons(Request $request)
     {
        $auth_user = auth()->user();

        $coupons = Coupon::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('coupon_code')))
            {
                $query->whereRaw('lower(coupon_code) LIKE ? ',[trim(strtolower('%'.$request->input('coupon_code'))).'%']);
            }
        })->orderBy('coupon_id', 'DESC')->get();
        return DataTables::of($coupons)
        ->addColumn('status', function ($coupons) {
            $status = '';
            if ( $coupons->coupon_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($coupons) {

            $action = '<a href="'.route('adminPanel.coupon.edit', ['id' => ev($coupons->coupon_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            
            return $action;
        })
        ->addColumn('price_range', function($coupons){
            return "$ ".$coupons->start_price." To  $ ".$coupons->end_price;
        })
        ->addColumn('valid', function($coupons){
            return date('d/m/Y',strtotime($coupons->start_date))." To ".date('d/m/Y',strtotime($coupons->end_date));
        })/*discount*/
        ->addColumn('discount', function($coupons){
            return $coupons->discount." % ";
        })
        ->addColumn('created_at', function($coupons){
            return date( 'd F Y, h:i A', strtotime($coupons->created_at)) ;
        })
        ->rawColumns([
            'action'      => 'action',
            'status'      => 'status',
            'price_range' => 'price_range',
            'valid'       => 'valid',
            'discount'    => 'discount',
            'created_at'  => 'created_at',
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
        $coupon         = Coupon::whereIn('coupon_id', $ids)->delete();
        // Set response
        if ( $coupon == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Coupon']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Coupon']),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
     * View create Coupon.
     * 
     * @author Bhagirath 
     * @create_at 13-Feb-2020
     */
    public function create()
    {

        return view('admin-panel.coupon.create');

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
            $coupon = Coupon::find($value);
            if ($coupon->coupon_status == 1) {
                $coupon->coupon_status = 0;
                $coupon->save();
            }
            else
            {
                $coupon->coupon_status = 1;
                $coupon->save();

            }
        }
        // Set response
            if (!is_null($coupon)) {
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
     * View edit Coupon.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function edit(Request $request, $id)
    {
        $coupon = Coupon::where('coupon_id', dv($id))->first();
        $this->viewData['coupon'] = $coupon;
        return view('admin-panel.coupon.edit')->with($this->viewData);
    }

    /**
     * Update Coupon.
     * 
     * @return mixed
     *  
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function update(ValidateCoupon $request, $id)
    {

        $user             = auth()->user();
        $coupon         = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Coupon
        try {

            // Set data
            $data = [
                'coupon_code'              => $request['coupon_code'],   
                'discount'                 => $request['coupon_discount'],
                'start_price'              => $request['price_start'],
                'end_price'                => $request['price_end'],
                'start_date'               => date("Y-m-d", strtotime($request['start_date'])),
                'end_date'                 => date("Y-m-d", strtotime($request['end_date'])),
            ];
            //---------

            $coupon = Coupon::find(dv($id))->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $coupon          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if ($coupon == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Coupon']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.coupon.index')->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Coupon']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.coupon.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
