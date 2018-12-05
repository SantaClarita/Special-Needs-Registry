<?php

namespace App\Http\Controllers\EmailListManagement;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Gate;
use Mail;
use DB;
use Storage;
use File;
use Log;

use App\User;
use App\Emaillist;
use App\Emaillistrecipients;
use App\Role;
use App\Repositories\UserRepository;
use App\Repositories\EmaillistRepository;
use App\Repositories\RoleRepository;
use App\Jobs\SendEmailListMail;

class EmailListController extends Controller
{
    public function __construct(UserRepository $users, EmaillistRepository $emaillists, RoleRepository $roles)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->emaillists = $emaillists;
        $this->roles = $roles;
    }

    public function index(Request $request)
    {
        if (policy(Emaillist::class)->manageEmailList(Auth::user())) {
        	return view('emaillists.index', [
        	  	'emaillists' => $this->emaillists->getEmaillistsWithRoleEmailRecipient(),
                'roles' => $this->roles->getAllRoles(),
                'useremails' => $this->users->getEmailList(),
        	]);
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    // public function create()
    // {
    //     if (policy(Emaillist::class)->manageEmailList(Auth::user())) {
    //         return view('emaillists.create', [
    //             'roles' => $this->roles->getAllRoles(),
    //             'useremails' => $this->users->getEmailList(),
    //         ]);
    //     }
    //     abort(401, 'You are not authorized to view or preform that action.');
    // }

    protected function store(Request $request)
    {
        if (policy(Emaillist::class)->manageEmailList(Auth::user())) {
            $this->validate($request, [ 
                'name' => 'required|unique:emaillists|max:255',
                'description' => 'required|max:255',
            ]);

            $emaillist = new Emaillist;
            $emaillist->name = $request->input('name');
            $emaillist->description = $request->input('description');
            $emaillist->save(); 

            $arr1 = $request->input('email');
            //filter out null/empties
            $arr1 = array_filter($arr1);

            //fill array with data
            $emails = array();
            $tmp = 0;
            foreach ($arr1 as $i) {
                if($i != "") {
                    $emails[$tmp] = array('email' => $i);
                    $tmp++;
                }
            }

            $arr2 = $request->input('registeredemails');
            if ($arr2 != null)
                $arr2 = array_filter($arr2);
            if ($request->input('registeredemails') != null) {
                foreach ($arr2 as $i) {
                    $emails[$tmp] = array('email' => $i);
                    $tmp++;
                }
            }

            $emaillist = Emaillist::find($emaillist->id);

            //save the emails using the array we generated
           
            if (isset($emails))
                $emaillist->useremails()->createMany($emails);

            $emaillist->roles()->attach($request->input('role'));

            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has created a new email list '.$emaillist->name);
            $request->session()->flash('status', 'Email List "'.$emaillist->name. '" was created successfully!');
            return redirect('/emaillists');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function edit(Request $request, Emaillist $emaillist)
    {
        if (policy(Emaillist::class)->manageEmailList(Auth::user())) {

            /*************************         
            This is my attempt to speed up selectpicker. Selectpicker is slow with large elements. I tried to do all the calculations
            before the HTML. This helped quite a bit. But no matter what there is a small delay due to selectpicker's implementations.
            ********************************/
            //are the selected emails
            $selectedemails = $this->emaillists->forEmaillist($emaillist)->useremails()->pluck('email');

            //Find individual emails
            $allregemails = User::pluck('email');
            $individualemails = $this->emaillists->forEmaillist($emaillist)->useremails()
                                                ->whereNotIn('email', $allregemails)
                                                ->pluck('email');

            //emails in emaillist but not in roles
            $getuseremailsforroles = $this->emaillists->getEmailsWithCurrentRoles($emaillist);
            $getalluseremails = User::whereNotIn('email', $getuseremailsforroles)->pluck('email');
            //combine all user emails minus role emails with individual emails
            $comb = $getalluseremails->merge($individualemails);

            //Now create an array for selectpicker to easily use to choose if email is selected or not
            $arr = array();
            $lastElementKey = count($selectedemails)-1;
            foreach ($comb as $i => $useremail) {
                foreach ($selectedemails as $j => $sel) {
                    if ($useremail == $sel) {
                        array_push($arr,  
                            [ 'email' => $useremail ,
                               'sel' => 1,
                             ] );
                        break;
                    }
                    if ($j == $lastElementKey)
                        array_push($arr,  
                            [ 'email' => $useremail ,
                               'sel' => 0,
                             ] );
                }
                if(count($selectedemails) == 0) //fix if selectedemails is empty
                    array_push($arr,  
                            [ 'email' => $useremail ,
                               'sel' => 0,
                             ] );
            }

            return view('emaillists.edit', [
                'emaillist' => $emaillist,
                'allroles' => $this->roles->getAllRoles(),
                'roles' => $this->emaillists->forEmaillist($emaillist)->roles,
                'alluseremails' => $arr,
                'useremails' => $this->emaillists->forEmaillist($emaillist)->useremails,
            ]);
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }
    
    protected function update(Request $request, Emaillist $emaillist)
    {
        if (policy(Emaillist::class)->manageEmailList(Auth::user())) {
            $this->validate($request, [ 
                'name' => 'required|max:255|unique:emaillists,name,'.$emaillist->id,
                'description' => 'required|max:255',
            ]);

            $emaillist = Emaillist::find($emaillist->id);
            $emaillist->name = $request->input('name');
            $emaillist->description = $request->input('description');
            $emaillist->save(); 

            $old_list = $emaillist->useremails()->pluck('email')->toArray();
            $new_registered_users = $request->input('registeredemails'); // input for new registered emails
            //dd($new_registered_users);
            $new_list = $request->input('email'); //input for current list
            $new_list = array_filter($new_list);
            //dd($new_list);
            //ensure none are null
            if ($new_registered_users == null)
                $new_registered_users = array();
            if ($new_list == null)
                $new_list = array();

            $newest_list = array_unique(array_merge($new_registered_users, $new_list));

            //calculate diffs delete what isnt there
            $remove_list = array_diff($old_list, $newest_list);
            Emaillistrecipients::whereIn('email', $remove_list)->delete();

            //get the new emails
            $old_list = $emaillist->useremails()->pluck('email')->toArray();
            $add_list = array_diff($newest_list, $old_list);

            $emails = array();
            if ($add_list != null)
                $add_list = array_filter($add_list);
            if ($add_list != null) {
                foreach ($add_list as $i => $curr) {
                    $emails[$i] = new Emaillistrecipients(array('email' => $curr));
                }
            }

            if (isset($emails))
                $emaillist->useremails()->saveMany($emails);


            if ($request->input('role') == null)
                $emaillist->roles()->sync([]); 
            else
                $emaillist->roles()->sync($request->input('role'));

            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has edited email list '.$emaillist->name);
            $request->session()->flash('status', 'Email list "'.$emaillist->name. '" was updated successfully!');
            return redirect('/emaillists');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }


    protected function delete(Request $request, Emaillist $emaillist)
    {
        if (policy(Emaillist::class)->manageEmailList(Auth::user())) {
            //clean up any data relating to emaillists
            $emaillist->roles()->detach();
            $emaillist->settings()->detach();
            $emaillist->useremails()->delete();
            $emaillist->delete();

            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has deleted email list '.$emaillist->name);
            $request->session()->flash('status', 'Email List "'.$emaillist->name. '" was deleted successfully!');
            return redirect('/emaillists');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }
}
