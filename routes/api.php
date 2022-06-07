<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\BMSImportController;
use App\Http\Controllers\LineSuggestionController;
use App\Http\Controllers\LineModificationController;
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

Route::middleware('auth:sanctum')->post('/repair/repair-lines', [RepairController::class, 'get_repair_lines'])->name('repair-repair-lines');

Route::middleware('auth:sanctum')->post('/repair/repair-options', [RepairController::class, 'get_repair_options'])->name('repair-repair-options');

Route::middleware('auth:sanctum')->post('/repair/repair-totals', [RepairController::class, 'get_repair_totals'])->name('repair-repair-totals');

Route::middleware('auth:sanctum')->post('/repair/line-suggestion/add', [LineSuggestionController::class, 'add'])->name('add-line-suggestion');

Route::middleware('auth:sanctum')->post('/repair/line-suggestion/remove', [LineSuggestionController::class, 'remove'])->name('remove-line-suggestion');

Route::middleware('auth:sanctum')->post('/repair/line-modification/add', [LineModificationController::class, 'add'])->name('add-line-modification');

Route::middleware('auth:sanctum')->post('/repair/line-modification/remove', [LineModificationController::class, 'remove'])->name('remove-line-modification');

Route::middleware('secure_share')->post('/repair/bms-import/estimate', [BMSImportController::class, 'ccc_import']);

Route::get('/repair/bms-import/ping', [BMSImportController::class, 'ping']);
