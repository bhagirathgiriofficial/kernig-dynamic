<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

use App\Model\PursueitOTP;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
       $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $otp = generateOTP();

        $pursueitOTP = PursueitOTP::where('provider_id',$notifiable->provider_id)->first();

        if( !empty($pursueitOTP) ){

            DB::beginTransaction();
            try
            {
                $pursueitOTP->opt_number        = $otp;
                $pursueitOTP->opt_token         = $this->token;
                $pursueitOTP->otp_resend_count  = $pursueitOTP->otp_resend_count + 1;
                $pursueitOTP->save();
            }
            catch (\Exception $e)
            {
                DB::rollback();
                $error_message = $e->getMessage();
            }
            DB::commit();

        } else {

            $pursueitOTP  = New PursueitOTP;
            DB::beginTransaction();
            try
            {
                $pursueitOTP->provider_id       = $notifiable->provider_id;
                $pursueitOTP->opt_number        = $otp;
                $pursueitOTP->opt_token         = $this->token;
                $pursueitOTP->opt_type          = 'forgot';
                $pursueitOTP->otp_resend_count  = 0;
                $pursueitOTP->save();
            }
            catch (\Exception $e)
            {
                DB::rollback();
                $error_message = $e->getMessage();
            }
            DB::commit();
        }
        
        $greeting = sprintf('Hello '.$notifiable->provider_name.'!');
        $salutation = 'You are receiving this email because we recevied a password reset request for your account.';

        return (new MailMessage)
                    ->subject('Reset Password')
                    ->greeting($greeting)
                    ->line('Enter the six-digit confirmation code below at the prompt to reset your password.<br> <span style="text-decoration: underline; font-size: 25px; color: #ee6436; font-weight: 500; ">'.$otp.'</span> <br><br><span style="font-size:18px;">if you have not initiated this request, please send an email to <br>support@pursueit.ae </span>')
                    ->salutation($salutation);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
