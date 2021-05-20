<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Excel;
use App\Model\User\User;

class UserController extends Controller
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
     * View user list.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Bhagirath
     * @created_at 25 March 2020
     */
    public function index()
    {
        return view('admin-panel.users.index');
    }

    /**
     * Get user list.
     * 
     * @return response
     *  
     * @author Bhagirath
     * @created_at 25 March 2020
     */
    public function getUsers()
    {
        $auth_user = auth()->user();
        // Get user list
        $users = User::with('country')->orderBy('id','desc')->get();     
        //--------------
        return DataTables::of($users)
        ->addColumn('name', function($users){
            return $users->f_name." ".$users->l_name;           
        })
        ->addColumn('mobile_number', function($users){
            if ($users->mobile_number != "") {    
            return $users->mobile_number;           
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('country_name', function($users){
            if ($users->country_id != 0) {    
            return $users->country->country_name;           
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('address', function($users){
            if ($users->address != "") {    
            return $users->address;           
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('state', function($users){
            if ($users->state != "") {    
            return $users->state;           
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('city', function($users){
            if ($users->city != "") {    
            return $users->city;           
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('zip_code', function($users){
            if ($users->zip_code != "") {    
            return $users->zip_code;           
            }
            else{
                return "N/A";
            }
        })
        ->addColumn('email', function($users){
            if ($users->email != "") {    
            return $users->email;           
            }
            else{
                return "N/A";
            }
        })
       
        ->addColumn('status', function ($user) {
            $status = '';
            if ( $user->user_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->rawColumns([
            'status'           => 'status',
            'name'             => 'name',
            'address'          => 'address',
            'mobile_number'    => 'mobile_number',
            'city'             => 'city',
            'zip_code'         => 'zip_code',
            'email'            => 'email',
        ])->addIndexColumn()->make(true);
    }
    /**
     * Change status.
     * 
     * @return boolean
     *  
     * @author Bhagirath
     * @created_at 26 March 2020
     */
    public function changeStatus(Request $request)
    {
        foreach ($request['ids'] as $value) {
            $user = User::find($value);
            if ($user->user_status == 1) {
                $user->user_status = 0;
                $user->save();
            }
            else
            {
                $user->user_status = 1;
                $user->save();

            }
        }
     
        // Set response
        if (!is_null($user)) {
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
    *
    * To download the user excel 
    * @author Bhagirath
    * @created_at 20 - May - 2020
    * @return file;
    */
    public function userExcel()
    {
        $users = User::get()->toArray();
        $array[] = array('Name','Email','Contact');
        foreach ($users as $key => $user) {
            $array[] = array(
                'Name'    => $user['f_name']." ".$user['l_name'],
                'Email'   => $user['email'],
                'Contact' => $user['mobile_number'],
            );
        }
        Excel::create('User Details',function($excle) use ($array)
        {
            $excle->setTitle('User Details');
            $excle->sheet('User Details', function($sheet) use ($array)
            {
                $sheet->fromArray($array,null,'A1',false,false);
            });
        })->download('xlsx');
        return view('admin-panel.users.index');
    }
}

