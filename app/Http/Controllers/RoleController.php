<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\CustomPermission as Permission;
use App\Models\CustomRole as Role;
use App\Enums\PermissionType;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        // Get all roles with their organization
        $roles = Role::all();

        // Get all permissions for reference
        $permissions = DB::table('permissions')->get();

        return view('role-permission.role.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $modules = Module::all();
        $organizations = Organization::all();

        return view('role-permission.role.create', compact('modules','organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
            'org_id' => 'required|exists:organizations,org_id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,permission_id',
            'role_status' => 'required|integer|in:0,1',
        ]);

        $role = Role::create([
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
            'org_id' => $request->org_id,
            'role_status' => $request->role_status,
        ]);

        if(!empty($request->permissions)){
            $permissions = array_map('intval', $request->permissions);
            $role->syncPermissions($permissions);
        }

        return redirect('role')->with('status', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $modules = Module::all();
        $organizations = Organization::all();
        $selected_role = Role::find($role->role_id);

        return view('role-permission.role.edit', compact('role', 'modules', 'organizations' ));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
            'org_id' => 'required|exists:organizations,org_id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,permission_id',
            'role_status' => 'required|integer|in:0,1',
        ]);

        $role->update([
            'org_id' => $request->org_id,
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
            'role_status' => $request->role_status,
        ]);

        if(!empty($request->permissions)){
            $permissions = array_map('intval', $request->permissions);
            $role->syncPermissions($permissions);
        }
        
        return redirect('role')->with('status', 'Role Updated Successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('role')->with('status', 'Role Deleted Successfully');
    }
}
