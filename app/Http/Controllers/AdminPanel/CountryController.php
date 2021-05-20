<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Country\Country;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateCountry;

class CountryController extends Controller
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
    * View Country Names
    * @author Bhagirath 
    * @create_at 05-Feb-2020
    */

	public function index()
	{
		return view('admin-panel.country.index');
	}

    /**
    * Check Country Name Name.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 09 Feb 2020
    */
    public function checkCountryTitle(Request $request)
    {
        $status = false;
        if (! is_null($request->country_name)) {
            $country = Country::where('country_name', $request['country_name'])->first();

            if (! is_null($country)) {
                if ($request->filled('id') && $country->country_id == dv($request['id'])) {
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
     * Store Country Name.
     * 
     * @return mixed
     *  
     * @author Bhagirath 
     * @created_at 13 Feb 2020
     */
    public function store(ValidateCountry $request)
    {
        $user            = auth()->user();
        $country          = false;
        $error_message   = null;

        DB::beginTransaction();
        // Create Country Name
        try {

            // Set data
            $data = [
                'country_name'    => $request['country_name'],   
            ];
            //---------

            $country = Country::create($data);
            
            DB::commit();
        } catch (\Exception $e) {
            $country          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($country)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Country']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.country.index')->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Country']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.country.create')->withInput()->with(['notification' => $notification]);
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
    public function getCountries(Request $request)
    {
        $auth_user = auth()->user();

        $country = Country::where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('country_name')))
            {
                $query->whereRaw('lower(country_name) LIKE ? ',[trim(strtolower('%'.$request->input('country_name'))).'%']);
            }
        })->orderBy('country_id', 'DESC')->get();
        return DataTables::of($country)
        ->addColumn('status', function ($country) {
            $status = '';
            if ( $country->country_status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($country) {

            $action = '<a href="'.route('adminPanel.country.edit', ['id' => ev($country->country_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

            return $action;
        })
        ->rawColumns([
            'action'      => 'action',
            'status'      => 'status',
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

        $country         = Country::whereIn('country_id', $ids)->delete();

// Set response
        if ( $country == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Country']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Country']),
                '_type'    => 'error'
            ];
        }
//-------------

        return response()->json($response, 200);
    }
    /**
    * View create Country Name.
    * 
    * @author Bhagirath 
    * @create_at 13-Feb-2020
    */
    public function create()
    {
        return view('admin-panel.country.create');
    }

    /**
    * Change status.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 13 Feb 2020
    */
    public function changeStatus(Request $request)
    {

        foreach ($request['ids'] as $value) {
            $country = Country::find($value);
            if ($country->country_status == 1) {
                $country->country_status = 0;
                $country->save();
            }
            else
            {
                $country->country_status = 1;
                $country->save();

            }
        }

// Set response
        if (!is_null($country)) {
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
    * View edit Country Name.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 13 Feb 2020
    */
    public function edit(Request $request, $id)
    {
        $country = Country::where('country_id', dv($id))->first();
        $this->viewData['country'] = $country;

        return view('admin-panel.country.edit')->with($this->viewData);
    }
    /**
    * Update Country Name.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 13 Feb 2020
    */
    public function update(ValidateCountry $request, $id)
    {
        $user             = auth()->user();
        $country         = false;
        $error_message    = null;

        DB::beginTransaction();

// Update Country Name
        try {

            $country = Country::find(dv($id));
            $country->country_name = $request['country_name'];
            $country->save();

//---------


            DB::commit();
        } catch (\Exception $e) {
            $country          = null;
            $error_message   = $e->getMessage();

            DB::rollback();
        }
//----------------------

        if ($country == true) {
// Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Country Name']),
                '_type'    => 'success'
            ];
//-----------------

            return redirect()->route('adminPanel.country.index')->with(['notification' => $notification]);

        } else {
// Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Country Name']),
                '_type'    => 'error'
            ];
//-----------------

            return redirect()->route('adminPanel.country.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
