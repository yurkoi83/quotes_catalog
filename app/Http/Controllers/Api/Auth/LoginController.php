<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request)
    {
        try {
            // Get credentials values
            $credentials = [
                'email' => $request->input('email'),
                'password'  => $request->input('password'),
            ];

            // Auth the User
            if (auth()->attempt($credentials, $request->has('remember_me'))) {
                $user = User::find(auth()->user()->getAuthIdentifier());

                // Revoke previous tokens
                $user->tokens()->delete();

                // Create the API access token
                $deviceName = $request->input('device_name', 'Desktop Web');
                $token = $user->createToken($deviceName);

                $data = [
                    'success' => true,
                    'result'  => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'extra'   => [
                        'authToken' => $token->plainTextToken,
                        'tokenType' => 'Bearer',
                    ],
                ];

                return $this->apiResponse($data);
            }

        } catch (\Throwable $e) {
            $errorMessage = $e->getMessage();
        }
    }
}
