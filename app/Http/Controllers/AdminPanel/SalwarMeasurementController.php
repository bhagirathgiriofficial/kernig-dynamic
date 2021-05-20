<?php 

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Measurement\SalwarMeasurement;
use App\Model\Measurement\SalwarTop;
use App\Model\Measurement\SalwarBottom;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateSalwarMeasurement;   
use App\Http\Traits\UploadImage;

class SalwarMeasurementController extends Controller
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
        $salwar     = SalwarMeasurement::first();

        $top        = SalwarTop::get();
        $bottom     = SalwarBottom::get();
        if (!empty($salwar)) {
            $data = array(
                'salwar'    => $salwar,
                'top'       => $top,
                'bottom'    => $bottom,
                'url'       => route('adminPanel.salwarMeasurement.update')
            );
            return view('admin-panel.salwar-measurement.index')->with($data);
        }
        else
        {
            $data = array(
                'url'    => route('adminPanel.salwarMeasurement.store'),
                'salwar' => [],               
            );
            return view('admin-panel.salwar-measurement.index')->with($data);   
        }
    }

	/**
    * Store  Saree Measurement.
    * 
    * @return mixed
    *  
    * @author Bhagirath 
    * @created_at 12 Feb 2020
    */
    public function store(Request $request)
    {     
        $user                = auth()->user();
        $measurement         = false;
        $error_message       = null;

            // Upload chart
        $measurement_image_name = "";
        if ($request->hasFile('size_chart')) 
        {
            $measurement_image = $this->uploadImage($request->file('size_chart'), config('constants.salwarMeasurement.images_path'), 75);
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
                'salwar_measurement_titles' => $request['measurement_title'],
                'salwar_measurement_price'  => $request['measurement_price'],
                'salwar_description'        => $request['measurement_description'],
                'salwar_measurement_chart'  => $measurement_image_name ,
            ];
            /*To  create top title and description*/
            foreach ($request['top'] as  $value) {
                $top                    = new SalwarTop;
                $top->top_title         = $value['title'];
                $top->top_description   = $value['description'];
                $top->save();
            }
            /*To  create bottom title and description*/
            foreach ($request['bottom'] as  $value) {
                $bottom                     = new SalwarBottom;
                $bottom->bottom_title       = $value['title'];
                $bottom->bottom_description = $value['description'];
                $bottom->save();
            }
            //---------
            $measurement = SalwarMeasurement::create($data);
            DB::commit();
        }
        catch (\Exception $e) {
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

            return redirect()->route('adminPanel.salwarMeasurement.index')->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Measurement']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.salwarMeasurement.index')->withInput()->with(['notification' => $notification]);
        }
    }

    public function update(Request $request)
    {
        $user                = auth()->user();
        $measurement         = false;
        $error_message       = null;

            // Upload chart
        $measurement_image_name = "";
        if ($request->hasFile('size_chart')) 
        {
            $measurement_image = $this->uploadImage($request->file('size_chart'), config('constants.salwarMeasurement.images_path'), 75);
            if ($measurement_image['_status']) 
            {
                $measurement_image_name = $measurement_image['_data'];
            }
        }
            //------------------
        DB::beginTransaction();

        try {
            // Update data
            $measurement = SalwarMeasurement::find(1);
            $measurement->salwar_measurement_titles = $request['measurement_title'];
            $measurement->salwar_measurement_price  = $request['measurement_price'];
            $measurement->salwar_description        = $request['measurement_description'];
            if (!empty($measurement_image_name)) {
                $measurement->salwar_measurement_chart  = $measurement_image_name;
            }
            $measurement->save();
            /*To  update top title and description*/
            if(!empty($request['top']))
            {
                foreach ($request['top'] as  $value) {
                    if($value['id']!=0){
                        $top                    = SalwarTop::find($value['id']);
                    }
                    else{
                        $top                    = new SalwarTop;
                    }
                    $top->top_title         = $value['title'];
                    $top->top_description   = $value['description'];
                    $top->save();
                }
            }
            /*To  update bottom title and description*/
            if(!empty($request['bottom']))
            {
                foreach ($request['bottom'] as  $value) {
                    if($value['id']!=0){
                        $bottom                    = SalwarBottom::find($value['id']);
                    }
                    else{
                        $bottom                    = new SalwarBottom;
                    }
                    $bottom->bottom_title       = $value['title'];
                    $bottom->bottom_description = $value['description'];
                    $bottom->save();
                }
            }
            //---------
            DB::commit();
        }
        catch (\Exception $e) {
            $measurement          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
            //----------------------

        if (! is_null($measurement)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Measurement']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.salwarMeasurement.index')->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Measurement']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.salwarMeasurement.index')->withInput()->with(['notification' => $notification]);
        }
    }

    // public function destroy(Request $request)
    // {
    //     if ($request['delete']=='top') {
    //         $id = $request['id'];
    //         $top = SalwarTop::find($id);   
    //         $top->delete();
    //     }
    //     else{
    //         $id = $request['id'];
    //         $bottom = SalwarBottom::find($id);   
    //         $bottom->delete();
    //     }
    // }

}
