<?php

namespace App\Http\Controllers;

use Gate;
use Auth;
use App\Log;

if (class_exists("\\Illuminate\\Routing\\Controller")) {
    class BaseController extends \Illuminate\Routing\Controller {}
} else if (class_exists("Laravel\\Lumen\\Routing\\Controller")) {
    class BaseController extends \Laravel\Lumen\Routing\Controller {}
}

class LogController extends BaseController
{
    protected $request;

    public function __construct ()
    {
        $this->middleware('auth');
        $this->request = app('request');
    }

    public function index()
    {
        if (policy(Log::class)->viewLogs(Auth::user())) {
            if ($this->request->input('l')) {
                Log::setFile(base64_decode($this->request->input('l')));
            }

            if ($this->request->input('dl')) {
                return $this->download(Log::pathToLogFile(base64_decode($this->request->input('dl'))));
            } elseif ($this->request->has('del')) {
                app('files')->delete(Log::pathToLogFile(base64_decode($this->request->input('del'))));
                return $this->redirect($this->request->url());
            } elseif ($this->request->has('delall')) {
                foreach(Log::getFiles(true) as $file){
                    app('files')->delete(Log::pathToLogFile($file));
                }
                return $this->redirect($this->request->url());
            }

            return view('log', [ 
                'logs' => Log::all(),
                'files' => Log::getFiles(true),
                'current_file' => Log::getFileName()
            ]); 
        }
         abort(401, 'You are not authorized to view or preform that action.');
    }

    private function redirect($to)
    {
        if (function_exists('redirect')) {
            return redirect($to);
        }

        return app('redirect')->to($to);
    }

    private function download($data)
    {
        if (function_exists('response')) {
            return response()->download($data);
        }

        // For laravel 4.2
        return app('\Illuminate\Support\Facades\Response')->download($data);
    }
}
