<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Model\AccountSetting\AccountSetting;
use Zend\Diactoros\Response;
use App\Http\Traits\UploadImage;

class AccountSettingController extends Controller
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
     * View Account Setting
     * @author Bhagirath
     * @create_at 17-Feb-2020
     */

    public function index()
    {
        $account     = AccountSetting::first();
        if (!empty($account)) {
            /*if logo exists*/
            if ($account->site_logo != "") {
                $siteLogoUrl = get_image_url(config('constants.accountSetting.images_path'), $account->site_logo);
            } else {
                $siteLogoUrl = "";
            }
            if ($account->email_logo != "") {
                $emailLogoUrl = get_image_url(config('constants.accountSetting.images_path'), $account->email_logo);
            } else {
                $emailLogoUrl = "";
            }
            if ($account->scroll_logo != "") {
                $scrollLogoUrl = get_image_url(config('constants.accountSetting.images_path'), $account->scroll_logo);
            } else {
                $scrollLogoUrl = "";
            }
            $data = array(
                'account'           => $account,
                'siteLogoUrl'       =>  $siteLogoUrl,
                'emailLogoUrl'      =>  $emailLogoUrl,
                'scrollLogoUrl'     =>  $scrollLogoUrl,
            );
        } else {
            $data = array(
                'account'           => [],
                'siteLogoUrl'       => "",
                'emailLogoUrl'      => "",
                'scrollLogoUrl'     => "",
            );
        }
        return view('admin-panel.account-setting.index')->with($data);
    }
    /**
     * Store/ Update  Social Url.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 17 Feb 2020
     */
    public function update(Request $request, $id)
    {
        $user                = auth()->user();
        $account             = false;
        $error_message       = null;
        DB::beginTransaction();
        $account = AccountSetting::find(dv($id));

        $site_logo_name = $account->site_logo;
        // Update site logo if choosen
        if ($request->hasFile('site_logo')) {
            $site_logo = $this->uploadImage($request->file('site_logo'), config('constants.accountSetting.images_path'));
            if ($site_logo['_status']) {
                $site_logo_name = $site_logo['_data'];
            }
        }
        $email_logo = $account->email_logo;
        // Update  email logo if choosen
        if ($request->hasFile('email_logo')) {
            $email_logo = $this->uploadImage($request->file('email_logo'), config('constants.accountSetting.images_path'), 75);
            if ($email_logo['_status']) {
                $email_logo = $email_logo['_data'];
            }
        }
        $scroll_logo = $account->scroll_logo;
        // Update scroll logo if choosen
        if ($request->hasFile('scroll_logo')) {
            $scroll_logo = $this->uploadImage($request->file('scroll_logo'), config('constants.accountSetting.images_path'));
            if ($scroll_logo['_status']) {
                $scroll_logo = $scroll_logo['_data'];
            }
        }
        // Update data
        try {

            $account->site_name          = $request['site_name'];
            $account->site_email         = $request['site_email'];
            $account->top_tagline         = $request['top_tagline'];
            $account->site_sales_email   = $request['site_sales_email'];
            $account->site_number        = $request['site_number'];
            $account->site_logo          = $site_logo_name;
            $account->email_logo         = $email_logo;
            $account->scroll_logo        = $scroll_logo;
            $account->site_address       = $request['site_address'];
            $account->facebook_url       = $request['facebook_url'];
            // $account->twitter_url        = $request['twitter_url'];
            $account->instagram_url      = $request['instagram_url'];
            // $account->googleplus_url     = $request['google_plus_url'];
            $account->pinterest_url      = $request['pintrest_url'];

            $account->save();
            DB::commit();
        } catch (\Exception $e) {
            $account          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (!is_null($account)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Account Settings']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.accountSetting.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Account Settings']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.accountSetting.index')->withInput()->with(['notification' => $notification]);
        }
    }

    public function destroy(Request $request)
    {

        if ($request['id']) {
            $id = $request['id'];
            $account = AccountSetting::find($id);
            $account->delete();
        }
    }
}
