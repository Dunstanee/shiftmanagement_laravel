<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\PageController;
use App\http\Controllers\DataController;
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
