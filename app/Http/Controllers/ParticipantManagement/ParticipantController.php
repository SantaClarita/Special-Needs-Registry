<?php

namespace App\Http\Controllers\ParticipantManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Gate;
use PDF;
use Storage;
use Mail;
use Carbon;
use Redirect;
use Log;

use App\User;
use App\Job;

use App\Http\Requests;
use App\Participant;
use App\ParticipantEthnicity;
use App\Repositories\DisabilityRepository;
use App\Repositories\ParticipantRepository;
use App\Repositories\ApplicationRepository;
use App\Repositories\SettingRepository;
use App\Jobs\SendParticipantEditAddEmail;
use App\Jobs\SendFlyerEmail;

class ParticipantController extends Controller
{
    protected $disabilities, $participants;

    public function __construct(DisabilityRepository $disabilities, ParticipantRepository $participants, SettingRepository $settings)
    {
        $this->middleware('auth');
        $this->disabilities = $disabilities;
        $this->participants = $participants;
        $this->settings = $settings;
    }

    public function index(Request $request)
    {
        return view('participants.index', [ 
            'participants' => $this->participants->forUserCompleted($request->user()), 
            'applications' => $this->participants->forUserIncomplete($request->user()), 
        ]); 
    }

    public function create()
    {
        return view('participants.create', [ 
            'disabilities' => $this->disabilities->getAllDisabilities(),
        ]); 
    }

