<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email;
    protected $data;
    protected $subject;
    protected $emailtype;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $data ,$subject, $emailtype)
    {
        $this->email = $email;
        $this->data = $data;
        $this->subject = $subject;
        $this->emailtype = $emailtype;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $email = $this->email;
        $data = $this->data;
        $subject = $this->subject;
        $emailtype = $this->emailtype;
        $mailer->send($emailtype , $data, function ($message) use ($email, $subject) {
            $message->to($email);
            $message->subject($subject);
            $message->from(config('app.webmasterEmail'));
        });
    }
}
