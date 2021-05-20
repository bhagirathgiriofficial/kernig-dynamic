<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Master_Page\Master_Page;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidatePage;
use App\Http\Traits\UploadImage;

class PageController extends Controller
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
	* View Pages
	* @author Bhagirath 
	* @create_at 21-Feb-2020
	*/

    public function index($id)
    {

        $page= Master_Page::find(dv($id));
        $image_path = get_image_url(config('constants.page.images_path'),$page->image_name);
        $data = array(
            'page'       => $page,
            'image_path' => $image_path,
        );  
        return view('admin-panel.page.create')->with($data);
    }
    public function update(Request $request, $id)
    {   
        
        $page            =  false;
        $error_message   =  null;
        $page_id         =  dv($id);
        $page            =  Master_Page::find($page_id);
        if ($page->description_flag && $request['page_long_description']=="") {

           // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.is_required', ['record' => 'Long description']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.page.index',['id' => $id])->withInput()->with(['notification' => $notification]);
        }
        elseif (strlen($request['page_long_description']) > 3000) {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.limited_length', ['record' => 'Long description', 'size' => '3000']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->route('adminPanel.page.index',['id' => $id])->withInput()->with(['notification' => $notification]);  
        }

        // Upload image
        $page_image_name = "";
        if ($request->hasFile('page_image')) {

            $page_image = $this->uploadImage($request->file('page_image'), config('constants.page.images_path'), 75);
            if ($page_image['_status']) {
                $page_image_name = $page_image['_data'];
            }
        }
        DB::beginTransaction();

        // Create Page
        try {
            // Set data
            if ($page_image_name=="") {
                if ($page->image_name!="") {
                $page_image_name = $page->image_name;
                }
            }
                $page->image_name                = $page_image_name;
                $page->page_short_description    = $request['page_short_description'] ?? "";
                $page->page_long_description     = $request['page_long_description'] ?? "";
                $page->page_meta_title           = $request['page_meta_title'] ?? "";
                $page->page_meta_keyword         = $request['page_meta_keyword'] ?? "";
                $page->page_meta_description     = $request['page_meta_description'] ?? "";

            //---------

            $page->save();
            
            DB::commit();
        } catch (\Exception $e) {
            $page         = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (! is_null($page)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Page']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.page.index',['id' => $id])->with(['notification' => $notification]);

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Page']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.page.index',['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }

}
