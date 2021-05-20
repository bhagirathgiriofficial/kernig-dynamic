<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails every 10 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::raw('Hello', function ($message) {
            $message->from('v2rteam@gmail.com', 'Laravel');
            $message->subject('Cron Mail');
            $message->to('khushbuvaishnav@v2rsolution.com');
        });
    }
}
