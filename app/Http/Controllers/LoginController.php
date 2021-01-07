<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): ?Response
    {
        $credentials = request()->only(['email', 'password']);
        if(auth()->attempt($credentials)) {
            $token = $request->user()->createToken("LaraMail");
            return response(['token' => $token->plainTextToken, 'username' => $request->user()->name], 201);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  Request  $request
     * @return Response
     */
    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();
        return response(["message" => "Logout successful"], 200);
    }
}
