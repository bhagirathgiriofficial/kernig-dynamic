<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use DataTables;
use App\Model\Shipping\Shipping;
use App\Model\Country\Country;
use Zend\Diactoros\Response;

class ShippingController extends Controller
{
    /**
    * View Shipping Charges.
    * 
    * @author Bhagirath 
    * @create_at 10 -Feb- 2020
    */
    public function index()
    {
         
        return view('admin-panel.shipping-charges.index')->with($data);
    }
    /**
    * View Create Shipping Charges.
    * 
    * @author Bhagirath 
    * @create_at 10 -Feb- 2020
    */
    public function create()
    {
        $country = Country::whereDoesntHave('shipping')->where('country_status','1')->orderBy('country_name')->get();
        $data = array(
            'country' => $country,
        );   
        return view('admin-panel.shipping-charges.create')->with($data);
    }
	/**
    * Store  Shipping Charges.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 10 Feb 2020
    */
    public function store(Request $request)
    {
        $user                = auth()->user();
        $shipping            = false;
        $error_message       = null;

        DB::beginTransaction();
        // Create Shipping Charges
        try {
        // Set data
            foreach ($request['shipping'] as $key => $value) {
                if($value['weight']!= "" && $value['charges']!= "")
                {
                    $shipping = new Shipping;
                    $shipping->shipping_country_id = $request['country'];
                    $shipping->shipping_weight     = $value['weight'];
                    $shipping->shipping_price      = $value['charges'];
                    $shipping->save();
                }
            }
        //---------
            DB::commit();
        } catch (\Exception $e) {
            $shipping        = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($shipping)) {

             $country = Country::find($request['country']);
             $country->country_status = 0;
             $country->save();
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Shipping Charges']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.shippingCharges.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Shipping Charges']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }
    /**
    * Get Saree shipping list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 10 Feb 2020
    */
    public function getShippingCountries(Request $request)
    {
    
        $country = Country::whereHas('shipping')->with('shipping')->where(function($query) use ($request) 
        {
            if (!empty($request) && !empty($request->input('country_name')))
            {
                $query->whereRaw('lower(country_name) LIKE ? ',[trim(strtolower('%'.$request->input('country_name'))).'%']);
            }
        })->orderBy('country_name', 'ASC')->get();
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

            $action = '<a href="'.route('adminPanel.shippingCharges.edit', ['id' => ev($country->country_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            return $action;
        })
        ->addColumn('weights',function($country){
            $data .="";
            foreach ($country->shipping as $key => $value) {
            $data .= "<li>".$value['shipping_weight']."</li>";
            }
            return '<ul class="list-unstyled">'.$data.'</ul>';
        })
         ->addColumn('charges',function($country){
            $data .="";
            foreach ($country->shipping as $key => $value) {
            $data .= "<li> $ ".$value['shipping_price']."</li>";
            }
            return '<ul class="list-unstyled">'.$data.'</ul>';
        })
        ->rawColumns([
            'weights'      => 'weights',
            'charges'      => 'charges',
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
    * @created_at 10 Feb 2020
    */
    public function destroy(Request $request)
    {
        
        $shipping = Shipping::whereIn('shipping_country_id', $request['ids'])->delete();

        // Set response
        if ($shipping == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Shipping Charges']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Shipping Charges']),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
    * Change status.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 12 Feb 2020
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
    * View edit shipping.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 10 Feb 2020
    */
    public function edit(Request $request, $id)
    {
        $country  = Country::find(dv($id));
        $shipping = Shipping::where('shipping_country_id', dv($id))->get()->toArray();
        $this->viewData['country']      = $country;
        $this->viewData['shipping']     = $shipping;
        return view('admin-panel.shipping-charges.edit')->with($this->viewData);
    }
    /**
    * Update Shipping Charges.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 07 March 2020
    */
    public function update(Request $request, $id)
    {
        
        $user             = auth()->user();
        $shipping         = false;
        $error_message    = null;
        DB::beginTransaction();
        // Update Shipping Charges
        try {
            foreach ($request['shipping'] as $value) {
                if ($value['id']!="") {
                $shipping = Shipping::find($value['id']);
                }
                else{
                  $shipping = new Shipping;   
                }
                if ($value['weight']!= "" && $value['charges']!= "") {
                $shipping->shipping_country_id = dv($id);
                $shipping->shipping_weight     = $value['weight'];
                $shipping->shipping_price      = $value['charges'];
                $shipping->save();
                }
            }
        //---------
            DB::commit();
        } catch (\Exception $e) {
            $shipping          = null;
            $error_message     = $e->getMessage();

            DB::rollback();
        }
        //----------------------

        if ($shipping == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Shipping Charges']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.shippingCharges.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Shipping Charges']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.shippingCharges.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }


}
