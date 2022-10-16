<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userApiController;

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

# ------------------------ users module--------------------------------------------
# show users
Route::get('/users/{id?}',[userApiController::class,'getUser']);
# add user
Route::post('/addUser',[userApiController::class,'addUser']);
# add multiple users
Route::post('/addMultipleUsers',[userApiController::class,'addMultipleUsers']);
# update user details
Route::put('/updateUserDetails/{id}',[userApiController::class,'updateUserDetails']);
# delete user
Route::delete('/deleteUser/{id?}',[userApiController::class,'deleteUser']);
# delete multiple user
Route::delete('/deleteMultipleUser',[userApiController::class,'deleteMultipleUser']);
