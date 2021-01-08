<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Mail;
use Illuminate\Support\Facades\Hash;
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


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//create database and migrations, create model (create service - Eloquent ORM), create controller for info retrieval, return info
Route::apiResource('mail', MailController::class)
    ->middleware('auth:sanctum');
//TODO insert force delete and list trashed mails, draft mails routes

Route::get('/mail-sent', [MailController::class, 'sent'])
    ->middleware('auth:sanctum');

Route::get('/mail-draft', [MailController::class, 'draft'])
    ->middleware('auth:sanctum');

Route::post('/register', [RegisterUserController::class, 'store']);

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth:sanctum');

//Hash or bcrypt also good

