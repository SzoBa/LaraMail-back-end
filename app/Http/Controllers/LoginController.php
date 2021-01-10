<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:8',
        ];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response($validation->errors(), 400);
        }
        $credentials = request()->only(['email', 'password']);
        if(auth()->attempt($credentials)) {
            $token = $request->user()->createToken("LaraMail");
            return response(['token' => $token->plainTextToken, 'username' => $request->user()->name], 201);
        }
        return response(['message' => ['Wrong password!']], 401);
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
        return response(["message" => "Logout successful"], 204);
    }
}
