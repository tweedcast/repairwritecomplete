<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\BMSImportController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/repair-list/{location:slug}', [RepairController::class, 'repair_list'])->name('location-repair-list');


Route::middleware('secure_share')->post('/repair/bms-import', [BMSImportController::class, 'import']);

Route::get('/repair/bms-import/ping', [BMSImportController::class, 'ping']);
