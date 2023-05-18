<?php

use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signUp', [UserController::class, 'signUp']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/verifyCode', [UserController::class, 'verifyCode']);
Route::post('/sendCodeToApi', [UserController::class, 'sendCodeToApi']);
Route::post('/changePassword', [UserController::class, 'changePassword']);
Route::post('/logout', [UserController::class, 'logout']);

