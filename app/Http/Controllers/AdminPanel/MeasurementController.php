<?php 

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Measurement\Measurement;
use App\Model\Measurement\MeasurementDetail;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateMeasurement;
use App\Http\Traits\UploadImage;
use App\Model\Product\Product;

class MeasurementController extends Controller
{
  use UploadImage;
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
    return view('admin-panel.measurement.index');

  }

  /**
  * View Create Measurement.
  * 
  * @author Bhagirath 
  * @create_at 10 -Feb- 2020
  */
  public function create()
  {
    return view('admin-panel.measurement.create');
  }


  public function getSubParentMeasurement(Request $request)
  {
    $subParentMeasurement = Measurement::select('*')
    ->where('Measurement_root_id', $request['Measurement_id'])
    ->get();
    if (count($subParentMeasurement)) {
      $response = [
        '_status' => true,
        '_message' => __('message.record_found' , ['record' => 'Sub Parent Categories']),
        '_data' => $subParentMeasurement,
      ];
    }
    else {
      
      $response = [
        '_status' => false,
        '_message' => __('message.record_not_found' , ['record' => 'Sub Parent Categories']),
        '_data' => [],
      ];	
    }
    return response()->json($response , 200);
  }
  /**
  * Check Measurement Name.
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
      $measurement = Measurement::where('measurement_title', $request['measurement_title'])->first();

      if (! is_null($measurement)) {
        if ($request->filled('id') && $measurement->measurement_id == dv($request['id'])) {
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
  * Store Measurement.
  * 
  * @return mixed
  *  
  * @author Bhagirath 
  * @created_at 10 Feb 2020
  */
  public function store(ValidateMeasurement $request)
  {

    $user                = auth()->user();
    $measurement         = false;
    $error_message       = null;

  // Upload chart
    $measurement_image_name = "";
    if ($request->hasFile('size_chart')) 
    {
      $measurement_image = $this->uploadImage($request->file('size_chart'), config('constants.measurement.images_path'), 75);
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
        'measurement_title' => $request['measurement_title'],
        'measurement_price' => $request['measurement_price'],
        'measurement_desc'  => $request['measurement_description'] ?? "",
        'measurement_chart' => $measurement_image_name,
      ];
  //---------
      $measurement = Measurement::create($data);
      DB::commit();
      $measurement = Measurement::find($measurement->measurement_id);
      foreach ($request['measurement'] as $key => $value) {
        $details = new MeasurementDetail;
        $details->measurement_id      = $measurement->measurement_id;
        $details->measurement_title   = $value['title'];  
        $details->title_description   = $value['tip'];  
        $details->save();
      }

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

      return redirect()->route('adminPanel.measurement.index')->with(['notification' => $notification]);

    } else {
  // Set notification
      $notification = [
        '_status'  => false,
        '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Measurement']),
        '_type'    => 'error'
      ];
  //-----------------

      return redirect()->route('adminPanel.measurement.create')->withInput()->with(['notification' => $notification]);
    }
  }
  /**
  * Get Measurement list.
  * 
  * @return response
  *  
  * @author Bhagirath
  * @created_at 10 Feb 2020
  */
  public function getMeasurmenet(Request $request)
  {
    $auth_user = auth()->user();
    $measurement = Measurement::with('details')->where(function($query) use ($request, $auth_user){
      if (!empty($request) && !empty($request->input('measurement_title')))
      {
        $query->whereRaw('lower(measurement_title) LIKE ? ',[trim(strtolower('%'.$request->input('measurement_title'))).'%']);
      }
    })->orderBy('measurement_id', 'DESC')->get();
    return DataTables::of($measurement)
    ->addColumn('status', function ($measurement) {
      $status = '';
      if ( $measurement->measurement_status == 0 ){
        $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
      } else {
        $status .= '<label class="badge badge-success">Active</label> &nbsp;';
      }
      return $status;
    })
    ->addColumn('action', function ($measurement) {

      $action = '<a href="'.route('adminPanel.measurement.edit', ['id' => ev($measurement->measurement_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
      return $action;
    })
    ->addColumn('measurement_chart', function ($measurement) {

      $chart = get_image_url(config('constants.measurement.images_path'),$measurement->measurement_chart);
      if(!empty($chart))
      {
        return '<img src="'.$chart.'" width="50px"/>';
      }
      else
      {
        return 'N/A';
      }

    })
    ->rawColumns([
      'action'             => 'action',
      'status'             => 'status',
      'measurement_part'   => 'measurement_part',
      'measurement_chart'  => 'measurement_chart',
      'measurement_tip'    => 'measurement_tip',  
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

    $product = Product::withTrashed()->whereIn('measurement_id', $request['ids'])->get();
    if (count($product) > 0) {
    // Set response
     $response = [
            '_status'  => false,
            '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'Measurement']),
            '_type'    => 'error'
        ];
        return response()->json($response, 200);
    // -----------
    }
    $measurement         = Measurement::whereIn('measurement_id',$request['ids'])->delete();
    if ( $measurement == true ) {
      $response = [
        '_status'  => true,
        '_message' => __('messages.record_deleted', ['record' => 'Measurement']),
        '_type'    => 'success'
      ];
    } else {
      $response = [
        '_status'  => false,
        '_message' => __('messages.record_failed', ['record' => 'Measurement']),
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
      $measurement = Measurement::find($value);
      if ($measurement->measurement_status == 1) {
        $measurement->measurement_status = 0;
        $measurement->save();
      }
      else
      {
        $measurement->measurement_status = 1;
        $measurement->save();  
      }
    }

// Set response
    if (!is_null($measurement)) {
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
  * View edit measurement.
  * 
  * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
  *  
  * @author Bhagirath
  * @created_at 28 Feb 2020
  */
  public function edit(Request $request, $id)
  {
    $measurement = Measurement::with('details')->where('measurement_id', dv($id))->first();
    $chart = get_image_url(config('constants.measurement.images_path'),$measurement->measurement_chart);

    $this->viewData['measurement'] = $measurement;  
    $this->viewData['chart']       = $chart;        
    return view('admin-panel.measurement.edit')->with($this->viewData);
  }
  /**
  * Update Measurement.
  * 
  * @return mixed
  *  
  * @author Bhagirath
  * @created_at 20 Feb 2020
  */
  public function update(ValidateMeasurement $request, $id)
  {
    
    $user             = auth()->user();
    $measurement         = false;
    $error_message    = null;

    DB::beginTransaction();


  // Upload chart
    $measurement = Measurement::find(dv($id));
    $measurement_image_name = $measurement->measurement_chart;
    if ($request->hasFile('size_chart')) 
    {
      $measurement_image = $this->uploadImage($request->file('size_chart'), config('constants.measurement.images_path'), 75);
      if ($measurement_image['_status']) 
      {
        $measurement_image_name = $measurement_image['_data'];
      }
    }
  // Update Measurement
    try {

  // Set data
      $measurement->measurement_title = $request['measurement_title'];
      $measurement->measurement_price = $request['measurement_price'];
      $measurement->measurement_desc  = $request['measurement_description'] ?? "";
      $measurement->measurement_chart = $measurement_image_name;             
      $measurement->save();
  //---------

      foreach ($request['measurement'] as $key => $value) {
        if ($value['id']!="") {
          $old_id = dv($value['id']);
          $details = MeasurementDetail::find($old_id);
          $details->measurement_title   = $value['title'];  
          $details->title_description   = $value['tip'];  
          $details->save();
        }
        else{
          $details = new MeasurementDetail;
          $details->measurement_id      = dv($id);
          $details->measurement_title   = $value['title'];  
          $details->title_description   = $value['tip'];  
          $details->save();
        }
      }

      DB::commit();
    } catch (\Exception $e) {
      $measurement          = null;
      $error_message   = $e->getMessage();
      DB::rollback();
    }
  //----------------------
    if ($measurement == true) {
  // Set notification
      $notification = [
        '_status'  => true,
        '_message' => __('messages.records_updated', ['record' => 'Measurement']),
        '_type'    => 'success'
      ];
  //-----------------=
      return redirect()->route('adminPanel.measurement.index')->with(['notification' => $notification]);

    } else {
  // Set notification
      $notification = [
        '_status'  => false,
        '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Measurement']),
        '_type'    => 'error'
      ];
  //-----------------
      return redirect()->route('adminPanel.measurement.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
    }
  }
  /**
  * Delete  Measurement Detals.
  * 
  * @return mixed
  *  
  * @author Bhagirath
  * @created_at 20 Feb 2020
  */
  public function destroyDetail($id){
    $measurementDetail = MeasurementDetail::find(dv($id));
    if ($measurementDetail) {
      $measurementDetail->delete();
      echo "success";
    }
  }

}
