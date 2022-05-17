<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\PageController;
use App\http\Controllers\DataController;
use App\Http\Controllers\TableController;

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

Route::get('/', [PageController::class, 'login']);
Route::post('/', [DataController::class, 'Login']);
Route::get('/Dashboard', [PageController::class, 'Dashboard']);
Route::post('NewCompany', [DataController::class, 'NewCompany']);
Route::get('Company', [PageController::class, 'NewCompany']);
Route::get('New-Employee', [PageController::class, 'NewEmployee']);
Route::get('Employee', [PageController::class, 'Employee']);
Route::get('Sms', [PageController::class, 'EmployeeSms']);
Route::post('SendSms', [DataController::class, 'SendSms']);
Route::get('Employee/{id}', [PageController::class, 'EditEmployee']);
Route::get('GetEmployees', [TableController::class, 'GetEmployees']);
Route::get('GetEmployeesSms', [TableController::class, 'GetEmployeesSms']);
Route::get('GetComposeSms', [TableController::class, 'GetComposeSms']);
Route::get('GetMessages', [TableController::class, 'GetMessages']);
Route::post('NewEmployee', [DataController::class, 'NewEmployee']);
Route::get('Employee-Report', [PageController::class, 'EmployeeReport']);
Route::post('UpdateEmployee/{id}', [DataController::class, 'UpdateEmployee']);

Route::get('New-Staff', [PageController::class, 'NewStaff']);
Route::post('Staff', [DataController::class, 'Staff']);
Route::get('Staff', [PageController::class, 'Staff']);
Route::get('GetStaffs', [TableController::class, 'GetStaffs']);



Route::get('Signout', [PageController::class, 'Signout']);
Route::put('Staff/{id}', [DataController::class, 'StaffDelete']);
Route::get('Staff-Report', [PageController::class, 'StaffReport']);