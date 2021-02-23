<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GalleriesController;
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
 
Route::get("/galleries", [GalleriesController::class, 'index']);
Route::post("/galleries", [GalleriesController::class, 'store']);
Route::get("/galleries/{id}", [GalleriesController::class, 'show']);
Route::put("/galleries/{id}", [GalleriesController::class, 'update']);
Route::delete("/galleries/{id}", [GalleriesController::class, 'destroy']);

Route::get('comments', [CommentsController::class, 'index'] );
Route::post('comments', [CommentsController::class, 'store'] );
Route::delete('/comments/{id}', [CommentsController::class, 'destroy']);


Route::post('register', [ AuthController::class, 'register' ]);//->middleware('guest:api');
Route::post('login', [ AuthController::class, 'login' ]);//->middleware('guest:api');
Route::post('logout', [ AuthController::class, 'logout' ]);//->middleware('auth:api');
Route::get('me', [ AuthController::class, 'me' ]);//->middleware('auth:api');

