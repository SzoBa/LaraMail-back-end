<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(User::all(['name']), 200);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $user = User::find($id);
        if(is_null($user)) {
            return response(['message'=>'User not found'], 404);
        }
        return response($user, 200);
    }
}
