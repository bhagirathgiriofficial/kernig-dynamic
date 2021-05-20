<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Testimonial\Testimonial;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateTestimonial;
use App\Http\Traits\UploadImage;
use App\CustomLib\ImageCompress;
use File;

class TestimonialController extends Controller
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
	* View Testimonials
	* @author Bhagirath 
	* @create_at 04-March-2020
	*/ 

	public function index ()
	{
		return view('admin-panel.testimonial.index');

	}

	/**
	* View Create Testimonial.
	* 
	* @author Bhagirath 
	* @create_at 04 -March- 2020
	*/
	public function create()
	{
		return view('admin-panel.testimonial.create');
	}

	/**
	* Store Testimonial.
	* 
	* @return mixed
	*  
	* @author Bhagirath 
	* @created_at 04 March 2020
	*/
	public function store(ValidateTestimonial $request)
	{
		$user                = auth()->user();
		$testimonial         = false;
		$error_message       = null;
				// Upload image

		$testimonial_image_name = "";
		if ($request->hasFile('testimonial_image')) 
		{
			$testimonial_image = $this->uploadImage($request->file('testimonial_image'), config('constants.testimonials.images_path'), 75);
			if ($testimonial_image['_status']) 
			{
				$testimonial_image_name = $testimonial_image['_data'];
                $destination_thumb_path =  config('constants.testimonials.thumb_images_path');

                if (!File::exists($destination_thumb_path))
                {
                    File::makeDirectory($destination_thumb_path, 0777, true);
                }
                // Create thumbnail with compress
                $src = get_image_url(config('constants.testimonials.images_path'),$testimonial_image_name); // Get Image
                $img = new ImageCompress; // Begin
                $img->set_img($src); // Set Path
                $img->set_quality(80); // Set Quality
                $img->set_size(150); // Set Pixel
                $img->save_img($destination_thumb_path.$testimonial_image_name); // Save Image
                $img->clear_cache();  // Clear Image Cache
                // ----------------------------
			}
		}
				//------------------
		$testimonialHomepage = 0;
		if ($request['testimonial_homepage'] == 'on') {
			$testimonialHomepage = 1;
		}
		DB::beginTransaction();
				// Create Measurment

		try {
				// Set data

			$data = [
					'testimonial_name'          => ucwords($request['testimonial_name']),
					'testimonial_message'       => ucfirst($request['testimonial_message']),
					'testimonial_place'         => ucwords($request['testimonial_place']),
					'testimonial_image'         => $testimonial_image_name,
					'testimonial_homepage'		=> $testimonialHomepage,
					'testimonial_status'        => 1,
			];
				//---------

			$testimonial = Testimonial::create($data);
			DB::commit();

		} catch (\Exception $e) {
			$testimonial          = null;
			$error_message   = $e->getMessage();
			DB::rollback();
		}
				//----------------------


		if (! is_null($testimonial)) {
				// Set notification

			$notification = [
				'_status'  => true,
				'_message' => __('messages.record_created', ['record' => 'Testimonial']),
				'_type'    => 'success'
			];
				//-----------------


			return redirect()->route('adminPanel.testimonial.index')->with(['notification' => $notification]);

		} else {
				// Set notification

			$notification = [
				'_status'  => false,
				'_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Testimonial']),
				'_type'    => 'error'
			];
				//-----------------
			return redirect()->route('adminPanel.testimonial.create')->withInput()->with(['notification' => $notification]);
		}
	}
	/**
	* Get Testimonial list.
	* 
	* @return response
	*  
	* @author Bhagirath
	* @created_at 04 March 2020
	*/
	public function getTestimonials(Request $request)
	{
		$auth_user = auth()->user();
		$testimonial = Testimonial::where(function($query) use ($request, $auth_user){
			if (!empty($request) && !empty($request->input('testimonial_name')))
			{
				$query->whereRaw('lower(testimonial_name) LIKE ? ',[trim(strtolower('%'.$request->input('testimonial_name'))).'%']);
			}
		})->orderBy('testimonial_id', 'DESC')->get();
		return DataTables::of($testimonial)
		->addColumn('status', function ($testimonial) {
			$status = '';
			if ( $testimonial->testimonial_status == 0 ){
				$status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
			} else {
				$status .= '<label class="badge badge-success">Active</label> &nbsp;';
			}
			return $status;
		})
		->addColumn('action', function ($testimonial) {

			$action = '<a href="'.route('adminPanel.testimonial.edit', ['id' => ev($testimonial->testimonial_id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
			return $action;
		})
		->addColumn('testimonial_image', function ($testimonial) {

			$image = get_image_url(config('constants.testimonials.images_path_thumb'),$testimonial->testimonial_image);

			if(!empty($image))
			{
				return '<img src="'.$image.'" width="50px"/>';
			}
			else
			{
				return 'N/A';
			}
		})
		->addColumn('testimonial_message', function($testimonial){
			return $testimonial->testimonial_message;
		})
		->addColumn('testimonial_order', function($testimonial){

            $order .= "<input type='number' name=id[]  value='".$testimonial->testimonial_id."' hidden/>";
            $order .= "<input type='number' name=order[] title='Enter only positive number' class='form-control text-left' value='".$testimonial->testimonial_order."' min='0'/>";

            return $order;			
   
		})
		->addColumn('testimonial_homepage',function($testimonial){
			if ($testimonial->testimonial_homepage ==1 ) {
				return '<label class="badge badge-success">Yes</label>';
			}
			else{
				return '<label class="badge badge-warning">No</label>';
			}
		})
		->rawColumns([
			'action'               => 'action',
			'status'               => 'status',
			'testimonial_image'    => 'testimonial_image',
			'testimonial_message'  => 'testimonial_message',
			'testimonial_homepage' => 'testimonial_homepage',
			'testimonial_order'	   => 'testimonial_order',
		])->addIndexColumn()->make(true);
	}
	/**
	* Destroy.
	* 
	* @return boolean
	*  
	* @author Bhagirath
	* @created_at 04 March 2020
	*/
	public function destroy(Request $request)
	{
		$testimonial         = Testimonial::whereIn('testimonial_id',$request['ids'])->delete();
				// Set response

		if ( $testimonial == true ) {
			$response = [
				'_status'  => true,
				'_message' => __('messages.record_deleted', ['record' => 'Testimonial']),
				'_type'    => 'success'
			];
		} else {
			$response = [
				'_status'  => false,
				'_message' => __('messages.record_failed', ['record' => 'Testimonial']),
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
	* @created_at 12 March 2020
	*/
	public function changeStatus(Request $request)
	{
		foreach ($request['ids'] as $value) {
			$testimonial = Testimonial::find($value);
			if ($testimonial->testimonial_status == 1) {
				$testimonial->testimonial_status = 0;
				$testimonial->save();
			}
			else
			{
				$testimonial->testimonial_status = 1;
				$testimonial->save();  
			}
		}
				// Set response

	if (!is_null($testimonial)) {
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
	* View edit Testimonial.
	* 
	* @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	*  
	* @author Bhagirath
	* @created_at 28 March 2020
	*/
	public function edit(Request $request, $id)
	{
		$testimonial = Testimonial::where('testimonial_id', dv($id))->first();
		$image = get_image_url(config('constants.testimonials.images_path'),$testimonial->testimonial_image);
		$this->viewData['testimonial'] = $testimonial;  
		$this->viewData['image']       = $image;        
		return view('admin-panel.testimonial.edit')->with($this->viewData);
	}
	/**
	* Update Testimonial.
	* 
	* @return mixed
	*  
	* @author Bhagirath
	* @created_at 20 March 2020
	*/
	public function update(ValidateTestimonial $request, $id)
	{
		$user             = auth()->user();
		$testimonial         = false;
		$error_message    = null;

		DB::beginTransaction();


		// Upload image

		$testimonial = Testimonial::find(dv($id));
		$testimonial_image_name = $testimonial->testimonial_image;
		if ($request->hasFile('testimonial_image')) 
		{
			$testimonial_image = $this->uploadImage($request->file('testimonial_image'), config('constants.testimonials.images_path'), 75);
			if ($testimonial_image['_status']) 
			{
				$testimonial_image_name = $testimonial_image['_data'];
                $destination_thumb_path =  config('constants.testimonials.thumb_images_path');

                if (!File::exists($destination_thumb_path))
                {
                    File::makeDirectory($destination_thumb_path, 0777, true);
                }
                // Create thumbnail with compress
                $src = get_image_url(config('constants.testimonials.images_path'),$testimonial_image_name); // Get Image
                $img = new ImageCompress; // Begin
                $img->set_img($src); // Set Path
                $img->set_quality(80); // Set Quality
                $img->set_size(150); // Set Pixel
                $img->save_img($destination_thumb_path.$testimonial_image_name); // Save Image
                $img->clear_cache();  // Clear Image Cache
                // ----------------------------
			}
		}
		// Update Testimonial
		$testimonialHomepage = 0;
		if ($request['testimonial_homepage'] == 'on') {
			$testimonialHomepage = 1;
		}
		try {

		// Set data
			$testimonial->testimonial_name     = ucwords($request['testimonial_name']);
			$testimonial->testimonial_message  = ucfirst($request['testimonial_message']);
			$testimonial->testimonial_place    = ucwords($request['testimonial_place']);
			$testimonial->testimonial_image    = $testimonial_image_name;      
			$testimonial->testimonial_homepage = $testimonialHomepage;
			$testimonial->save();
		//---------
			DB::commit();
		} catch (\Exception $e) {
			$testimonial          = null;
			$error_message   = $e->getMessage();
			DB::rollback();
		}
		//----------------------

		if ($testimonial == true) {
		// Set notification

			$notification = [
				'_status'  => true,
				'_message' => __('messages.records_updated', ['record' => 'Testimonial']),
				'_type'    => 'success'
			];
		//-----------------=

			return redirect()->route('adminPanel.testimonial.index')->with(['notification' => $notification]);

		} else {
		// Set notification

			$notification = [
				'_status'  => false,
				'_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Testimonial']),
				'_type'    => 'error'
			];
		//-----------------

			return redirect()->route('adminPanel.testimonial.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
		}
	}
	/**
    * Change order.
    * 
    * @return mixed
    *  
    * @author Bhagirath
    * @created_at 16 April 2020
    */
    public function changeOrder(Request $request){

        foreach ($request['id'] as $key => $value) {
            DB::beginTransaction();
            try
            {
                $testimonial = Testimonial::find($value);
                if ($request['order'][$key] < 0) {
                $testimonial->testimonial_order =  0;	
                }
                else{
                $testimonial->testimonial_order = $request['order'][$key] ?? 0;
                }
                $testimonial->save();
                DB::commit();
            }
            catch (\Exception $e) {
                $testimonial     = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($testimonial == true) {
        // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Testimonial']),
                '_type'    => 'success'
            ];
        //-----------------=
            return redirect()->back()->with(['notification' => $notification]);

        } else {
        // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Testimonial']),
                '_type'    => 'error'
            ];
        //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }

}
