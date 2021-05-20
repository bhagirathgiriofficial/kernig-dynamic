<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Product\ProductReview;
use Zend\Diactoros\Response;

class ProductReviewController extends Controller
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
    * View Review Index
    * @author Bhagirath 
    * @create_at 07 March 2020
    */

	public function index()
	{
		return view('admin-panel.product.review');
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

        $reviews = ProductReview::with('product')->orderBy('product_review_id', 'DESC')->get();
        return DataTables::of($reviews)
        ->addColumn('status', function ($reviews) {
            $status = '';
            if ( $reviews->review_status == 1 ){
                $status .= '<label class="badge badge-warning"> No </label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success"> Yes </label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('user_details', function($reviews){
           $data .= '<b>Name: </b>'.$reviews->user_name.",";
           $data .= '</br><b>Email: </b>'.$reviews->user_email.",";
           $data .= '</br><b>Rating: </b>'.$reviews->user_rating.'/5 <i class="fa fa-star" style="color:orange"></i>';
           return $data;
        })
        ->addColumn('product_basic_details', function($reviews){
           $data .= '<b>Name: </b>'.$reviews->product->product_name.",";
           $data .= '</br><b>Code: </b>'.$reviews->product->product_code.",";
           $data .= '</br><b>Original Price: </b> $'.$reviews->product->product_price;
           return $data;
        })
        ->rawColumns([            
            'product_basic_details'   => 'product_basic_details',
            'user_details'            => 'user_details',
            'status'                  => 'status',
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
            $review = ProductReview::find($value);
            if ($review->review_status == 1) {
                $review->review_status = 2;
                $review->save();
            }
            else
            {
                $review->review_status = 1;
                $review->save();

            }
        }
            // Set response
        if (!is_null($review)) {
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
        $review         = ProductReview::whereIn('product_review_id',$ids)->delete();
        // Set response
        if ($review == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Product Review']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Product Review']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }

}
