<?php

namespace App\Console;

use Mail;
use Carbon;

use App\Participant;
use App\User;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->call(function () {
            $participants = Participant::where('updated_at', '<=', Carbon\Carbon::now()->subMonths(6))->get();
            //check if emailed_at is more than 6 months and if updated_at is more than 6 months

            foreach ($participants as $participant) {
                if ($participant->emailed_at < $participant->updated_at) {
                    //If participant got emailed more than 6 months ago and their information is more than 6 months old
                    $updatedchk = 
                        strtotime(Carbon\Carbon::parse($participant->emailed_at)) < strtotime(Carbon\Carbon::now()->subMonths(6)) &&
                        strtotime(Carbon\Carbon::parse($participant->updated_at)) < strtotime(Carbon\Carbon::now()->subMonths(6)); 

                    // If participant got emailed more than 6 months ago and their information is more than 6 months old 
                    // This is the error checks for empty updated_at (Legacy - Old Database) but dependent infomation was registered but never updated
                    $createdchk =
                        strtotime(Carbon\Carbon::parse($participant->emailed_at)) < strtotime(Carbon\Carbon::now()->subMonths(6)) &&
                        strtotime(Carbon\Carbon::parse($participant->created_at)) < strtotime(Carbon\Carbon::now()->subMonths(6)); 
                    if ($participant->updated_at == NULL || $participant->updated_at == '0000-00-00 00:00:00.000000')
                        $updatedchk = $createdchk;
                    if ($updatedchk) {
                        //get owner of the participant
                        if (User::where('id',$participant->user_id)->first())
                        {
                            $user = User::find($participant->user_id);
                            //fill data
                            $email = $user->email;
                            $data = [
                                'user_fname' => $user->fname,
                                'user_lname' => $user->lname,
                                'user_email' => $user->email,
                                'user_phone' => $user->phone,
                                'fname' => $participant->fname,
                                'middleinitial' => $participant->middleinitial,
                                'lname' => $participant->lname,
                                'id' => $participant->id,
                            ];
                            
                            //send mail
                            if (!$user->stopReminderEmails) {
                                Mail::send('emails.participantinfonotify', $data, function ($message) use ($participant, $email) {
                                    $message->from(config('app.webmasterEmail'));
                                    $message->bcc(config('app.webmasterEmail'));
                                    $message->to($email)->subject('Participant Information Out Of Date - '.$participant->fname.' '.$participant->middleinitial.' '.$participant->lname);
                                });
                                //ignore update stamp as well
                                $participant->timestamps = false;
    
                                //says the participant got emailed so he/she doesnt receieve this email until 6 months later
                                $participant->emailed_at = Carbon\Carbon::now();
                                $participant->save();
                                //turn on updates again
                                $participant->timestamps = true;
                            }
                        }
                    }
                }
            }          
        })->weekly();*/
    }
}
