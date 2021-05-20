<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Enquiry\Enquiry;
use Zend\Diactoros\Response;

class EnquiryController extends Controller
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
		return view('admin-panel.enquiry.index');
	}
    /**
    * Get NewsLetter list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 07 March 2020
    */
    public function getEnquiries(Request $request)
    {
        $auth_user = auth()->user();

        $enquiries = Enquiry::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('enquiry_comment')))
            {
                $query->whereRaw('lower(enquiry_comment) LIKE ? ',[trim(strtolower('%'.$request->input('enquiry_comment'))).'%']);
            }
        })->orderBy('enquiry_id', 'DESC')->get();
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
        ->addColumn('name', function($enquiries){
            return $enquiries->enquiry_first_name." ".$enquiries->enquiry_last_name;
        })
        ->addColumn('enquiry_comment', function($enquiries){
            return $enquiries->enquiry_comment;
        })
        ->rawColumns([
            'enquiry_comment' => 'enquiry_comment',
            'name'            => 'name',
            'status'          => 'status',
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
            $enquiry = Enquiry::find($value);
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
        $enquiry         = Enquiry::whereIn('enquiry_id',$ids)->delete();
        // Set response
        if ($enquiry == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Enquiry']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Enquiry']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }

}
