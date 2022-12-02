<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class UserAuthController extends Controller
{

    /**
     * Handle login request
     */
    public function login(LoginRequest $request)
    {
        $data = $request->only(['email', 'password']);

        if (!auth()->attempt($data)) {
            return response(['message' => 'Invalid Credentials', 401]);
        }

        /** @var Any $user */
        $user = auth()->user();
        //create token or login process
        $token = $user->createToken('RPK-APIToken')->accessToken;


        return response(['message' => 'Login Success', 'data' => [
            'token' => $token
        ]], 200);
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        /** @var Any */
        $user = auth()->user();
        $token = $user->token();
        // Revoke user token from database
        $token->revoke();

        return response(['message' => 'Logout Success']);
    }
}
