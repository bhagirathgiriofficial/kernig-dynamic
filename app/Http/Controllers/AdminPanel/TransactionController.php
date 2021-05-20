<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Course;
use App\Model\Transaction\Transaction;
use Zend\Diactoros\Response;

class TransactionController extends Controller
{   
    /**
     * @var array
     */
    public $viewData = [];

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
     * View transaction.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Bhagirath
     * @created_at 20 March 2020
     */
    public function index()
    {
        return view('admin-panel.transaction.index');
    }

    /**
     * Get transaction list.
     * 
     * @return response
     *  
     * @author Bhagirath
     * @created_at 20 March 2020
     */
    public function getTransactions(Request $request)
    {   

        $auth_user = auth()->user();
        $transaction = Transaction::with(['user' => function($query) use ($request)
        {
            $query->select("users.id","users.f_name","users.l_name","users.email","users.mobile_number");
            if (!empty($request) && !empty($request->input('user_name'))){
                $query->whereRaw('concat(lower(users.f_name)," ",lower(users.l_name)) LIKE ? ',[trim(strtolower('%'.$request->input('user_name'))).'%']);
            }
        }])
        ->whereHas('user' , function ($query) use ($request)
        {
            $query->select("users.id","users.f_name","users.l_name","users.email","users.mobile_number");
            if (!empty($request) && !empty($request->input('user_name'))){
                $query->whereRaw('concat(lower(users.f_name)," ",lower(users.l_name)) LIKE ? ',[trim(strtolower('%'.$request->input('user_name'))).'%']);
            }
        })
        ->with(["order" => function($query)
        {   
            $query->select("product_orders.product_order_id","product_orders.order_number");        
        }])
        ->whereHas("order" , function($query)
        {   
            $query->select("product_orders.product_order_id","product_orders.order_number");        
        })
        ->where(function($query) use ($request)
        {
            if (!empty($request) && !empty($request->input('start_date')) || !empty($request->input('end_date'))){
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                if (empty($request->input('start_date'))) {
                    $startDate = Carbon::now();
                }
                if (empty($request->input('end_date'))) {
                    $endDate = Carbon::now();
                }
                $query->whereBetween('created_at',[dateTimeStamp($startDate),dateTimeStamp($endDate)]);
            }
            if (!empty($request) && $request['transaction_status']!=2) {
                $query->where('transaction_status',$request->input('transaction_status'));
            }
        })
        ->orderBy('transaction_id', 'ASC')->get();
        return DataTables::of($transaction)
        ->addColumn('order_number', function ($transaction){
            return '<a title ="View Order Details" target="blank" href="'.route("adminPanel.orderDetails.productOrderDetails", [ id => ev($transaction->order->product_order_id)]).'">'.$transaction->order->order_number.'</a>';
        })
        ->addColumn('user_details', function ($transaction){
            $data .= $transaction->user->f_name." ".$transaction->user->l_name."</br>";
            $data .= $transaction->user->email."</br>";
            $data .= $transaction->user->mobile_number."</br>";
            return $data;
        })
        ->addColumn('paid_at', function ($transaction){
            return  date('D, d F Y, h:i A', strtotime($transaction->created_at));
        })
        ->addColumn('transaction_amount', function ($transaction){
            return  "$ ".$transaction->transaction_amount;
        })
        ->addColumn('transaction_status', function ($transaction){
            if ($transaction->transaction_status) {
               $status = '<label class="badge badge-success">Success</label> &nbsp;';
            }else{
               $status = '<label class="badge badge-warning">Failed</label> &nbsp;';
            }   
            return $status;
        })
        ->rawColumns([
            'order_number'               => 'order_number',
            'user_details'               => 'user_details',
            'paid_at'                    => 'paid_at',
            'transaction_amount'         => 'transaction_amount',
            'transaction_status'         => 'transaction_status',
        ])->addIndexColumn()->make(true);
    }

    
}