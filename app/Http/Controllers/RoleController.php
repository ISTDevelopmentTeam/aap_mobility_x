<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\CustomPermission as Permission;
use App\Models\CustomRole as Role;

class RoleController extends Controller
{
    public function index()
    {
        // Get all roles with their organization
        $roles = Role::all();

        // // Load modules, submodules and permissions for each role
        // foreach ($roles as $role) {
        //     // Get modules assigned to this role
        //     $modules = $role->modules()->with('submodules')->get();

        //     // Get all permissions for this role grouped by submodule
        //     $rolePermissions = DB::table('role_has_submodule_permissions')
        //         ->where('role_id', $role->role_id)
        //         ->join('permissions', 'role_has_submodule_permissions.permission_id', '=', 'permissions.permission_id')
        //         ->select('role_has_submodule_permissions.*', 'permissions.permission_name')
        //         ->get();

        //     // Prepare the modules structure
        //     $preparedModules = [];

        //     foreach ($modules as $module) {
        //         $moduleData = [
        //             'module_id' => $module->module_id,
        //             'module_name' => $module->module_name,
        //             'submodules' => []
        //         ];

        //         foreach ($module->submodules as $submodule) {
        //             $submoduleData = [
        //                 'submodule_id' => $submodule->submodule_id,
        //                 'submodule_name' => $submodule->submodule_name,
        //                 'permissions' => []
        //             ];

        //             // Find permissions for this submodule
        //             foreach ($rolePermissions as $permission) {
        //                 if ($permission->submodule_id == $submodule->submodule_id) {
        //                     $submoduleData['permissions'][] = [
        //                         'permission_id' => $permission->permission_id,
        //                         'permission_name' => $permission->permission_name
        //                     ];
        //                 }
        //             }

        //             $moduleData['submodules'][] = $submoduleData;
        //         }

        //         $preparedModules[] = $moduleData;
        //     }

        //     // Add prepared modules to the role
        //     $role->prepared_modules = $preparedModules;
        // }

        // Get all permissions for reference
        $permissions = DB::table('permissions')->get();

        return view('role-permission.role.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $modules = Module::with('submodules')->get();
        $submodules = Submodule::get();
        $permissions = Permission::all();
        $organizations = Organization::all();

        return view('role-permission.role.create', compact('modules', 'permissions', 'organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
            'org_id' => 'required|exists:organizations,org_id',
            'module_id' => 'required|array',
            'module_id.*' => 'exists:modules,module_id',
            'submodule_id' => 'required|array',
            'submodule_id.*' => 'exists:submodules,submodule_id',
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,permission_id',
        ]);

        // Create the role with organization
        $role = Role::create([
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
            'org_id' => $request->org_id,
        ]);


        // ✅ Assign modules to a role
        $role->modules()->sync($request->module_id);

        // ✅ Assign submodule with multiple permissions in a role
        if (is_array($request->permission_id)) {
            foreach ($request->submodule_id as $submoduleId) {
                // Get unique permissions for this submodule
                $permissions = $request->permission_id[$submoduleId] ?? [];

                // Avoid duplicates by using sync or checking for existing records
                foreach (array_unique($permissions) as $permissionId) {
                    // Insert only if the record doesn't already exist
                    DB::table('role_has_submodule_permissions')->updateOrInsert(
                        [
                            'role_id' => $role->role_id,
                            'submodule_id' => $submoduleId,
                            'permission_id' => $permissionId
                        ],
                        [
                            'role_id' => $role->role_id,
                            'submodule_id' => $submoduleId,
                            'permission_id' => $permissionId
                        ]
                    );
                }
            }
        }

        return redirect('role')->with('status', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $modules = Module::all();
        $submodules = Submodule::get();
        $permissions = Permission::all();
        $organizations = Organization::all();


        $selected_role = Role::find($role->role_id);

        // if ($selected_role){
        //     // Get modules assigned to this role
        //     $modules = $selected_role->modules()->with('submodules')->get();

        //     // Get all permissions for this role grouped by submodule
        //     $rolePermissions = DB::table('role_has_submodule_permissions')
        //         ->where('role_id', $selected_role->role_id)
        //         ->join('permissions', 'role_has_submodule_permissions.permission_id', '=', 'permissions.permission_id')
        //         ->select('role_has_submodule_permissions.*', 'permissions.permission_name')
        //         ->get();

        //     // Prepare the modules structure
        //     $preparedModules = [];

        //     foreach ($modules as $module) {
        //         $moduleData = [
        //             'module_id' => $module->module_id,
        //             'module_name' => $module->module_name,
        //             'submodules' => []
        //         ];


        //         foreach ($module->submodules as $submodule) {
        //             $submoduleData = [
        //                 'submodule_id' => $submodule->submodule_id,
        //                 'submodule_name' => $submodule->submodule_name,
        //                 'permissions' => []
        //             ];

        //             // Find permissions for this submodule
        //             foreach ($rolePermissions as $permission) {
        //                 if ($permission->submodule_id == $submodule->submodule_id) {
        //                     $submoduleData['permissions'][] = [
        //                         'permission_id' => $permission->permission_id,
        //                         'permission_name' => $permission->permission_name
        //                     ];
        //                 }
        //             }

        //             $moduleData['submodules'][] = $submoduleData;
        //         }

        //         $preparedModules[] = $moduleData;
        //     }

        //     // Add prepared modules to the role
        //     $selected_role->prepared_modules = $preparedModules;

        // }

        return view('role-permission.role.edit', compact('role', 'selected_role', 'permissions', 'modules', 'organizations' ));

    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
            'org_id' => 'required|exists:organizations,org_id',
            'module_id' => 'required|array',
            'module_id.*' => 'exists:modules,module_id',
            'submodule_id' => 'required|array',
            'submodule_id.*' => 'exists:submodules,submodule_id',
            'permission_id' => 'nullable|array', // Allow nullable because some permissions might be deselected
            'permission_id.*' => 'exists:permissions,permission_id',
            'role_status' => 'required|integer|in:0,1',
        ]);

        // ✅ Assign modules to a role
        $role->modules()->sync($request->module_id);

        // ✅ Assign organization to a role (belongs-to)
        $role->update([
            'org_id' => $request->org_id,
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
            'role_status' => $request->role_status,
        ]);

        // DB::table('role_has_submodule_permissions')
        //     ->where('role_id', $role->role_id)
        //     ->whereIn('submodule_id', $request->submodule_id)
        //     ->delete();
        DB::table('role_has_submodule_permissions')
        ->where('role_id', $role->role_id)
        ->delete();

        // ✅ Assign new permissions
        if (is_array($request->permission_id)) {
            foreach ($request->submodule_id as $submoduleId) {
                $permissions = $request->permission_id[$submoduleId] ?? [];

                foreach (array_unique($permissions) as $permissionId) {
                    DB::table('role_has_submodule_permissions')->insert([
                        'role_id' => $role->role_id,
                        'submodule_id' => $submoduleId,
                        'permission_id' => (int) $permissionId,
                    ]);
                }
            }
        }

        return redirect('role')->with('status', 'Role Updated Successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('role')->with('status', 'Role Deleted Successfully');
    }

    // public function addPermissionToRole($roleId)
    // {
    //     $permissions = Permission::get();
    //     $role = Role::findorFail($roleId);
    //     $rolePermissions = DB::table('role_has_permissions')
    //                     ->where('role_has_permissions.role_id',$role->id)
    //                     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //                     ->all();
    //     return view('role-permission.role.add-permissions',[
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'rolePermissions' => $rolePermissions
    //     ]);
    // }

    // public function givePermissionToRole(Request $request, $roleId)
    // {
    //     $request->validate([
    //         'permission' => 'required'
    //     ]);

    //     $role = Role::findOrFail($roleId);
    //     $role->syncPermissions($request->permission);

    //     return redirect()->back()->with('status','Permissions added to role');
    // }

    // public function addRoleWithPermissions()
    // {
    //     $permissions = Permission::get();
    //     return view('role-permission.role.add-role-with-permissions',[
    //         'permissions' => $permissions
    //     ]);
    // }

    // public function saveRoleWithPermissions(Request $request)
    // {
    //     $request->validate([
    //         'name' => [
    //             'required',
    //             'string',
    //             'unique:permissions,name'
    //         ],
    //         'permission' => 'required'
    //     ]);

    //     $role = Role::create([
    //         'name' => $request->name
    //     ]);

    //     $role->syncPermissions($request->permission);


    //     return redirect('role')->with('status','Role Created Successfully');
    // }

    // public function updateRoleWithPermissions($roleId)
    // {
    //     $role = Role::findorFail($roleId);
    //     $permissions = Permission::get();
    //     $rolePermissions = DB::table('role_has_permissions')
    //                     ->where('role_has_permissions.role_id',$role->id)
    //                     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //                     ->all();
    //     return view('role-permission.role.edit-role-with-permissions',[
    //         'role' => $role,
    //         'permissions' => $permissions,
    //         'rolePermissions' => $rolePermissions
    //     ]);

    // }

    // public function editRoleWithPermissions (Request $request, $roleId)
    // {
    //     $role = Role::findorFail($roleId);

    //     $request->validate([
    //         'name' => [
    //             'required',
    //             'string',
    //             'unique:roles,name,'.$role->id
    //         ],
    //         'permission' => 'required'
    //     ]);

    //     $role->update([
    //         'name' => $request->name
    //     ]);

    //     $role->refresh();
    //     $role = Role::findOrFail($role->id);
    //     $role->syncPermissions($request->permission);


    //     return redirect('role')->with('status', 'Role Updated Successfully');
    // }
}
