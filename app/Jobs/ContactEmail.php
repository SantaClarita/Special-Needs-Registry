<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email_list_arr;
    protected $subject;
    protected $emailtype;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_list_arr, $data, $emailtype, $subject)
    {
        $this->email_list_arr = $email_list_arr;
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
        $subject = $this->subject;
        $emailtype = $this->emailtype;
        $data = $this->data;
        $mailer->send($emailtype , $data, function ($message) use ($email_list_arr, $subject) {
            $message->to($email_list_arr);
            $message->subject($subject);
            $message->from(config('app.webmasterEmail'));
        });
    }
}