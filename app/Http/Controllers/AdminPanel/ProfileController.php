<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\UpdateProfile;
use App\Http\Requests\AdminPanel\ChangePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\UploadImage;
use App\Model\AdminUser\AdminUser;
use App\User;

class ProfileController extends Controller
{
    use UploadImage;

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
     * View profile.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Sumit
     * @created_at 17 July 2019
     */
    public function index()
    {
        $this->viewData['user'] = auth()->user();

        return view('admin-panel.profile.index')->with($this->viewData);
    }

    /**
     * Update profile.
     * 
     * @return mixed
     *  
     * @author Sumit
     * @created_at 18 July 2019
     */
    public function update(UpdateProfile $request)
    {

        $record_updated = false;
        $user           = auth()->user();
        $file_name      = $user->profile_image;

        // Upload user image
        if ($request->hasFile('image')) {

            // Remove old image
            if (!is_null($user->image)) {
                delete_image(config('constants.adminUsers.images_path'),$user->image);
            }
            //-----------------

            $file = $this->uploadImage($request->file('image'),config('constants.adminUsers.images_path'), 75);
            if ($file['_status']) {
                $file_name = $file['_data'];
            }
        }
        //------------------

        DB::beginTransaction();

        // Update user
        try {

            $record_updated = AdminUser::find($user->id);
            $record_updated->name           = $request['name'];
            $record_updated->mobile_number  = $request['mobile_number'];
            $record_updated->profile_image  = $file_name;

            $record_updated->save();

            DB::commit();

        } 
        catch (\Exception $e) {
            DB::rollback();
        }
        //------------

        if ($record_updated) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.profile_updated'),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.profile')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => __('messages.profile_updation_failed'),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.profile')->withInput()->with(['notification' => $notification]);
        }
    }

    /**
     * Change password.
     * 
     * @return mixed
     *  
     * @author Sumit
     * @created_at 18 July 2019
     */
    public function changePassword(ChangePassword $request)
    {
        $record_updated = false;
        $user           = auth()->user();

        if (Hash::check($request->get('current_password'), $user->password)) {

            DB::beginTransaction();

            // Update password
            try {
                $record_updated = AdminUser::where('id', $user->id)->update([
                    'password' => bcrypt($request['new_password'])
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            //------------

            if ($record_updated) {
                // Set notification
                $notification = [
                    '_status'  => true,
                    '_message' => __('messages.password_updated'),
                    '_type'    => 'success'
                ];
                //-----------------
    
                return redirect()->route('adminPanel.profile')->with(['notification' => $notification]);
            } else {
                // Set notification
                $notification = [
                    '_status'  => false,
                    '_message' => __('messages.password_updation_failed'),
                    '_type'    => 'error'
                ];
                //-----------------
    
                return redirect()->route('adminPanel.profile')->withInput()->with(['notification' => $notification]);
            }

        } else {
            $request->merge(['is_change_password_form' => true]);
            return redirect()->back()->withInput()->withErrors(__('messages.password_not_matched'));
        }
    }


}
