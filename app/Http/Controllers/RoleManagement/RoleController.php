<?php

namespace App\Http\Controllers\RoleManagement;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Gate;
use Auth;
use Log;

use App\Role;
use App\Permission;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
	protected $roles, $permissions;

    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function index(Request $request)
    {
        if (policy(Role::class)->manageRolesList(Auth::user())) {
        	return view('roles.index', [ 
                'roles' => $this->roles->getRolesWithPermissions(), 
                'permissions' => $this->permissions->getAllPermissions(), 
            ]); 

        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function store(Request $request)
    {
        if (policy(Role::class)->manageRolesList(Auth::user())) {
            $this->validate($request, [ 
                'name' => 'required|unique:roles|max:255',
                'description' => 'required|max:255',
            ]);

            $role = new Role;
            $role->name = $request->input('name');
            $role->description = $request->input('description');
            $role->save(); 

            $role->permissions()->attach($request->input('perm')); 

            //logs
            $permissionname="";
            foreach ($role->permissions()->get() as $key => $value)
                $permissionname = $permissionname.Permission::find($value->id)->name.' ';
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has created a new role "'.$role->name.'" with permissions "'.$permissionname.'"');
            $request->session()->flash('status', 'Role "'.$role->name. '" was created successfully!');
            return redirect('/roles');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function edit(Request $request, Role $role)
    {
        if (policy(Role::class)->manageRolesList(Auth::user())) {
            return view('roles.edit', [ 
                'role' => $role,
                'permissions' => $this->roles->forRole($role)->permissions, 
                'allpermissions' => $this->permissions->getAllPermissions(), 
            ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function update(Request $request, Role $role)
    {
        if (policy(Role::class)->manageRolesList(Auth::user())) {
            $this->validate($request, [ 
                'name' => 'required|max:255|unique:roles,name,'.$role->id,
                'description' => 'required|max:255',
            ]);

            $role = Role::find($role->id);

            $oldpermissionname="";
            foreach ($role->permissions()->get() as $key => $value)
                $oldpermissionname = $oldpermissionname.Permission::find($value->id)->name.' ';

            if ($role->name == 'User') {
                $request->session()->flash('status', 'Role "'.$role->name. '" cannot be altered. Reason: Default role');
                return redirect('/roles');
            }
            $role->name = $request->input('name');
            $role->description = $request->input('description');
            if($role->isDirty())
                $role->save($role->getDirty());

            if ($request->input('perm') == null)
                $role->permissions()->sync([]); 
            else
                $role->permissions()->sync($request->input('perm')); 

            //logs
            $permissionname="";
            foreach ($role->permissions()->get() as $key => $value)
                $permissionname = $permissionname.Permission::find($value->id)->name.' ';
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has edited role "'.$role->name.'" with permissions "'.$oldpermissionname.'" to "'.$permissionname.'"');
            $request->session()->flash('status', 'Role "'.$role->name. '" was updated successfully!');
            return redirect('/roles');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    protected function delete(Request $request, Role $role)
    {
        if (policy(Role::class)->manageRolesList(Auth::user())) {
            //Prevent Deletion of Default Roles
            if ($role->name == 'Admin' || $role->name == 'User') {
                Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') attempted to delete role '.$role->name);
                $request->session()->flash('status', 'Role "'.$role->name. '" cannot be deleted as it is a default role.');
            }
            else {
                $role->permissions()->detach();
                $role->emaillists()->detach();
                $role->delete();

                Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has deleted role '.$role->name);
                $request->session()->flash('status', 'Role "'.$role->name. '" was deleted successfully!');
            }
            return redirect('/roles');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

}