    public function edit(Request $request, Participant $participant)
    {   
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            return view('participants.edit', [ 
                'participant' => Participant::with('user')->find($participant->id), 
                'disabilities' => $this->participants->forParticipant($participant)->disabilities, 
                'alldisabilities' => $this->disabilities->getAllDisabilities(),
                'users' => User::orderBy('lname')->orderBy('fname')->get(), //list of users for transfer ownership
                'user' => User::find($participant->user_id), //to prevent error when owner is empty (owner was deleted)
            ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.'); 
    }

    protected function update(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            $this->validate($request, [ 
                'fname' => 'required|max:255',
                'middleinitial' => 'max:5',
                'lname' => 'required|max:255',
                'nickname' => 'max:50',
                'gender' => 'required',
                'month' => 'required',
                'day' => 'required',
                'year' => 'required',
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
                //'alt_eme_cellphone' => 'required_unless:alt_eme_relation,==,0|phone',
                'wanders' => 'required',
                'possiblelocations' => 'max:50',
                'behaviorialhazards' => 'max:150',
                'otherinfo' => 'max:150',
                'primarylang' => 'alpha_space|max:50',
                'secondarylang' => 'alpha_space|max:50',
                'communicationmethod' => 'max:150',
                //'physicianname1' => 'required',
                'physicianphone1' => 'required_with:physicianname1',
                //'physicianname2' => 'required',
                'physicianphone2' =>  'required_with:physicianname2',
                'disab' => 'required',
                //'otherconditions' => 'required',
                'medication' => 'max:50',
                'medicalrequirements' => 'max:300',
                'medicaldevices' => 'max:300',
                'digitalsig' => 'required',
                'authorize' => 'required',

            ]); 
    
            //must check if image is provided to prevent getclientoriginalextension error on empty
            $img_chk = false;
            if ( $request->hasFile('image') )
                $img_chk = true;
            $imagename = "";
            $imagepath = "";

            if ( $img_chk ) {
                $imagepath = 'participants/';
                $imagename = $participant->id.'.'.$request->file('image')->getClientOriginalExtension();
            }

            $participant = Participant::find($participant->id);

            //Prevent basic user from modifying this change but only check permissions if there was a change or 
            //else abort would be thrown everytime
            if ($request->input('user') != null)
                if (policy(Participant::class)->manageParticipantListAboveOwner(Auth::user(), $participant))
                    $participant->user_id = $request->input('user');
                else
                    abort(401, 'You are not authorized to view or preform that action. Specifically, changing the ownership of the participant.'); 


            $participant->fname = $request->input('fname');
            $participant->middleinitial = $request->input('middleinitial');
            $participant->lname = $request->input('lname');
            $participant->nickname = $request->input('nickname');
            $participant->birthdate = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $participant->gender = $request->input('gender');

            if ( $img_chk ) 
                $participant->image_link = $imagepath.$imagename;

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

            //if relation none is chosen then fill none for those fields
            if ($request->input('alt_eme_relation') == '0') {
                $participant->alt_eme_relation  = '0';
                $participant->alt_eme_name  = '';
                $participant->alt_eme_address1  = '';
                $participant->alt_eme_address2  = '';
                $participant->alt_eme_city  = '';
                $participant->alt_eme_state  = '';
                $participant->alt_eme_zip  = '';
                $participant->alt_eme_homephone  = '';
                $participant->alt_eme_cellphone  = '';
            }
            else {
                $participant->alt_eme_relation  = $request->input('alt_eme_relation');
                $participant->alt_eme_name  = $request->input('alt_eme_name');
                $participant->alt_eme_address1  = $request->input('alt_eme_address1');
                $participant->alt_eme_address2  = $request->input('alt_eme_address2');
                $participant->alt_eme_city  = $request->input('alt_eme_city');
                $participant->alt_eme_state  = $request->input('alt_eme_state');
                $participant->alt_eme_zip  = $request->input('alt_eme_zip');
                $participant->alt_eme_homephone  = $request->input('alt_eme_homephone');
                $participant->alt_eme_cellphone  = $request->input('alt_eme_cellphone');
            }

            $participant->wanders  = $request->input('wanders');
            $participant->possiblelocations  = $request->input('possiblelocations');
            $participant->behaviorialhazards  = $request->input('behaviorialhazards');
            $participant->otherinfo  = $request->input('otherinfo');
            $participant->primarylang  = $request->input('primarylang');
            $participant->secondarylang  = $request->input('secondarylang');
            $participant->communicationmethod  = $request->input('communicationmethod');

            $participant->physicianname1  = $request->input('physicianname1');
            $participant->physicianphone1  = $request->input('physicianphone1');
            $participant->physicianname2  = $request->input('physicianname2');
            $participant->physicianphone2  = $request->input('physicianphone2');

            //$participant->disab  = $request->input('disab');
            $participant->otherconditions  = $request->input('otherconditions');
            $participant->medication  = $request->input('medication');
            $participant->medicalrequirements  = $request->input('medicalrequirements');
            $participant->medicaldevices  = $request->input('medicaldevices');

            $participant->digitalsig  = $request->input('digitalsig');
            //$participant->authorize  = $request->input('authorize');

            if($participant->isDirty())
                $participant->save($participant->getDirty());

            if ($request->input('disab') == null)
                $participant->disabilities()->sync([]); 
            else
                $participant->disabilities()->sync($request->input('disab')); 

            if ( $img_chk ) {
                Storage::put(
                    'participants/'.$participant->id.'.'.$request->file('image')->getClientOriginalExtension(),
                    file_get_contents($request->file('image')->getRealPath())
                );
            }

            $user = User::find($participant->user_id);
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has edited participant "'.$participant->fname.' '.$participant->lname.'"');
            $request->session()->flash('status', 'Participant "'.$participant->fname.' '.$participant->lname.'" was updated successfully!');
            return redirect('/participants/profile/'.$participant->id);
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function showProfile(Request $request, Participant $participant) {
        if (policy(Participant::class)->viewParticipantProfile(Auth::user(), $participant)) {
            return view('participants.showProfile', [ 
                    'participant' => Participant::with('user')->find($participant->id),
                    'disabilities' => $this->participants->forParticipant($participant)->disabilities, 
                    'user' => User::find($participant->user_id),
                ]);
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }


    //Would have to manually create a PDF template from scratch rather than a PDF library generation 
    // // Was unable to generate PDF from profile. Profile page is too big for a PDF generation
    // protected function showProfilePDF(Request $request, Participant $participant) {
    //     if (policy(Participant::class)->viewParticipantProfile(Auth::user(), $participant)) {
    //             $data = array(
    //                         'participant' => $participant, 
    //                         'disabilities' => $this->participants->forParticipant($participant)->disabilities,);
    //             $pdf = PDF::loadView('participants.showProfilePDF', $data);
    //             return $pdf->download('profile.pdf');
    //     }
    //     abort(401, 'You are not authorized to view or preform that action.');
    // }

    protected function showFlyer(Request $request, Participant $participant) {
        if (policy(Participant::class)->viewParticipantFlyer(Auth::user(), $participant)) {
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has viewed a flyer for participant "'.$participant->fname.' '.$participant->lname.'"');
            return view('participants.showFlyer', [ 
                    'participant' => $participant,
                ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function showFlyerPDF(Request $request, Participant $participant) {
        if (policy(Participant::class)->viewParticipantFlyer(Auth::user(), $participant)) {
            $data = array('participant'=> $participant);
            $pdf = PDF::loadView('participants.showFlyerPDF', $data);
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has generated a Flyer PDF for viewing participant "'.$participant->fname.' '.$participant->lname.'"');
            return $pdf->stream($participant->fname.'-'.$participant->lname.'.pdf');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function emailFlyerPDF(Request $request, Participant $participant) {
        if (policy(Participant::class)->emailParticipantFlyer(Auth::user(), $participant)) {
            //logs
            Log::warning(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has sent a mass flyer email for "'.$participant->fname.' '.$participant->lname.'"');
            
            $user = User::find($participant->user_id);
            //to prevent error when a participant has no owner (owner was deleted)
            if (count($user) > 0){
                $data = [
                    'user_fname' => $user->fname,
                    'user_lname' => $user->lname,
                    'user_email' => $user->email,
                    'user_phone' => $user->phone,
                    'fname' => $participant->fname,
                    'middleinitial' => $participant->middleinitial,
                    'lname' => $participant->lname,
                    'id' => $participant->id,
                ];
            }
            else {
                $data = [
                    'user_fname' => 'None: Not Found',
                    'user_lname' => '',
                    'user_email' => 'None: Not Found',
                    'user_phone' => 'None: Not Found',
                    'fname' => $participant->fname,
                    'middleinitial' => $participant->middleinitial,
                    'lname' => $participant->lname,
                    'id' => $participant->id,
                ];
            }

            //get email lists
            $email_list_arr = array();
            $email_list_arr = $this->settings->getEmailsWithSettingID(3);

            //generate flyer pdf
            $pdfdata = array('participant'=> $participant);
            $pdf = PDF::loadView('participants.showFlyerPDF', $pdfdata);

            $filename = $participant->fname.'-'.$participant->middleinitial.'-'.$participant->lname.'.pdf';
            $filepath = 'temp/'.$filename;
            Storage::put($filepath, $pdf->stream());

            $attachmentData = [
                    'filepath' => $filepath,
                    'filename' => $filename,
                ];

            $subject = 'Missing Person Flyer - '.$participant->fname.' '.$participant->middleinitial.' '.$participant->lname;
            $body = "";
            $job = (new SendFlyerEmail ($email_list_arr, $subject, $data, $attachmentData, 'emails.flyer'))->delay(60); 
            $job = $this->dispatch($job);

            $request->session()->flash('data',['status' => "Your flyer email was sent!", 
                                        'jobid' => $job]);
            return redirect()->back(); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    //This only works if the queue driver is properly set up
    protected function undoemailFlyerPDF(Request $request, Participant $participant, $id) {
        if (policy(Participant::class)->emailParticipantFlyer(Auth::user(), $participant)) {
            $job = Job::find($id);
            if ($job) {
                if ($job->delete()) 
                    $request->session()->flash('data',['status' => "Your flyer email that was sent was reverted."]);  
            }
            else {
                $request->session()->flash('data',['status' => "Your flyer email was already sent or you tried deleting it more than once."]); 
            }
            return view('participants.showFlyer', [ 
                    'participant' => $participant,
                ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function showID(Request $request, Participant $participant) {
        if (policy(Participant::class)->viewParticipantIDs(Auth::user(), $participant)) {
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has viewed ID for participant "'.$participant->fname.' '.$participant->lname.'"');
            return view('participants.showID', [ 
                    'participant' => $participant,
                ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function delete(Request $request, Participant $participant)
    {
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            $name = $participant->fname.' '.$participant->middleinitial.' '.$participant->lname; 
            if ($participant->status != 0) {
                $participant->disabilities()->detach();
                $participant->forceDelete();
                Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has deleted participant "'.$name.'"');
                $request->session()->flash('status', 'Application for '.$name.' was deleted successfully!');
                return redirect('participants');
            }
            else {
                $participant->delete();
                //if admin deletes and restored and the disability was "detached". It is removed completely.
                //By commenting the below statement, the relationship stays
                //$participant->disabilities()->detach();
                Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has deleted participant "'.$name.'"');
                $request->session()->flash('status', $name.' was deleted successfully!');
                return Redirect::back();
            }
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function restore(Request $request, $id)
    {
        $participant = Participant::onlyTrashed()->find($id);
        if (policy(Participant::class)->manageParticipantList(Auth::user(), $participant)) {
            $name = $participant->fname.' '.$participant->middleinitial.' '.$participant->lname;
            $participant->restore();
            //Cannot restore many to many without a custom function/trait
            //$participant->disabilities()->restore();
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has restored participant "'.$name.'"');
            $request->session()->flash('status', $name.' was restored successfully!');
            return redirect('participants/search');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function search(Request $request) {
        if (policy(Participant::class)->CanSearchparticipants(Auth::user())) {
            $request->flashOnly('search', 'searchdeleted', 'age_start', 'age_end', 'gender');
            return view('participants.search', [ 
                    'participants' => $this->participants->search($request),
                    'tmp' => Participant::first(),
                ]); 
            
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

}
