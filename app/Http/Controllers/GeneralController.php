<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Redirect;

use App\Emaillist;
use App\Setting;

use Mail;
use App\Jobs\ContactEmail;
use App\Repositories\SettingRepository;

class GeneralController extends Controller
{
    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
    }

    public function contactIndex()
    {
        return view('contactus');
    }

    public function faqsIndex()
    {
        return view('faqs');
    }

    public function aboutIndex()
    {
        return view('about');
    }

    public function contactUs(Request $request)
    {
        $this->validate($request, [ 
                'name' => 'required',
                'email' => 'required|email',
                'comments' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ]);

        $data = [ 
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'comments' => $request->input('comments'),
            ];

        $email_list_arr = array();
        $email_list_arr = $this->settings->getEmailsWithSettingID(2);
        $job = (new ContactEmail ($email_list_arr, $data,
            'emails.contactus', 'Contact Us - '. $request->get('name').'('.$request->get('email').') has comments/questions'  ))->delay(30); 
        $this->dispatch($job);
        $request->session()->flash('status', 'Your message was sent to an admin successfully!');
        return redirect()->back(); //with flash success 
    }

    public function tutorialIndex(Request $request)
    {
        return view('tutorial');
    }
}
