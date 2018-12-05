<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gate;
use Mail;
use Auth;
use Log;
use Hash;

use App\User;
use App\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

use App\Jobs\NewUserEmail;


class UserController extends Controller
{
	protected $roles, $permissions;

    public function __construct(RoleRepository $roles, UserRepository $users)
    {
        $this->middleware('auth');
        $this->roles = $roles;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        if (policy(User::class)->manageUserList(Auth::user())) {
        	return view('users.index', [ 
                'users' => User::with('roles')->paginate(50), 
                'roles' => Role::all(), 
            ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function store(Request $request)
    {
        if (policy(User::class)->manageUserList(Auth::user())) {
            $this->validate($request, [ 
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'phone' => 'required|phone',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = new User;
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');

            $user->stopReminderEmails = 0;
            $user->password = bcrypt($request->input('password'));
            $user->save(); 

            $user->roles()->attach($request->input('role')); 
            //attach user role if none?
            if($request->input('role') == null)
                $user->roles()->attach(1); //attach user role

            //logs
            $rolename="";
            foreach ($user->roles()->get() as $key => $value)
                $rolename = $rolename.Role::find($value->id)->name.' ';
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has created a new user "'.$user->fname.' '.$user->lname.' ('.$user->email.')" manually with roles: '.$rolename);

            //mail the webmaster
            //mail the user who got created but dont email password
            $data = [
                    'user_fname' => $user->fname,
                    'user_lname' => $user->lname,
                    'user_email' => $user->email,
                    'user_phone' => $user->phone,
                ];

            $subject = 'An admin has created a user account for you';
            $email = $user->email;
            $job = (new NewUserEmail ($email, $data, $subject, 'emails.manualusercreated'))->delay(30); 
            $this->dispatch($job);

            $request->session()->flash('status', 'User email "'.$user->email.'" was created successfully!');
            return redirect('/users');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function edit(Request $request, User $user)
    {
        if (policy(User::class)->manageUserList(Auth::user())) {
            return view('users.edit', [ 
                'user' => $user,
                'roles' => $this->users->forUser($user)->roles, 
                'allroles' => $this->roles->getAllRoles(), 
            ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function editPersonalInfo()
    {
        $user = Auth::user();
        return view('users.editPersonalInfo', [ 
            'user' => $user,
        ]); 

    }

    protected function update(Request $request, User $user)
    {
        if (policy(User::class)->manageUserList(Auth::user())) {
            $this->validate($request, [ 
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                //'phone' => 'required',
                'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            ]);

            $user = User::find($user->id);

            $oldrolename="";
            foreach ($user->roles()->get() as $key => $value)
                $oldrolename = $oldrolename.Role::find($value->id)->name.' ';

            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            if($user->isDirty()) //phone is always changed due to mutator need fix
                $user->save($user->getDirty());

            if ($request->input('role') == null)
            	$user->roles()->sync([]); 
            else
            	$user->roles()->sync($request->input('role')); 

            //logs
            $rolename="";
            foreach ($user->roles()->get() as $key => $value)
                $rolename = $rolename.Role::find($value->id)->name.' ';
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has edited user "'.$user->fname.' '.$user->lname.' ('.$user->email.')" with roles from: '.$oldrolename.' to '.$rolename);


            $request->session()->flash('status', 'User email "'.$user->email.'" was updated successfully!');
            return redirect('/users');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function updatePersonalInfo(Request $request)
    {
        $user = Auth::user();
        $old_fname = Auth::user()->fname;
        $old_lname = Auth::user()->lname;
        $old_phone = Auth::user()->phone;
        $old_email = Auth::user()->email;
        $this->validate($request, [ 
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            //'phone' => 'required|phone:',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'required_with:password-confirm|min:6|confirmed',

        ]);
        $user = User::find($user->id);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->stopReminderEmails = $request->input('reminderEmail');
        //if password is filled
        if ($request->input('password') != null) {
            if (Hash::check($request->input('old-password'), $user->password)) {
                $user->password = Hash::make($request->input('password'));
            }
            else {
                $request->session()->flash('status', 'Your password was wrong!');
                return redirect('/');
            }
        }
        
        if($user->isDirty()) {
            $user->save($user->getDirty());
            $request->session()->flash('status', 'Your personal information was updated successfully!');
        }
        return redirect('/');
    }


    protected function delete(Request $request, User $user)
    {
        if (policy(User::class)->manageUserList(Auth::user())) {
            $user->delete();
            $user->roles()->detach();
            //we must delete dependents here too? //???

            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has delete user "'.$user->fname.' '.$user->lname.' ('.$user->email.')"');
            $request->session()->flash('status', 'User email "'.$user->email.'" was deleted successfully!');
            return redirect('/users');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function restore(Request $request, $id)
    {
        $user = User::onlyTrashed()->find($id);
        if (policy(User::class)->manageUserList(Auth::user())) {
            $name = $user->fname.' '.$user->lname;
            $user->restore();
            $user->roles()->attach(1);
            //Cannot restore many to many without a custom function/trait
            //$participant->disabilities()->restore();
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has restored user "'.$user->fname.' '.$user->lname.' ('.$user->email.')"');
            $request->session()->flash('status', $name.' was restored successfully!');
            return redirect()->back();
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function search(Request $request) {
        if (policy(User::class)->manageUserList(Auth::user())) {
            $request->flashOnly('search', 'searchdeleted', 'search_user');
            if ($request->input('searchdeleted') == 1) {
                return view('users.index', [ 
                        'users' => $this->users->searchWithDeleted($request->input('search_user')),
                        'roles' => Role::all(), 
                    ]);  
            }
            else
                return view('users.index', [ 
                        'users' => $this->users->search($request->input('search_user')),
                        'roles' => Role::all(), 
                    ]);  
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    

}
