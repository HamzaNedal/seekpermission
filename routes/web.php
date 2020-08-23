<?php

use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\RequsettoseekpermissionController;
use App\Http\Controllers\Backend\RoleAndPermissionController;
use App\Http\Controllers\Backend\ShowRequestsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginEmployee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/createNew', [RoleAndPermissionController::class, 'createNew'])->name('dashboard');
Route::get('/employee/login', [LoginEmployee::class, 'index'])->name('employee.login.index');
Route::post('/employee/login', [LoginEmployee::class, 'login'])->name('employee.login');
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // //User
    // Route::get('/users', [UserController::class,'index'])->name('admin.users.index');
    // Route::get('/users/datatable', [UserController::class,'datatable'])->name('admin.users.datatable');
    // Route::get('/users/create', [UserController::class,'create'])->name('admin.users.create');
    // Route::post('/users', [UserController::class,'store'])->name('admin.users.store');
    // Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('admin.users.edit');
    // Route::put('/users/{id}', [UserController::class,'update'])->name('admin.users.update');
    // Route::delete('/users/{id}', [UserController::class,'destroy'])->name('admin.users.destroy');
    // //end User
    Route::group(['middleware' => ['can:access']], function () {
        //empolyee
        Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee.index');
        Route::get('/employee/datatable', [EmployeeController::class, 'datatable'])->name('admin.employee.datatable');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('/employee', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');
        //end empolyee
        //role
        Route::get('/role', [RoleAndPermissionController::class, 'index'])->name('admin.role.index');
        Route::get('/role/datatable', [RoleAndPermissionController::class, 'datatable'])->name('admin.role.datatable');
        Route::get('/role/create', [RoleAndPermissionController::class, 'create'])->name('admin.role.create');
        Route::post('/role', [RoleAndPermissionController::class, 'store'])->name('admin.role.store');
        Route::get('/role/{id}/edit', [RoleAndPermissionController::class, 'edit'])->name('admin.role.edit');
        Route::put('/role/{id}', [RoleAndPermissionController::class, 'update'])->name('admin.role.update');
        Route::delete('/role/{id}', [RoleAndPermissionController::class, 'destroy'])->name('admin.role.destroy');
        //end role
        //show logs 
        Route::get('/showLogs', [ShowRequestsController::class, 'showLogs'])->name('admin.logs.index');
        Route::get('/showLogs/datatable', [ShowRequestsController::class, 'datatableLog'])->name('admin.logs.datatable');
        //end logs 

    });

    Route::group(['middleware' => ['can:show_request']], function () {
        //showRequests to seek permission
        Route::get('/showRequests', [ShowRequestsController::class, 'index'])->name('admin.showrequest.index');
        Route::get('/showRequests/datatable', [ShowRequestsController::class, 'datatable'])->name('admin.showrequest.datatable');
        Route::get('/showRequests/status/{user_id}/{order_id}/{status}', [ShowRequestsController::class, 'update'])->name('admin.updaterequest');
        //end showRequests to seek permission
    });
    //request to seek permission
    Route::get('/request', [RequsettoseekpermissionController::class, 'index'])->name('admin.request.index');
    Route::get('/request/datatable', [RequsettoseekpermissionController::class, 'datatable'])->name('admin.request.datatable');
    Route::get('/request/create', [RequsettoseekpermissionController::class, 'create'])->name('admin.request.create');
    Route::post('/request', [RequsettoseekpermissionController::class, 'store'])->name('admin.request.store');
    Route::get('/request/{id}/show', [RequsettoseekpermissionController::class,'show'])->name('admin.request.show');
    Route::put('/request/{id}', [RequsettoseekpermissionController::class, 'update'])->name('admin.request.update');
    Route::delete('/request/{id}', [RequsettoseekpermissionController::class, 'destroy'])->name('admin.request.destroy');
    //end request to seek permission


});
