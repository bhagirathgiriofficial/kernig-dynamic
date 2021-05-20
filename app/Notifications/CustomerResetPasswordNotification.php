<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

use App\Model\User\User;

class CustomerResetPasswordNotification extends Notification
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

        $salutation             = 'You are receiving this email because we recevied a password reset request for your account.';
        $message                = "";
        $emailData              = [];
        $emailData['email']     = $notifiable->email;
        $emailData['receiver']  = $notifiable->f_name!=''? $notifiable->f_name:'User';
        $greeting               = sprintf('Hello %s!', $emailData['receiver']);

        return (new MailMessage)
            ->subject('Password Reset Request')
            ->greeting($greeting)
            ->action('Reset Password', url('password/reset', ['token' => $this->token, 'email' => urlencode($notifiable->email)]))
            ->line('If you did not request a password reset, no further action is required.')
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
