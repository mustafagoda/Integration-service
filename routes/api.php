<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedApiController;
use App\Http\Controllers\Tenant\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthenticatedApiController::class, 'login'])->name('login');
    Route::post('/register', [AuthenticatedApiController::class, 'register'])->name('register');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/logout', [AuthenticatedApiController::class, 'logout'])->name('logout');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/{slug}', [SettingController::class, 'show'])->name('settings.show');
    Route::put('/settings/{slug}', [SettingController::class, 'update'])->name('settings.update');
});
