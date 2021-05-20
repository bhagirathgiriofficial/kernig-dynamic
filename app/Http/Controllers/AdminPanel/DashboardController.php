<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Model\User\User;
use App\Model\Product\Product;
use App\Model\Product\ProductOrder;
use App\Model\Transaction\Transaction;

class DashboardController extends Controller
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
     * View dashboard.
     * 
     * @summary dashboard. 
     * @author Bhagirath
     * @created 16 April 2020
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function index()
    { 
        
        $users                  = User::count();
        $currentMonth           = Carbon::now()->month;
        $usersThisMonth         = DB::table('users')->whereRaw('month(created_at) != '.$currentMonth)->get();
        $recentUsers            = User::orderBy('id','desc')->limit(10)->select('f_name','l_name','email','mobile_number','created_at','email_verified_at')->get();
        $products               = Product::count();
        $productsThisMonth      = DB::table('products')->whereRaw('month(created_at) != '.$currentMonth)->get();        
        $productOrders          = ProductOrder::count();
        $productOrdersThisMonth = DB::table('product_orders')->whereRaw('month(created_at) != '.$currentMonth)->get();
        $totalPayment           = Transaction::selectRaw("sum(transaction_amount) as totalAmout")->get()->toArray();
        $totalPaymentThisMonth  = DB::table('transactions')
                                    ->selectRaw("sum(transaction_amount) as totalAmoutThisMonth")
                                    ->whereRaw('month(created_at) != '.$currentMonth)->get()
                                    ->toArray();

        // for ($i=6; $i >= 0 ; $i--) { 
        //     $userDaysCount[] = User::whereDate("created_at",">=",Carbon::today()->subDays($i))->count();
        // }
        // for ($i=6; $i >= 0 ; $i--) { 
        //     $userWeeksCount[] = User::whereDate("created_at",">=",Carbon::today()->subWeek($i))->count();
        // }                            
        $data = array(
            'usersThisMonth'          => $usersThisMonth,
            'users'                   => $users,
            'recentUsers'             => $recentUsers,
            'products'                => $products,
            'productsThisMonth'       => $productsThisMonth,
            'productOrders'           => $productOrders,
            'productOrdersThisMonth'  => $productOrdersThisMonth,
            'totalPayment'            => $totalPayment[0]['totalAmout'],
            'totalPaymentThisMonth'   => $totalPaymentThisMonth[0]->totalAmoutThisMonth,
            // 'userDaysCount'           => $userDaysCount,
            // 'userWeeksCount'          => $userWeeksCount,

        );
        return view('admin-panel.dashboard.index')->with($data);
    }
}
