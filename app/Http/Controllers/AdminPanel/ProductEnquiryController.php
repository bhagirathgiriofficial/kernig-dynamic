<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Product\ProductEnquiry;
use Zend\Diactoros\Response;

class ProductEnquiryController extends Controller
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
    * View Enquiry Index
    * @author Bhagirath 
    * @create_at 07 March 2020
    */

	public function index()
	{
		return view('admin-panel.product.enquiry');
	}
    /**
    * Get Enquiries.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 07 March 2020
    */
    public function getEnquiries(Request $request)
    {
        $auth_user = auth()->user();

        $enquiries = ProductEnquiry::with('product')->orderBy('product_enquiry_id', 'DESC')->get();
        return DataTables::of($enquiries)
        ->addColumn('status', function ($enquiries) {
            $status = '';
            if ( $enquiries->enquiry_status == 1 ){
                $status .= '<label class="badge badge-warning">Pending</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Replied</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('user_details', function($enquiries){
           $data .= '<b>Name: </b>'.$enquiries->enquiry_first_name." ".$enquiries->enquiry_last_name;
           $data .= '</br><b>Email: </b>'.$enquiries->enquiry_email;
           $data .= '</br><b>Mobile: </b>'.$enquiries->enquiry_phone;
           return $data;
        })
        ->addColumn('product_basic_details', function($enquiries){
           $data .= '<b>Name: </b>'.$enquiries->product->product_name;
           $data .= '</br><b>Code: </b>'.$enquiries->product->product_code;
           $data .= '</br><b>Original Price: </b> $'.$enquiries->product->product_price;
           return $data;
        })
        ->addColumn('enquiry_comment', function($enquiries){
            return $enquiries->enquiry_comment;
        })
        ->addColumn('action', function($enquiries){
            return '<a href="'.route('adminPanel.product.details', ['id' => ev($enquiries->product->product_id)]).'" class="btn btn-primary" title="View Product Details" target="blank"><i class="icon fa fa-eye" aria-hidden="true"></i> Product Details</a>';
        })
        ->rawColumns([
            'enquiry_comment'         => 'enquiry_comment',
            'product_basic_details'   => 'product_basic_details',
            'user_details'            => 'user_details',
            'status'                  => 'status',
            'action'                  => 'action',
        ])->addIndexColumn()->make(true);
    }
    /**

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
            $enquiry = ProductEnquiry::find($value);
            if ($enquiry->enquiry_status == 1) {
                $enquiry->enquiry_status = 2;
                $enquiry->save();
            }
            else
            {
                $enquiry->enquiry_status = 1;
                $enquiry->save();

            }
        }
            // Set response
        if (!is_null($enquiry)) {
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
    * Destroy.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 10 Feb 2020
    */
    public function destroy(Request $request)
    {
        $ids = $request['ids'];
        $enquiry         = ProductEnquiry::whereIn('product_enquiry_id',$ids)->delete();
        // Set response
        if ($enquiry == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Product Enquiry']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Product Enquiry']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }

}
