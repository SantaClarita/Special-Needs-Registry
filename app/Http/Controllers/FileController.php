<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Storage;
use Gate;
use App\Participant;
use Auth;

class FileController extends Controller {

  	public function __construct()
  	{
  		$this->middleware('auth');
  	}

  	public function getFile($filename)
  	{
  		if (policy(Participant::class)->CanSearchParticipants(Auth::user())) {
  			return response()->file(storage_path('app/participants/'.$filename));
  		}
  	}
}