<?php

namespace App\Http\Controllers\Auth;

use Mail;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Jobs\NewUserEmail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/participants';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone' => 'required|phone',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->roles()->attach('1');

        $data = [ 
            //new info
            'user_fname' => $user->fname,
            'user_lname' => $user->lname,
            'user_phone' => $user->phone,
            'user_email' => $user->email,
        ];


        $subject = 'Welcome to the Special Needs Registry, '.$user->f_name.' '.$user->l_name.'!';
        $email = $user->email;
        $job = (new NewUserEmail ($email, $data, $subject, 'emails.welcome'))->delay(30); 
        $this->dispatch($job);

        // Mail::send('emails.welcome', $data, function ($message) use ($user) {
        //     $message->from(config('app.webmasterEmail'));
        //     $message->to($user->email)->subject('Welcome to Clear, '.$user->f_name.' '.$user->l_name.'!');
        // });

        return $user;
    }
}
