<?php

use App\Http\Controllers\V1\UserController;
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

Route::post('/v1/users', [UserController::class, 'register']);
Route::get('/v1/users/{id}', [UserController::class, 'byId']);
Route::get('/v1/users/{id}/name', [UserController::class, 'updateName']);
