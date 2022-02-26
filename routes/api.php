<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\KoliController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users/index', [UsersController::class, 'index']);
Route::post('users/register', [UsersController::class, 'register']);
Route::post('users/destroy/{id}', [UsersController::class, 'destroy']);
Route::get('users/show/{id}', [UsersController::class, 'show']);
Route::post('users/update/{id}', [UsersController::class, 'update']);

Route::post('koli/putin', [KoliController::class, 'putin']);
Route::post('koli/update/{id}', [KoliController::class, 'update']);
Route::post('koli/common', [KoliController::class, 'common']);
Route::post('koli/takeout', [KoliController::class, 'takeout']);
