<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomPermission as Permission;
use App\Models\CustomRole as Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission_name' => 'required|string|max:255',
            'permission_description' => 'nullable|string|max:500',
        ]);

            Permission::create([
                'permission_name' => $request->permission_name,
                'permission_description' => $request->permission_description
            ]);

            return redirect('permission')->with('status','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'permission_name' => 'required|string|max:255',
            'permission_description' => 'nullable|string|max:500',
            'permission_status' => 'required|integer|in:0,1',
        ]);

        $permission->update([
            'permission_name' => $request->permission_name,
            'permission_description' => $request->permission_description,
            'permission_status' => $request->permission_status
        ]);

            return redirect('permission')->with('status', 'Permission Updated Successfully');
        }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect('permission')->with('status', 'Permission Deleted Successfully');
    }
}
