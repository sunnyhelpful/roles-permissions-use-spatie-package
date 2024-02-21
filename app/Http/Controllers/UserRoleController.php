<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:can-view-users', ['only' => ['index', 'show']]);
        $this->middleware('permission:can-create-users', ['only' => ['create', 'store']]);
        $this->middleware('permission:can-edit-users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:can-delete-users', ['only' => ['destroy']]);
    }
    
    public function userRole()
    {
        try {
            // $user = Auth::user();
            // $info = User::with('roles', 'permissions')->where('id', $user->id)->first();
            // \Log::info($info);
            $data = User::with('roles', 'permissions')->get();
            return view('user-roles.user-role', compact('data'));
        } catch (\Throwable $th) {
            \Log::error($th->getMessage().' '.$th->getFile().' '.$th->getLine());
        }
    }

    public function assignRole($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::all();
            $user_roles = $user->roles()->get();
            $user_roles = explode(',', (implode(',', $user_roles->pluck('name')->toArray())));

            return view('user-roles.assign-role', compact('user', 'roles', 'user_roles'))->with('index', 0);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeAssignedRole(Request $request, $id)
    {
        try {
            /* $validator = \validator(
                $request->all(),
                [
                    'roles' => 'required',
                ]
            );
    
            if ($validator->fails()) {
                return redirect()->back()->with('errors', ['please select atleat one role !']);
            } */
    
            $user = User::find($id);
            $role = Role::find($request->roles);
            $user->syncRoles($role);
            $permissions = $user->getPermissionsViaRoles();
    
            $user->syncpermissions($permissions);
    
            return redirect(route('getUserRole'))->with('message', 'Successfully, User Role Updated!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function giveAccess($id)
    {
        try {
            $user = User::find($id);
            $permissions = Permission::all();
            $user_permissions = $user->permissions()->get();
            $user_permissions = explode(',', (implode(',', $user_permissions->pluck('name')->toArray())));

            return view('user-roles.give-access', compact('user', 'permissions', 'user_permissions'))->with('index', 0);
        } catch (\Exception $e) {
            \Log::infio(''. $e->getMessage());
        }
    }

    public function storeGivenAccess(Request $request, $id)
    {
        try {
            /* $validator = \validator(
                $request->all(),
                [
                    'permissions' => 'required',
                ]
            );
    
            if ($validator->fails()) {
                return redirect()->back()->with('errors', ['please select atleat one permission !']);
            } */

            $user = User::find($id);
            $user->syncPermissions($request->permissions);
            return redirect(route('getUserRole'))->with('message', 'Successfully, User Access Updated!');
        } catch (\Throwable $th) {
            \Log::error($th->getMessage().' '.$th->getFile().' '.$th->getLine());
        }
    }

    public function revokeAccess($id)
    {
        try {
            $user = User::find($id);
            $user->revokePermissionTo($user->permissions()->get());
            $user->roles()->detach();

            return redirect(route('getUserRole'))->with('message', 'Successfully, User access Revoked!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
