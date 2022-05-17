<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'route'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/{organization:slug}', [DashboardController::class, 'organization'])->middleware(['auth', 'verified', 'admin'])->name('organization-dashboard');

Route::get('/dashboard/{organization:slug}/{location:slug}', [DashboardController::class, 'location'])->middleware(['auth', 'verified'])->name('location-dashboard');

require __DIR__.'/auth.php';
