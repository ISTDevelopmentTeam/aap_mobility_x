<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\Action;
use App\Models\CustomPermission as Permission;
use App\Models\CustomRole as Role;
use App\Enums\PermissionType;
use App\Enums\ActionType;

class ModuleAndSubmoduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Initiated by: romu-dev
     * Contains the modules and submodules
     * Note: Ensure that the SuperAdminSeeder has been executed
     * to create the superadmin role before running this seeder.
     *
     * List of Modules Included:
     * 1. Dashboard
     * 2. RBAC Management
     * 3. Employee Management
     * 4. CRM
     * 5. Asset Management
     * 6. CMS
     * 7.
     */
    public function run(): void
    {
        /**
         * Define your modules and submodules here
         * Update this if new modules and submodules will be deployed
         *
         * If new modules and submodules will be created, append to this array
         * with this template:
         *
         * [
         *      'name' =>  {moduleName},
         *      'description' => {moduleDescription},
         *      'submodules' => [
         *          ['name' =>  {submoduleName1}, 'description' => {submoduleDescription1} ],
         *          ['name' =>  {submoduleName2}, 'description' => {submoduleDescription2} ],
         *          (add submodules as needed)
         *      ],
         * ]
         *
         * Replace fields enclosed in curly braces {} with their corresponding values.
         */
        $modules = [
            [
                'name' => 'Dashboard',
                'description' => 'Main dashboard module',
                'submodules' => [
                    ['name' => 'User Analytics', 'description' => 'View user analytics' ],
                ],
            ],
            [
                'name' => 'RBAC Management',
                'description' => 'Manage roles, permissions, and user access',
                'submodules' => [

                ],
            ],
            [
                'name' => 'Employee Management',
                'description' => 'Manage employee profiles and records',
                'submodules' => [
                    ['name' => 'Alphalist', 'description' => 'Alphalist'],
                    ['name' => 'Manpower Requisition', 'description' => 'Manpower Requisition'],
                    ['name' => 'Vacancy List', 'description' => 'Vacancy List'],
                ],
            ],
            [
                'name' => 'CRM',
                'description' => 'Manage interactions with leads, customers, and partners',
                'submodules' => [
                    ['name' => 'Dashboard', 'description' => 'Dashboard'],
                    ['name' => 'Members', 'description' => 'Members'],
                    ['name' => 'Email Marketing', 'description' => 'Email Marketing'],
                    ['name' => 'Corporate', 'description' => 'Corporate'],
                    ['name' => 'Sales Tracking', 'description' => 'Sales Tracking'],
                ],
            ],
            [
                'name' => 'Asset Management',
                'description' => 'Tracks the lifecycle, status, and location of physical and digital assets',
                'submodules' => [
                    ['name' => 'Dashboard', 'description' => 'Dashboard'],
                    ['name' => 'Assets', 'description' => 'Assets'],
                    ['name' => 'Scan QR', 'description' => 'Scan QR'],
                ],
            ],
            [
                'name' => 'CMS',
                'description' => 'Create, manage, and publish contents for the system',
                'submodules' => [

                ],
            ],
        ];

        // Checkpoint: End of Module Array

        $allPermissionNames = [];

        foreach ($modules as $mod) {
            // Create or update module
            $module = Module::updateOrCreate(
                ['module_name' => $mod['name']],
                [
                    'module_description' => $mod['description'],
                    'module_status' => 1,
                    'module_created' => now(),
                    'module_updated' => now(),
                ]
            );

            // Create a permission for the module itself
            $modulePermissionName = 'access ' . strtolower(str_replace(' ', '_', $mod['name']));

            $permission = Permission::updateOrCreate(
                ['permission_name' => $modulePermissionName,  'permission_type' => PermissionType::MODULE, 'permission_guard_name' => 'web'],
                [
                    'module_id' => $module->module_id,
                    'permission_description' => 'Can access module: ' . $mod['name'],
                    'permission_status' => 1,
                    'permission_date_created' => now(),
                    'permission_date_updated' => now(),
                ],
            );

            $allPermissionNames[] = $permission->name;

            foreach ($mod['submodules'] as $sub) {
                // Create or update submodule
                $submodule = Submodule::updateOrCreate(
                    ['submodule_name' => $sub['name'], 'module_id' => $module->module_id],
                    [
                        'submodule_description' => $sub['description'],
                        'module_id' => $module->module_id,
                        'submodule_status' => 1,
                        'submodule_created' => now(),
                        'submodule_updated' => now(),
                    ]
                );

                // Create a permission for each submodule
                $subPermissionName = 'access ' . strtolower(str_replace(' ', '_', $sub['name'])) . ' of ' . strtolower(str_replace(' ', '_', $mod['name']));
                $permission = Permission::updateOrCreate(
                    ['name' => $subPermissionName, 'permission_type' => PermissionType::SUBMODULE, 'permission_guard_name' => 'web'],
                    [
                        'module_id' => $module->module_id,
                        'submodule_id' => $submodule->submodule_id,
                        'permission_description' => 'Can access submodule: ' . $sub['name'],
                        'permission_status' => 1,
                        'permission_date_created' => now(),
                        'permission_date_updated' => now(),
                    ],
                );
                $allPermissionNames[] = $permission->name;

                foreach(ActionType::values() as $actionType){
                    $action = Action::updateOrCreate(
                        ['action_type' => $actionType, 'submodule_id' => $submodule->submodule_id],
                        [
                            'action_status' => 1,
                            'action_created' => now(),
                            'action_updated' => now(),
                        ]
                    );

                    $actionPermissionName = $actionType . ' ' . strtolower(str_replace(' ', '_', $sub['name'])) . ' of ' . strtolower(str_replace(' ', '_', $mod['name']));
                    $permission = Permission::updateOrCreate(
                        ['name' => $actionPermissionName, 'permission_type' => PermissionType::ACTION, 'permission_guard_name' => 'web'],
                        [
                            'module_id' => $module->module_id,
                            'submodule_id' => $submodule->submodule_id,
                            'action_id' => $action->action_id,
                            'permission_description' => $actionType . $sub['name'],
                            'permission_status' => 1,
                            'permission_date_created' => now(),
                            'permission_date_updated' => now(),
                        ],
                    );
                    $allPermissionNames[] = $permission->name;
                }
            }
        }

        // Assign all permissions to superadmin
        $superadmin = Role::where('role_name', 'Super Admin')->first();

        if ($superadmin) {
            $superadmin->syncPermissions($allPermissionNames);
        }
    }
}
