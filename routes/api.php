<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Mail;
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

Route::get('/register', function () {
   //TODO check and save to db
    $mail = Mail::create(['id_user_from' => 0, 'id_user_to'=>0, 'subject' =>'test subject',
        'message'=>'something test']);
    return $mail;
});

//CRUD
//get all GET
//create one POST
//get one GET /{id}
//update one PUT /{id}
//delete DELETE /{id}

//create database and migrations, create model (create service - Eloquent ORM), create controller for info retrieval, return info




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
