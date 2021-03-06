<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Storage;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailListMail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email_list_arr;
    protected $subject;
    protected $body;
    protected $attachmentData;
    protected $emailtype;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_list_arr, $subject, $body, $attachmentData, $emailtype)
    {
        $this->email_list_arr = $email_list_arr;
        $this->subject = $subject;
        $this->body = $body;
        $this->attachmentData = $attachmentData;
        $this->emailtype = $emailtype;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {   
        //fill data for mail
        $email_list_arr = $this->email_list_arr;
        $subject = $this->subject;
        $body = $this->body;
        $attachmentData = $this->attachmentData;
        $emailtype = $this->emailtype;

        //send mail
        $mailer->send( $emailtype , ['body' => $body, ], function ($message) use ($email_list_arr, $subject, $attachmentData) {
            $message->from(config('app.webmasterEmail'));
            //$message->bcc(config('app.webmasterEmail'));
            $message->bcc($email_list_arr);
            $message->subject($subject);
            if ($attachmentData['filepath'] != "")
                $message->attachData(Storage::get($attachmentData['filepath']), $attachmentData['filename']); 
        });

        //file is no longer needed
        Storage::delete($attachmentData['filepath']);
    }
}
