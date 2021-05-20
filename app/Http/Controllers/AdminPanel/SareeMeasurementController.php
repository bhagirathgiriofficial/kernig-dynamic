<?php 

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Measurement\Measurement;
use App\Model\Measurement\SareeMeasurement;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateSareeMeasurement;   

class SareeMeasurementController extends Controller
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
	* View Measurements
	* @author Bhagirath 
	* @create_at 10-Feb-2020
	*/

    public function index ()
    {
        return view('admin-panel.saree-measurement.index');
    }

	/**
    * View Create Saree  Measurement.
    * 
    * @author Bhagirath 
	* @create_at 10 -Feb- 2020
    */
	public function create()
	{
        $custom_measurement = Measurement::where('measurement_status',1)->orderBy('measurement_id','DESC')->get();
        $data = array(
            'custom' => $custom_measurement,
        );   
        return view('admin-panel.saree-measurement.create')->with($data);
    }
	/**
    * Check  Saree Measurement Name.
    * 
    * @return boolean
    *  
    * @author Bhagirath
    * @created_at 09 Feb 2020
    */
    public function checkMeasurementTitle(Request $request)
    {
        $status = false;

        if (! is_null($request->measurement_title)) {
            $measurement = SareeMeasurement::where('saree_measurement_title', $request['measurement_title'])->first();
            if (!is_null($measurement)) {
                if ($request->filled('id') && $measurement->saree_measurement_id == dv($request['id'])) {
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
    * Store  Saree Measurement.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 10 Feb 2020
    */
    public function store(ValidateSareeMeasurement $request)
    {

        $user                = auth()->user();
        $measurement         = false;
        $error_message       = null;

        // Upload chart
        if ($request->hasFile('size_chart')) 
        {
            $measurement_image = $this->uploadImage($request->file('size_chart'), config('constants.sareeMeasurement.images_path'), 75);
            if ($measurement_image['_status']) 
            {
                $measurement_image_name = $measurement_image['_data'];
            }
        }
        //------------------
        DB::beginTransaction();
        // Create Measurment
        try {
        // Set data
            $data = [
                'saree_measurement_title' => $request['measurement_title'],
                'saree_measurement_price' => $request['measurement_price'],
                'saree_custom_id'  => $request['custom'],
            ];
        //---------
            $measurement = SareeMeasurement::create($data);
            DB::commit();
            $measurement = SareeMeasurement::find($measurement->saree_measurement_id);

        } catch (\Exception $e) {
            $measurement          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($measurement)) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Measurement']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.sareeMeasurement.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Measurement']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.sareeMeasurement.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
    * Get Saree Measurement list.
    * 
    * @return response
    *  
    * @author Bhagirath
    * @created_at 10 Feb 2020
    */
    public function getMeasurmenet(Request $request)
    {
        $measurement = SareeMeasurement::where(function($query) use ($request){
            if (!empty($request) && !empty($request->input('measurement_title')))
            {
                $query->whereRaw('lower(saree_measurement_title) LIKE ? ',[trim(strtolower('%'.$request->input('measurement_title'))).'%']);
            }
        })->orderBy('saree_measurement_id', 'DESC')->get();
        return DataTables::of($measurement)
        ->addColumn('saree_custom_id', function($measurement)
        {   
            if ($measurement->saree_custom_id != "") {
                return $measurement->saree_custom_id;
            }
            else
            {
                return "N/A";
            }
        })
        ->addColumn('status', function ($measurement) 
        {
            $status = '';
            if ( $measurement->saree_measurement_status  == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($measurement) {

            $action = '<a href="'.route('adminPanel.sareeMeasurement.edit', ['id' => ev($measurement->saree_measurement_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            return $action;
        })
        ->addColumn('saree_custom_id',function($measurement){
            if ($measurement->saree_custom_id!="") {
                return "Yes";
            }
            else{
                return "No";
            }
        })
        ->rawColumns([
            'saree_custom_id'    => 'saree_custom_id',
            'action'             => 'action',
            'status'             => 'status',
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

        $saree = SareeMeasurement::whereIn('saree_measurement_id', $request['ids'])->delete();

        // Set response
        if ($saree == true ) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Saree Measurement']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Saree Measurement']),
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
            $saree = SareeMeasurement::find($value);
            if ($saree->saree_measurement_status == 1) {
                $saree->saree_measurement_status = 0;
                $saree->save();
            }
            else
            {
                $saree->saree_measurement_status = 1;
                $saree->save();

            }
        }
        // Set response
        if (!is_null($saree)) {
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
    * View edit Saree Measurement.
    * 
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    *  
    * @author Bhagirath
    * @created_at 20 Feb 2020
    */
    public function edit(Request $request, $id)
    {
        $sareeMeasurement = SareeMeasurement::where('saree_measurement_id', dv($id))->first();
        $this->viewData['sareeMeasurement']   = $sareeMeasurement;
        $this->viewData['custom'] = Measurement::orderBy('measurement_id','DESC')->get();
        return view('admin-panel.saree-measurement.edit')->with($this->viewData);
    }
    /**
    * Update Saree Measurement.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 20 Feb 2020
    */
    public function update(ValidateSareeMeasurement $request, $id)
    {

        $user                     = auth()->user();
        $sareeMeasurement         = false;
        $error_message            = null;

        DB::beginTransaction();

        // Update Saree Measurement
        try {
        // Set data
            $data = [
                'saree_measurement_title' => $request['measurement_title'],
                'saree_measurement_price' => $request['measurement_price'],
                'saree_custom_id'  => $request['custom'],
            ];
        //---------

            $sareeMeasurement = SareeMeasurement::find(dv($id))->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $sareeMeasurement          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if ($sareeMeasurement == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Saree Measurement']),
                '_type'    => 'success'
            ];
        //-----------------

            return redirect()->route('adminPanel.sareeMeasurement.index')->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Saree Measurement']),
                '_type'    => 'error'
            ];
        //-----------------

            return redirect()->route('adminPanel.sareeMeasurement.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }



}
