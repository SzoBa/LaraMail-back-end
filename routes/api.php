<?php

use App\Http\Controllers\MailController;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//create database and migrations, create model (create service - Eloquent ORM), create controller for info retrieval, return info
Route::apiResource('mail', MailController::class)
    ->middleware('auth:sanctum');
//TODO insert force delete and list trashed mails, draft mails routes



//Hash or bcrypt also good
//Route::post('/register', function (Request $request) {
//    $user = User::create(['name' => 'Test Elek', 'email' => 'test@test.com', 'password' => Hash::make('mypassword')]);
//    $token = $user->createToken("LaraMailAccess");
//    return response(["message" => 'Registered','token' => $token->plainTextToken], 201);
//});
//
//Route::post('/login', function () {
//    $credentials = request()->only(['email', 'password']);
//    return auth()->attempt($credentials);
//});
//ezt a tokent le kell menteni és header Authorization Bearer idebe

//authenticate - it is now used with arrow function at apiResources
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


