<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Slider\Slider;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateSlider;
use App\Http\Traits\UploadImage;

class SliderImageController extends Controller
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
     * View Slider
     * @author Bhagirath
     * @create_at 15 Feb 2020
     */

    public function index()
    {
        return view('admin-panel.slider.index');
    }

    /**
     * Check Slider Name.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 15 Feb 2020
     */
    public function checkSliderTitle(Request $request)
    {
        $status = false;

        if (!is_null($request->slider_title)) {
            $slider = Slider::where('slider_title', $request['slider_title'])->first();
            if (!is_null($slider)) {
                if ($request->filled('id') && $slider->slider_id == dv($request['id'])) {
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
     * Store Slider.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 15 Feb 2020
     */
    public function store(ValidateSlider $request)
    {


        $user              = auth()->user();
        $slider           = false;
        $error_message     = null;

        // Upload chart
        if ($request->hasFile('slider_image')) {
            $slider_image = $this->uploadImage($request->file('slider_image'), config('constants.slider.images_path'), 75);
            if ($slider_image['_status']) {
                $slider_image_name = $slider_image['_data'];
            }
        }

        //------------------
        DB::beginTransaction();
        // Create Slider
        try {
            // Set data
            $data =
                [
                    'slider_title'          => $request['slider_title'],
                    'slider_link'           => $request['slider_link'],
                    'slider_image'          => $slider_image_name,
                    'slider_description'    => $request['slider_description'],
                ];
            //---------
            $slider = Slider::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $slider          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (!is_null($slider)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Slider']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.slider.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Slider']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->route('adminPanel.slider.create')->withInput()->with(['notification' => $notification]);
        }
    }

    /**
     * Get Slider list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 15 Feb 2020
     */
    public function getSliders(Request $request)
    {

        $auth_user = auth()->user();

        $slider = Slider::where(function ($query) use ($request) {
            if (!empty($request) && !empty($request->input('slider_title'))) {
                $query->whereRaw('lower(slider_title) LIKE ? ', [trim(strtolower('%' . $request->input('slider_title'))) . '%']);
            }
        })->orderBy('slider_id', 'DESC')->get();

        return DataTables::of($slider)
            ->addColumn('status', function ($slider) {
                $status = '';
                if ($slider->slider_status == 0) {
                    $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
                } else {
                    $status .= '<label class="badge badge-success">Active</label> &nbsp;';
                }
                return $status;
            })
            ->addColumn('action', function ($slider) {

                $action = '<a href="' . route('adminPanel.slider.edit', ['id' => ev($slider->slider_id)]) . '" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

                return $action;
            })
            ->addColumn('image', function ($slider) {
                $image_url = get_image_url(config('constants.slider.images_path'), $slider->slider_image);
                if ($image_url) {
                    return '<img src="' . $image_url . '" width="50px"/>';
                } else {
                    return "N/A";
                }
            })
            ->rawColumns([
                'image'       => 'image',
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
     * @created_at 15 Feb 2020
     */
    public function destroy(Request $request)
    {


        $slider         = Slider::whereIn('slider_id', $request['ids'])->delete();
        // Set response
        if ($slider == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Slider']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Slider']),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
     * View create Slider.
     *
     * @author Bhagirath
     * @create_at 15-Feb-2020
     */
    public function create()
    {

        return view('admin-panel.slider.create');
    }

    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 15 Feb 2020
     */
    public function changeStatus(Request $request)
    {
        //
        foreach ($request['ids'] as $value) {
            $slider = Slider::find($value);
            if ($slider->slider_status == 1) {
                $slider->slider_status = 0;
                $slider->save();
            } else {
                $slider->slider_status = 1;
                $slider->save();
            }
        }
        // Set response
        if (!is_null($slider)) {
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
     * View edit Slider.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Bhagirath
     * @created_at 15 Feb 2020
     */
    public function edit(Request $request, $id)
    {
        $slider = Slider::where('slider_id', dv($id))->first();
        $image_url = get_image_url(config('constants.slider.images_path'), $slider->slider_image);
        $this->viewData['image_url'] = $image_url;
        $this->viewData['slider'] = $slider;
        return view('admin-panel.slider.edit')->with($this->viewData);
    }

    /**
     * Update Slider.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 15 Feb 2020
     */
    public function update(ValidateSlider $request, $id)
    {
        $user             = auth()->user();
        $slider         = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Slider
        $slider = Slider::find(dv($id));
        // Upload chart
        $slider_image_name = $slider->slider_image;
        if ($request->hasFile('slider_image')) {
            $slider_image = $this->uploadImage($request->file('slider_image'), config('constants.slider.images_path'), 75);
            if ($slider_image['_status']) {
                $slider_image_name = $slider_image['_data'];
            }
        }
        try {

            $slider->slider_title          = $request['slider_title'];
            $slider->slider_link           = $request['slider_link'];
            $slider->slider_image          = $slider_image_name;
            $slider->slider_description    = $request['slider_description'];
            $slider->save();

            //---------
            DB::commit();
        } catch (\Exception $e) {
            $slider          = null;
            $error_message   = $e->getMessage();

            DB::rollback();
        }
        //----------------------

        if ($slider == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Slider']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.slider.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Slider']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.slider.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
