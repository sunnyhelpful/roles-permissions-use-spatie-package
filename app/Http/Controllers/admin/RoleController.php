<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request){
        try {
            $roles =  Role::with('permissions')->get();
            return view('admin.role.index')->with(compact("roles"));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function create(Request $request){
        try {
            $permissions = Permission::all();
            return view('admin.role.create')->with(compact('permissions'));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function store(Request $request){
        try {
            $role = Role::create([
                'name' => $request->role,
            ]);
    
            $role->syncPermissions($request->permissions);
            return redirect()->route('getRole')->with('message', 'Successfully, Role created with permissions!');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            // \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
        }
    }

    public function edit($id){
        try {
            $role = Role::find($id);
            $permissions = Permission::all();
            $role_permissions = $role->permissions()->get();
            $role_permissions = $role_permissions->pluck('name')->toArray();
            
            return view('admin.role.edit', compact('role', 'permissions', 'role_permissions'))->with('index', 0);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try {
            $role = Role::find($id);
            $permissions = $role->permissions()->get();
            $role->revokePermissionTo($permissions);
            $role->name = $request->role;
            $role->update();

            $role->syncpermissions($request->permissions);

            return redirect()->route('getRole')->with('message', 'Successfully, Role updated successfully!');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function delete($id){
        try {
            $role = Role::find($id);
            $permissions = $role->permissions()->get();
            $role->revokePermissionTo($permissions);
            $role->delete();

            return redirect()->route('getRole')->with('message', 'Successfully, Role Deleted with access revoked!');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}

