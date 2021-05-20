<?php

namespace App\Notifications\AdminPanel;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RestPasswordNotification extends Notification
{
    use Queueable;

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
        $greeting = sprintf('Hello %s!', $notifiable->name);
        $salutation = '';

        return (new MailMessage)
                    ->subject('Admin Reset Password')
                    ->greeting($greeting)
                    ->line('You are receiving this email because we recevied a password reset request for your account.')
                    ->action('Reset Password', route('adminPanel.passwordRestPage', ['token' => $this->token, 'email' => urlencode($notifiable->email)]));
                    // ->line('')
                    // ->salutation($salutation);
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
