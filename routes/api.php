<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\GetUserController;
use App\Http\Controllers\User\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name('login');
});

Route::prefix('users')->group(function () {
    Route::post('/', UserController::class);
    Route::get('/', GetUserController::class);
});
