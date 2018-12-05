<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendParticipantEditAddEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email_list_arr;
    protected $participant;
    protected $data;
    protected $emailtype;
    protected $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_list_arr, $participant, $data, $emailtype, $subject)
    {
        $this->email_list_arr = $email_list_arr;
        $this->participant = $participant;
        $this->data = $data;
        $this->emailtype = $emailtype;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $email_list_arr = $this->email_list_arr;
        $participant = $this->participant;
        $data = $this->data;
        $emailtype = $this->emailtype;
        $subject = $this->subject;
        $mailer->send( $emailtype , $data, function ($message) use ($email_list_arr, $participant, $subject) {
            $message->from(config('app.webmasterEmail'));
            $message->to($email_list_arr);
            $message->subject($subject.$participant->fname.' '.$participant->middleinitial.' '.$participant->lname);
        });
    }
}