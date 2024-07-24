<?php

use App\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CpuApiController;
use App\Http\Controllers\Api\QueryApiController;
use App\Http\Controllers\Api\BackupApiController;
use App\Http\Controllers\CpuController;
use App\Http\Middleware\Password;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/backup-info',[BackupApiController::class,'index']);
Route::get('/cpu',[CpuApiController::class,'index']);


Route::post('/cpu',[CpuApiController::class,'store']);
Route::post('/backup-info',[BackupApiController::class,'store']);
Route::post('/queries',[QueryApiController::class,'store']);

// Route::get('/server-status', [CpuController::class, 'serverSide']);
