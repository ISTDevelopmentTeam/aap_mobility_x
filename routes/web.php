<?php

use App\Livewire\Ams\Main;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Livewire\Ams\Asset\TransferForm;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\CorporateController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    // route for profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user_id}', [ProfileController::class, 'view'])->name('profile.view');

    //route for permission
    Route::resource('permission', PermissionController::class);
    Route::get('permission/{permissionId}/delete', [PermissionController::class, 'destroy']);

    //route for role
    Route::resource('role', RoleController::class);
    Route::get('role/{roleId}/delete', [RoleController::class, 'destroy']);

    //route for user
    Route::post('/user/get-role', [UserController::class, 'displayRoleAccess']);
    Route::post('/user/{id}/update-status', [UserController::class, 'updateStatus']);

    Route::get('user/search/find', [UserController::class, 'find']);
    Route::get('user/search', [UserController::class, 'search']);
    Route::get('user/{userId}/create', [UserController::class, 'create']);
    Route::get('user/{userId}/delete', [UserController::class, 'destroy']);
    Route::resource('user', UserController::class);

    //route for employee
    Route::get('/employee/manpower-requisition', [EmployeeController::class, 'manpowerRequisition'])->name('manpower-requisition');
    Route::get('/employee/vacancy-list', [EmployeeController::class, 'vacancyList'])->name('vacancy-list');
    Route::resource('employee', EmployeeController::class);
    Route::get('employee/{employeeId}/delete', [EmployeeController::class, 'destroy'])->name("employee.delete");
    Route::get('/employee/search', [EmployeeController::class, 'search']);
    Route::get('/employee/alphalist/view-employee-profile/{employee_id}', [EmployeeController::class, 'employeeProfile'])->name('employeeProfile');
    // Route::get('/employee.alphalist.add-employee',[EmployeeController::class,'addEmployee' ])->name('addEmployee');
    Route::get('/employee.alphalist.edit-employee/{employee_id}', [EmployeeController::class, 'editEmployee'])->name('editEmployee');

    // CRUD for employee
    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.alphalist.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.alphalist.create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employees.alphalist.store');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.alphalist.show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.alphalist.edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.alphalist.update');
    });

    //route for ams
    Route::get('/ams', [AssetController::class, 'dashboard'])->name('dashboard');
    Route::get('/ams/all-assets', [AssetController::class, 'allAssets'])->name('allAssets');
    Route::get('/ams/assets/create', [AssetController::class, 'addAsset'])->name('addAsset');
    Route::post('/ams/assets/validate', [AssetController::class, 'validateAndEmit'])->name('asset.queue.validate');


    Route::get('ams/assets/view/{id}', [AssetController::class, 'show'])->name('ams.asset.view');
    Route::get('/ams/assets/edit/{id}', [AssetController::class, 'edit'])->name('ams.asset.edit');
    Route::put('/ams/assets/{id}', [AssetController::class, 'update'])->name('ams.asset.update');


    Route::get('/ams/assets/edit', [AssetController::class, 'editAsset'])->name('editAsset');
    Route::get('/ams/assets/pullout', [AssetController::class, 'pulloutAsset'])->name('pulloutAsset');
    Route::get('/ams/assets/repair-request', [AssetController::class, 'repairRequestAsset'])->name('repairRequestAsset');
    Route::get('/assets/transfer/{id}', [AssetController::class, 'showTransferForm'])->name('ams.asset.transfer');

    Route::get('/ams/assets/borrow', [AssetController::class, 'borrowAsset'])->name('borrowAsset');

    Route::get('/ams/assets/history', [AssetController::class, 'assetHistory'])->name('assetHistory');
    Route::get('/ams/common-assets', [AssetController::class, 'commonAssets'])->name('commonAssets');
    Route::get('/ams/assets-for-sale', [AssetController::class, 'assetsForSale'])->name('assetsForSale');

    // Routes for CMS (romuromu)
    Route::view('/cms/departments', 'livewire/cms/department/index')->name('departments');
    Route::view('/cms/brands', 'livewire/cms/brand/index')->name('brands');
    Route::view('/cms/asset-categories', 'livewire/cms/assetcategory/index')->name('asset-categories');
    Route::view('/cms/asset-statuses', 'livewire/cms/assetstatus/index')->name('asset-statuses');
    Route::view('/cms/asset-conditions', 'livewire/cms/assetcondition/index')->name('asset-conditions');
    Route::redirect('/cms', '/cms/departments');
    
    //Route::view('/ams/cms/departments', 'ams.cms.department.index')->name('department');
    Route::get('/ams/cms/create-branch', [AssetController::class, 'addBranch'])->name('addBranch');
    Route::get('/ams/cms/create-department', [AssetController::class, 'addDepartment'])->name('addDepartment');
    Route::get('/ams/cms/it-brands', [AssetController::class, 'employees'])->name('it-brands');
    Route::get('/ams/cms/asset-categories', [AssetController::class, 'categories'])->name('category');
    Route::get('/ams/cms/asset-status', [AssetController::class, 'status'])->name('status');
    Route::get('/ams/cms/create-category', [AssetController::class, 'addCategory'])->name('addCategory');
    Route::get('/ams/cms/create-status', [AssetController::class, 'addStatus'])->name('addStatus');


    Route::get('/ams/scan-qr', [AssetController::class, 'scanQr'])->name('scanQr');


    //route for organization
    Route::resource('organization', OrganizationController::class);
    Route::get('organization/{orgId}/delete', [OrganizationController::class, 'destroy']);

    //route for module
    Route::resource('module', ModuleController::class);
    Route::get('module/{orgId}/delete', [ModuleController::class, 'destroy']);

    //route for submodule
    Route::resource('submodule', SubmoduleController::class);
    Route::get('submodule/{orgId}/delete', [SubmoduleController::class, 'destroy']);

    // route for customers (CRM)
    Route::get('/customer/contacts', [CustomerController::class, 'contacts'])->name('contacts');

    // Routes for email marketing submodule (CRM)
    Route::get('/customer/email-marketing', [CustomerController::class, 'emailMarketing'])->name('email-marketing');
    Route::get('/customer/email-marketing/message-template', [CustomerController::class, 'messageTemplate'])->name('message-template');
    Route::get('/customer/email-marketing/message-list', [CustomerController::class, 'messageList'])->name('message-list');
    Route::get('/customer/email-marketing/compose-email', [CustomerController::class, 'composeEmail'])->name('compose-email');
    Route::get('/customer/email-marketing/compose-mobile', [CustomerController::class, 'composeMobile'])->name('compose-mobile');

    Route::get('/customer/corporate', [CustomerController::class, 'corporate'])->name('corporate');
    Route::get('/customer/sale-tracking', [CustomerController::class, 'salesTracking'])->name('sales-tracking');
    Route::resource('customer', CustomerController::class);

    // routes for corporate (CRM)
    Route::get('/customer/corporate/agent', [CorporateController::class, 'Agent'])->name('agent');
    Route::get('/customer/corporate/commission', [CorporateController::class, 'Commission'])->name('commission');

    Route::get('/requisition/pending-list', [RequisitionController::class, 'pendingList'])->name('pending-list');
    Route::get('/requisition/pending-list/{requisition_id}', [RequisitionController::class, 'viewPendingRequest'])->name('view-pending-request');
    Route::get('/requisition/waiting-approval-list', [RequisitionController::class, 'waitApprovalList'])->name('wait-approval-list');
    Route::get('/requisition/waiting-approval-list/{requisition_id}', [RequisitionController::class, 'viewWaitingApprovalRequest'])->name('view-waiting-approval-request');

    Route::resource('requisition', RequisitionController::class);

});

//route for login
Route::get('dashboard', [UserController::class, 'viewDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/notes', [NoteController::class, 'index']);

// Route::get('/send-message', function () {
//     broadcast(new MessageSent('Hello from Reverb + Livewire!'));
//     return 'Message Sent!';
// });

// Notes
Route::get('/calendar/departments', [CalendarController::class, 'getDepartments']);
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::post('/calendar/save-note', [CalendarController::class, 'saveNote'])->name('calendar.save-note');
Route::delete('/calendar/delete-note', [CalendarController::class, 'deleteNote'])->name('calendar.delete-note');
Route::get('/calendar/notes', [CalendarController::class, 'getNotes'])->name('calendar.notes');



require __DIR__ . '/auth.php';