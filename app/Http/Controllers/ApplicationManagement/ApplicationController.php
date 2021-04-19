<?php

namespace App\Http\Controllers\ApplicationManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Storage;
use Mail;
use Gate;

use App\User;
use App\Http\Requests;
use App\Participant;
use App\ParticipantEthnicity;
use App\Repositories\DisabilityRepository;
use App\Repositories\ParticipantRepository;
use App\Repositories\SettingRepository;

use App\Jobs\SendParticipantEditAddEmail;

class ApplicationController extends Controller
{
    protected $disabilities, $dependents;

    public function __construct(DisabilityRepository $disabilities, ParticipantRepository $participants, SettingRepository $settings)
    {
        $this->middleware('auth');
        $this->disabilities = $disabilities;
        $this->participants = $participants;
        $this->settings = $settings;
    }

    public function create()
    {
        return view('applications.create'); 
    }

    public function nav(Request $request, Participant $participant)
    {
        $status = $participant->status;

        $url = route('step_one', $participant->id);

        if ($status == 1)
            return redirect()->route('step_one', $participant->id);
        else if ($status == 2)
            return redirect()->route('step_two', $participant->id);
        else if ($status == 3)
            return redirect()->route('step_three', $participant->id);
        else if ($status == 4)
            return redirect()->route('step_four', $participant->id);
        else if ($status == 5)
            return redirect()->route('step_five', $participant->id);
        else
            return redirect()->route('step_one', $participant->id);
    }

