<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepairController;
use Redirect;
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
    return Redirect(route('dashboard'));
});

Route::get('/dashboard', [DashboardController::class, 'route'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/{organization:slug}', [DashboardController::class, 'organization'])->middleware(['auth', 'verified', 'admin'])->name('organization-dashboard');

Route::get('/dashboard/{organization:slug}/{location:slug}', [DashboardController::class, 'location'])->middleware(['auth', 'verified'])->name('location-dashboard');

Route::get('/repair-review/{organization:slug}/{location:slug}/{repair}', [RepairController::class, 'repair_review_show'])->middleware(['auth', 'verified'])->name('repair-review');

require __DIR__.'/auth.php';
