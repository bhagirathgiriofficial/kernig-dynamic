<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Newsletter\Newsletter;
use Zend\Diactoros\Response;

class NewsLetterController extends Controller
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
		return view('admin-panel.news-letter.index');
	}
    /**
    * Get NewsLetter list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 06 March 2020
    */
    public function getNewsLetters(Request $request)
    {
        $auth_user = auth()->user();

        $newsLetter = Newsletter::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('news_letter_email')))
            {
                $query->whereRaw('lower(news_letter_email) LIKE ? ',[trim(strtolower($request->input('news_letter_email'))).'%']);
            }
        })->orderBy('news_letter_id', 'DESC')->get();
        return DataTables::of($newsLetter)
        ->addColumn('status', function ($newsLetter) {
            $status = '';
            if ( $newsLetter->news_letter_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->rawColumns([
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
    * @created_at 06 March 2020
    */
    public function changeStatus(Request $request)
    {

        foreach ($request['ids'] as $value) {
            $newsLetter = Newsletter::find($value);
            if ($newsLetter->news_letter_status == 1) {
                $newsLetter->news_letter_status = 0;
                $newsLetter->save();
            }
            else
            {
                $newsLetter->news_letter_status = 1;
                $newsLetter->save();

            }
        }
            // Set response
        if (!is_null($newsLetter)) {
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
    * @created_at 07 March 2020
    */
    public function destroy(Request $request)
    {
        $ids = $request['ids'];
        $newsLetter         = Newsletter::whereIn('news_letter_id',$ids)->delete();
        // Set response
        if ($newsLetter == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'News Letter']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'News Letter']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }
}
