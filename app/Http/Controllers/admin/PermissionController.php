<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Request $request){
        try {
            $permissions =  Permission::all();
            return view('admin.permissions.index', compact('permissions'));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function create(Request $request){
        try {
            return view('admin.permissions.create');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function store(Request $request){
        try {
            /* $validator = \validator(
                $request->all(),
                [
                    'permission' => 'required',
                ]
            );
    
            if ($validator->fails()) {
                return redirect()->back()->with('errors', ['please enter the permission name !']);
            } */

            $permission = Permission::create([
                'name' => $request->permission,
            ]);
            
            return redirect()->route('getPermission')->with('message', 'Successfully, Permission Created!');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            // \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
        }
    }

    public function edit($id){
        try {
            $permission = Permission::find($id);
            return view('admin.permissions.edit', compact('permission'));
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            /* $validator = \validator(
                $request->all(),
                [
                    'permission' => 'required',
                ]
            );
    
            if ($validator->fails()) {
                return redirect()->back()->with('errors', ['please enter the permission name !']);
            } */
            $permission = Permission::find($id);
            $permission->update(['name' => $request->permission]);
    
            return redirect()->route('getPermission')->with('message', 'Successfully, Permission updated!');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    public function delete($id){
        try {
            $permission = Permission::find($id);
            $permission->delete();

            return redirect()->route('getPermission')->with('message', 'Successfully, Permission Deleted!');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
