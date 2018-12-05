<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }
}