<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class ContactMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $emailContent = [];
        $emailContent = $this->details;

        Mail::send('emails.contact_us_admin_mail', $emailContent, function ($message) use ($emailContent) {
            $message->to($emailContent['admin_email']);
            $message->subject('This e-mail was sent from a Contact form of Bagtesh Fashion');
        });

        Mail::send('emails.contact_us_user_mail', $emailContent, function ($message) use ($emailContent) {
            $message->to($emailContent['contact_email']);
            $message->subject('We will get back soon!');
        });

    }
}
