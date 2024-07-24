<?php

use App\Cpu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CpuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServerDetailController;

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

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/indexServerDetail/{id}', [CpuController::class, 'show']);
Route::get('/index', [DashboardController::class, 'index']);
Route::get('/dashboard', [CpuController::class, 'index']);
Route::get('/server-detail/{id}', [CpuController::class, 'show']);


// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/test/{id}', [CpuController::class, 'test']);

Route::get('/notif', [DashboardController::class, 'notif']);
Route::get('/notif', [ServerDetailController::class, 'notif']);


// Route::get('/')
