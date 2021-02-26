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

Route::get('/galleries', [GalleriesController::class, 'index']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/galleries/{id}', [GalleriesController::class, 'show']);
    Route::get('/author/{id}', [UserController::class, 'show']);
    Route::post('/galleries', [GalleriesController::class, 'store']);
    Route::post('/galleries/{id}/comments', [CommentsController::class, 'store']);
    Route::put('/edit-gallery/{id}', [GalleriesController::class, 'update']);
    Route::delete('/delete-comment/{id}', [CommentsController::class, 'destroy']);
    Route::delete('/galleries/{id}', [GalleriesController::class, 'destroy']);
    Route::get('/auth-user', [AuthController::class, 'authUser']);
    Route::get('/auth-user-gallery', [AuthController::class, 'authUserGallery']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});


Route::post('/refresh', [AuthController::class, 'refreshToken']);
