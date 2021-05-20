<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\PackagePaper;
use Mail;
class cronPaperReleaseDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'date:release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date = Carbon::now()->toDateString();

        $releaseDate =  PackagePaper::where(function($query) use($date) {
                            $query->where('release_date', $date);
                        })->join('package_user', function($join) {
                                $join->on('package_user.package_id', 'package_paper.package_id');
                        })->join('users', function($join) {
                                $join->on('package_user.user_id', 'users.id');
                        })->with(['packages' => function($query) {
                                $query->select('id', 'name');
                        }])->with(['papers' => function($query) {
                                $query->select('id', 'name');
                        }])->get()->toArray();

        foreach($releaseDate as $value)
        {
            $subject = trans('language.mail_subject');
            $value['package_name'] = $value['packages']['name'];
            $value['paper_name']   = $value['papers']['name'];

            // Send Mail
            Mail::send('emails.admin-panel.release-date-email', $value, function ($message) use ($value, $subject) {
                $message->to($value['email'], $value['name'])->subject($subject);
            });

            // Push Notification
            $title = trans('language.mail_subject');
            $notification_type = 1;  // Package Paper Release
            $message = 'Your Package'. $value['packages']['name'] .' Paper'. $value['papers']['name'] .' has been Released Today!';
            
            push_notification($value['paper_id'], $message, $value['fcm_token'], $title, $notification_type, $value['user_id'], '', '', $value['platform']);

        } 
    }
}
