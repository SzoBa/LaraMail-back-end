<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
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

Route::apiResource('mail', MailController::class)
    ->middleware('auth:sanctum');

Route::delete('/mail/force-delete/{id}',[MailController::class, 'forceDelete'])
    ->middleware('auth:sanctum');

Route::get('/user/list', [UserController::class, 'index']);

Route::get('/user/name/{id}', [UserController::class, 'show'])
    ->middleware('auth:sanctum');

Route::get('/mail-recycle', [MailController::class, 'recycle'])
    ->middleware('auth:sanctum');

Route::get('/mail-sent', [MailController::class, 'sent'])
    ->middleware('auth:sanctum');

Route::get('/mail-draft', [MailController::class, 'draft'])
    ->middleware('auth:sanctum');

Route::post('/register', [RegisterUserController::class, 'store']);

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth:sanctum');

