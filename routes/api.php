<?php

use App\Http\Controllers\UserApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Get Api for fetch user
Route::get('/users/{id?}', [UserApiController::class, 'showUser']);
// Post Api for add user
Route::post('/add-user', [UserApiController::class, 'addUser']);
// Post Api for add multiple user
Route::post('/add-multiple-user', [UserApiController::class, 'addMultipleUser']);
// Put Api for update user
Route::put('/update-user-details/{id}', [UserApiController::class, 'updateUserDetails']);
// Patch Api for update single record
Route::patch('/update-single-record/{id}', [UserApiController::class, 'updateSingleRecord']);
// Delete Api for update single user
Route::Delete('/delete-single-user/{id}', [UserApiController::class, 'deleteUser']);
// Delete Api for update multiple user
Route::Delete('/delete-multiple-user/{ids}', [UserApiController::class, 'deleteMultipleUser']);
// Delete Api for update single user with json
Route::Delete('/delete-single-user-with-json', [UserApiController::class, 'deleteUserJson']);
// Delete Api for multiple user with json
Route::Delete('/delete-multiple-user-with-json', [UserApiController::class, 'deleteMultipleUserJson']);

Route::post('/register-user-api-using-passport', [UserApiController::class, 'registerUserAPIUsingPassport']);
