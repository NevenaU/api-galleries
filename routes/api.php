<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'auth:api'], function () {
    Route::delete('/delete-comment/{id}', [CommentsController::class, 'destroy']);
    Route::delete('/galleries/{id}', [GalleriesController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::get('/galleries', [GalleriesController::class, 'index']);
Route::get('/galleries/{id}', [GalleriesController::class, 'show']);
Route::get('/author/{id}', [UserController::class, 'show']);


Route::post('register', [AuthController::class, 'register'])->middleware('guest:api');
Route::post('login', [AuthController::class, 'login'])->middleware('guest:api');
Route::post('/refresh', [AuthController::class, 'refreshToken']);
