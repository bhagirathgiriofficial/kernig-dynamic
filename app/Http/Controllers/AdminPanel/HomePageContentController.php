<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Model\HomePageContent\HomePage;
use Datatables;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateCategory;
use App\Http\Traits\UploadImage;
use App\CustomLib\ImageCompress;
use File;

class HomePageContentController extends Controller
{
   use UploadImage;
   public function index($type)
   {
   	 $homePage = HomePage::where(function($query) use ($type){
   	 	if ($type=="female") {
   	 		$query->whereRaw('id >= 9');
   	 	}else{
   	 		$query->whereRaw('id < 9');
   	 	}
   	 })->get();
   	 $data = array(
   	 	'homePage' => $homePage,
   	 );
   	 return view('admin-panel.home-page-content.index')->with($data);		
   }  
   public function update(Request $request, $type){
      $homePage      = false;
      $error_message = null;

      foreach ($request['homePageContent'] as $key => $value) {
         $id           = dv($value['id']);
         $homePage     = HomePage::find($id);
      
         $image = $value['image'];
         if (!empty($image))
         {
            $homePageImage = $this->uploadImage($image, config('constants.homePageContent.images_path'), 75);
            if ($homePageImage['_status']) {
               $homePageContentImageName = $homePageImage['_data'];
                $destination_thumb_path =  config('constants.homePageContent.thumb_images_path');

                if (!File::exists($destination_thumb_path))
                {
                    File::makeDirectory($destination_thumb_path, 0777, true);
                }
      
                // Create thumbnail with compress
                $src = get_image_url(config('constants.homePageContent.images_path'),$homePageContentImageName); // Get Image
                $img = new ImageCompress; // Begin
                $img->set_img($src); // Set Path
                $img->set_quality(80); // Set Quality
                $img->set_size(200); // Set Pixal
                $img->save_img($destination_thumb_path.$homePageContentImageName); // Save Image
                $img->clear_cache();  // Clear Image Cache
                // ----------------------------
            }
         }
         else{   
               $homePageContentImageName = $homePage->image;
         }
       // ----------
       // Transaction
         DB::beginTransaction();
         try {
       // Updte Data
            $homePage->image = $homePageContentImageName;
            $homePage->title = $value['title'];
            $homePage->link  = $value['link'];
       // -----------
            $homePage->save();
            DB::commit();

         } catch (\Exception $e) {
            $homePage  = null;
            $error_message   = $e->getMessage();
            DB::rollback();

         }
       // -----------
      }
      if (! is_null($homePage)) {
       // Set notification
         $notification = [
            '_status'  => true,
            '_message' => __('messages.records_updated', ['record' => 'Home Page Content']),
            '_type'    => 'success'
         ];
       // --------------
      }
      else{
       // Set notification
         $notification = [
            '_status'  => true,
            '_message' => __('messages.records_updation_failed', ['record' => 'Home Page Content']),
            '_type'    => 'error'
         ];
       // --------------  
      }
      return redirect()->route('adminPanel.homePageContent.index', ['type' => $type])->with(['notification' => $notification]);

   } 
}