    public function edit_zero(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            return view('applications.edit-zero',[
                    'participant' => $participant,
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update_zero(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            $this->validate($request, [ 
                'image' => 'filled|mimes:jpg,jpeg,png|dimensions:min_width=250,min_height=250',
                'fname' => 'required|max:255',
                'middleinitial' => 'max:5',
                'lname' => 'required|max:255',
                'nickname' => 'max:50',
                'gender' => 'required',
                'month' => 'required',
                'day' => 'required',
                'year' => 'required',
            ]);

            //do an image chk to prevent getclientoriginalextension error
            $img_chk = false;
            if ( $request->hasFile('image') && $request->input('mailimage') == null  )
                $img_chk = true;
            $imagename = "";
            $imagepath = "";

            if ( $img_chk ) {
                $imagepath = 'participants/';
                $imagename = $participant->id.'.'.$request->file('image')->getClientOriginalExtension();
            }

            //fill data
            $participant = Participant::find($participant->id);
            $participant->fname = $request->input('fname');
            $participant->middleinitial = $request->input('middleinitial');
            $participant->lname = $request->input('lname');
            $participant->nickname = $request->input('nickname');
            $participant->birthdate = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $participant->gender = $request->input('gender');

            if ( $img_chk ) 
                $participant->image_link = $imagepath.$imagename;

            //save and store image
            $participant->save(); 
            if ( $img_chk ) {
                Storage::put(
                    'participants/'.$participant->id.'.'.$request->file('image')->getClientOriginalExtension(),
                    file_get_contents($request->file('image')->getRealPath())
                );
            }

            return redirect()->route('nav', ['participant' => $participant,]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    public function edit_one(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            return view('applications.edit-one',[
                    'participant' => $participant,
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update_one(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            $this->validate($request, [ 
                'ethnicity1' => 'required',
                //'ethnicity2' => 'required',
                'haircolor' => 'required|max:20',
                'eyecolor' => 'required',
                'heightfeet' => 'required',
                'heightinch' => 'required',
                'weight' => 'required|numeric',
                'disability' => 'required|max:50',
                'identifyingfeatures' => 'required|max:150',
                'idonparticipant' => 'required|max:150',
                'approachsuggestions' => 'required|max:300',
            ]);

            $participant->ethnicity1 = $request->input('ethnicity1');
            $participant->ethnicity2 = $request->input('ethnicity2');
            $participant->haircolor  = $request->input('haircolor');
            $participant->eyecolor  = $request->input('eyecolor');
            $participant->height = $request->input('heightfeet')*12+$request->input('heightinch');
            $participant->weight = $request->input('weight');
            $participant->disability  = $request->input('disability');
            $participant->identifyingfeatures  = $request->input('identifyingfeatures');
            $participant->idonparticipant  = $request->input('idonparticipant');
            $participant->approachsuggestions  = $request->input('approachsuggestions');
            if($participant->status < 2)
                $participant->status  = 2;

            $participant->save(); 

            return redirect()->route('nav', ['participant' => $participant,]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    public function edit_two(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 1) {
            return view('applications.edit-two',[
                    'participant' => $participant,
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update_two(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)  && $participant->status > 1) {
            $this->validate($request, [ 
                'livealone' => 'required',
                'typeofresidence' => 'required',
                'address1' => 'required',
                //'address2' => 'required',
                'city' => 'required|alpha_space',
                'state' => 'required',
                'zip' => 'required',
                'homephone' => 'required_without:cellphone',
                'cellphone' => 'required_without:homephone',
                //'sendtwocards' => 'required',
                'eme_relation' => 'required',
                'eme_name' => 'required',
                'eme_address1' => 'required',
                //'eme_address2' => 'required',
                'eme_city' => 'required|alpha_space',
                'eme_state' => 'required',
                'eme_zip' => 'required',
                'eme_homephone' => 'required_without:eme_cellphone',
                'eme_cellphone' => 'required_without:eme_homephone',
                'alt_eme_relation' => 'required',
                'alt_eme_name' => 'required_unless:alt_eme_relation,==,0',
                'alt_eme_address1' => 'required_unless:alt_eme_relation,==,0',
                //'alt_eme_address2' => 'required_unless:alt_eme_relation,==,0',
                'alt_eme_city' => 'required_unless:alt_eme_relation,==,0|alpha_space',
                'alt_eme_state' => 'required_unless:alt_eme_relation,==,0',
                'alt_eme_zip' => 'required_unless:alt_eme_relation,==,0',
                'alt_eme_homephone' => 'required_unless:alt_eme_relation,==,0',
                //'alt_eme_cellphone' => 'required_unless:alt_eme_relation,==,0',
            ]);

            $participant->livealone  = $request->input('livealone');
            $participant->typeofresidence  = $request->input('typeofresidence');
            $participant->address1  = $request->input('address1');
            $participant->address2  = $request->input('address2');
            $participant->city  = $request->input('city');
            $participant->state  = $request->input('state');
            $participant->zip  = $request->input('zip');
            $participant->homephone  = $request->input('homephone');
            $participant->cellphone  = $request->input('cellphone');

            //$participant->sendtwocards  = $request->input('sendtwocards');
            $participant->eme_relation  = $request->input('eme_relation');
            $participant->eme_name  = $request->input('eme_name');
            $participant->eme_address1  = $request->input('eme_address1');
            $participant->eme_address2  = $request->input('eme_address2');
            $participant->eme_city  = $request->input('eme_city');
            $participant->eme_state  = $request->input('eme_state');
            $participant->eme_zip  = $request->input('eme_zip');
            $participant->eme_homephone  = $request->input('eme_homephone');
            $participant->eme_cellphone  = $request->input('eme_cellphone');

            $participant->alt_eme_relation  = $request->input('alt_eme_relation');
            $participant->alt_eme_name  = $request->input('alt_eme_name');
            $participant->alt_eme_address1  = $request->input('alt_eme_address1');
            $participant->alt_eme_address2  = $request->input('alt_eme_address2');
            $participant->alt_eme_city  = $request->input('alt_eme_city');
            $participant->alt_eme_state  = $request->input('alt_eme_state');
            $participant->alt_eme_zip  = $request->input('alt_eme_zip');
            $participant->alt_eme_homephone  = $request->input('alt_eme_homephone');
            $participant->alt_eme_cellphone  = $request->input('alt_eme_cellphone');
            if($participant->status < 3)
                $participant->status= 3;
            $participant->save(); 

            return redirect()->route('nav', ['participant' => $participant,]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    public function edit_three(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 2) {
            return view('applications.edit-three',[
                    'participant' => $participant,
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update_three(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 2) {
            $this->validate($request, [ 
                'wanders' => 'required',
                'possiblelocations' => 'max:50',
                'behaviorialhazards' => 'max:150',
                'otherinfo' => 'max:150',
                'primarylang' => 'alpha_space|max:50',
                'secondarylang' => 'alpha_space|max:50',
                'communicationmethod' => 'max:150',
            ]);

            $participant->wanders  = $request->input('wanders');
            $participant->possiblelocations  = $request->input('possiblelocations');
            $participant->behaviorialhazards  = $request->input('behaviorialhazards');
            $participant->otherinfo  = $request->input('otherinfo');
            $participant->primarylang  = $request->input('primarylang');
            $participant->secondarylang  = $request->input('secondarylang');
            $participant->communicationmethod  = $request->input('communicationmethod');
            if($participant->status < 4)
                $participant->status  = 4;
            $participant->save(); 
            return redirect()->route('nav', ['participant' => $participant,]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    public function edit_four(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 3) {
            return view('applications.edit-four',[
                    'participant' => $participant,
                    'disabilities' => $this->participants->forParticipant($participant)->disabilities, 
                    'alldisabilities' => $this->disabilities->getAllDisabilities(),
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update_four(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 3) {
            $this->validate($request, [ 
                //'physicianname1' => 'required',
                'physicianphone1' => 'required_with:physicianname1',
                //'physicianname2' => 'required',
                'physicianphone2' =>  'required_with:physicianname2',
                'disab' => 'required', //array??
                //'otherconditions' => 'required',
                'medication' => 'max:50',
                'medicalrequirements' => 'max:300',
                'medicaldevices' => 'max:300',
            ]);

            $participant->physicianname1  = $request->input('physicianname1');
            $participant->physicianphone1  = $request->input('physicianphone1');
            $participant->physicianname2  = $request->input('physicianname2');
            $participant->physicianphone2  = $request->input('physicianphone2');

            //$participant->disab  = $request->input('disab');
            $participant->otherconditions  = $request->input('otherconditions');
            $participant->medication  = $request->input('medication');
            $participant->medicalrequirements  = $request->input('medicalrequirements');
            $participant->medicaldevices  = $request->input('medicaldevices');
            if($participant->status < 5)
                $participant->status  = 5;
            $participant->save(); 

            if ($request->input('disab') == null)
                $participant->disabilities()->sync([]); 
            else
                $participant->disabilities()->sync($request->input('disab')); 

            return redirect()->route('nav', ['participant' => $participant,]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    public function edit_five(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 4) {
            return view('applications.edit-five',[
                    'participant' => $participant,
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update_five(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant) && $participant->status > 4) {
            $this->validate($request, [ 
                'digitalsig' => 'required',
                'authorize' => 'required',
            ]);

            $participant->digitalsig  = $request->input('digitalsig');
            //$application->authorize  = $request->input('authorize');

            //here do we check if all steps complete etc???
            $participant->status  = 0; //
            $participant->save(); 

            //do mail stuff here 
            $user = User::find($participant->user_id)->first();
            $data = [
                'user_fname' => $user->fname,
                'user_lname' => $user->lname,
                'user_email' => $user->email,
                'user_phone' => $user->phone,
                'fname' => $participant->fname,
                'middleinitial' => $participant->middleinitial,
                'lname' => $participant->lname,
                'id' => $participant->id,
                'eme_name' => $participant->eme_name,
                'eme_address1' => $participant->eme_address1,
                'eme_address2' => $participant->eme_address2,
                'eme_city' => $participant->eme_city,
                'eme_state' => $participant->eme_state,
                'eme_zip' => $participant->eme_zip,
            ];

            $job = (new SendParticipantEditAddEmail (Auth::user()->email, $participant, $data, 
                    'emails.participantadded', 'Participant Added Confirmation - '))->delay(30); 
            $this->dispatch($job); 

            return redirect('participants')->with('idPrompt', $participant->id);
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }




    protected function store(Request $request)
    {
        $this->validate($request, [ 
            'image' => 'required|mimes:jpg,jpeg,png|dimensions:min_width=250,min_height=250',
            'fname' => 'required|max:255',
            'middleinitial' => 'max:5',
            'lname' => 'required|max:255',
            'nickname' => 'max:50',
            'gender' => 'required',
            'month' => 'required',
            'day' => 'required',
            'year' => 'required',
        ]);

        $participant = new Participant;

        $participant->user_id = Auth::user()->id;
        $participant->fname = $request->input('fname');
        $participant->middleinitial = $request->input('middleinitial');
        $participant->lname = $request->input('lname');
        $participant->nickname = $request->input('nickname');
        $participant->birthdate = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
        $participant->gender = $request->input('gender');
        $participant->status = 1;
        $participant->save(); 

        $img_chk = false;
        if ( $request->hasFile('image') && $request->input('mailimage') == null  )
            $img_chk = true;
        $imagename = "";
        $imagepath = "";

        if ( $img_chk ) {
            $imagepath = 'participants/';
            $imagename = $participant->id.'.'.$request->file('image')->getClientOriginalExtension();
        }
        $participant->image_link = $imagepath.$imagename;
        $participant->save();

        if ( $img_chk ) 
            Storage::put(
                'participants/'.$participant->id.'.'.$request->file('image')->getClientOriginalExtension(),
                file_get_contents($request->file('image')->getRealPath())
            );

        return redirect('/applications/edit-one/'.$participant->id);
    }    
}
