<?php

use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('admin.dashboard.dashboard');
    // return view('welcome');
    return redirect('login');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('admin.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    /* Role Functionality */
    Route::get('/all-role', [RoleController::class, 'index'])->name('getRole');
    Route::get('/create-role', [RoleController::class, 'create'])->name('createRole');
    Route::post('/store-role', [RoleController::class, 'store'])->name('storeRole');
    Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('editRole');
    Route::put('/update-role/{id}', [RoleController::class, 'update'])->name('updateRole');
    Route::get('/delete-role/{id}', [RoleController::class, 'delete'])->name('deleteRole');


    /* Permissions Functionality */
    Route::get('/all-permissions', [PermissionController::class, 'index'])->name('getPermission');
    Route::get('/create-permission', [PermissionController::class, 'create'])->name('createPermission');
    Route::post('/store-permission', [PermissionController::class, 'store'])->name('storePermission');
    Route::get('/edit-permission/{id}', [PermissionController::class, 'edit'])->name('editPermission');
    Route::put('/update-permission/{id}', [PermissionController::class, 'update'])->name('updatePermission');
    Route::get('/delete-permission/{id}', [PermissionController::class, 'delete'])->name('deletePermission');

    Route::get('user-role', [UserRoleController::class, 'userRole'])->name('getUserRole');
    Route::get('assign-role/{id}', [UserRoleController::class, 'assignRole'])->name('getAssignRole');
    Route::post('store-assigned-role/{id}', [UserRoleController::class, 'storeAssignedRole'])->name('storeAssignRole');
    Route::get('give-access/{id}', [UserRoleController::class, 'giveAccess'])->name('getGiveAccess');
    Route::post('store-given-access/{id}', [UserRoleController::class, 'storeGivenAccess'])->name('storeGiveAccess');
    Route::get('revoke-access/{id}', [UserRoleController::class, 'revokeAccess'])->name('removeAccess');

});

/* User Role */

Route::middleware(['auth']/* ['permission:can-view-users|can-create-users|can-edit-users|can-delete-users'] */)->group(function () {
    Route::get('user-role', [UserRoleController::class, 'userRole'])->name('getUserRole');
    /* Route::get('assign-role/{id}', [UserRoleController::class, 'assignRole'])->name('getAssignRole');
    Route::post('store-assigned-role/{id}', [UserRoleController::class, 'storeAssignedRole'])->name('storeAssignRole');
    Route::get('give-access/{id}', [UserRoleController::class, 'giveAccess'])->name('getGiveAccess');
    Route::post('store-given-access/{id}', [UserRoleController::class, 'storeGivenAccess'])->name('storeGiveAccess');
    Route::get('revoke-access/{id}', [UserRoleController::class, 'revokeAccess'])->name('removeAccess'); */

    /* For Error */
    Route::get('page-not-found', [ErrorController::class,  'pageNotFound'])->name('pageNotFound');
    Route::get('access-denied', [ErrorController::class,  'permissionDenied'])->name('permissionDenied');

});





require __DIR__.'/auth.php';
