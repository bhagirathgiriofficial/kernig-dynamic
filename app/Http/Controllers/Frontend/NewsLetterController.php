<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Newsletter\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AccountSetting\AccountSetting;
use Illuminate\Support\Facades\Mail;

class NewsLetterController extends Controller
{
    public function subscribe(Request $request)
    {
        $email = $request['email'];
        $accountSettings = AccountSetting::first();
        $siteName = $accountSettings->site_name;
        $siteEmail = $accountSettings->site_email;
        $subscriber = NewsLetter::where('news_letter_email', $email)->first();
        if (!is_null($subscriber)) {
            $response['status'] = 2;
            $response['message'] = "Your email is already subscribed";
        } else {
            try {
                $newsLetter = new Newsletter;
                $newsLetter->news_letter_email = $email;
                $newsLetter->save();
                $response['status'] = 1;
                $response['message'] = "Subscribed successfully";
                // Mail::raw("Email subscribed Successfully, Regards $siteName", function ($message) {
                //     global $siteName, $siteEmail, $email;
                //     $message->from($siteEmail, $siteName);
                //     $message->to($email);
                //     $message->subject('Subject');
                // });
            } catch (\Exception $e) {
                p($e->getMessage());
                $response['status'] = 0;
                $response['message'] = "Unable to subscribe";
            }
        }
        return response()->json($response);
    }
}
