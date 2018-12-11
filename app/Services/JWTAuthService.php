<?php

namespace App\Services;
use App\Interfaces\JWTAuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class JWTAuthService implements JWTAuthInterface
{

        public function signUp(Request $request)
        {
            User::create($request->all());
            return $this->login($request);
        }

        public function login()
        {
            $credentials = request(['email', 'password']);

            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        }

        public function logout()
        {
            auth('api')->logout();

            return response()->json(['message' => 'Successfully logged out']);
        }

        public function guard()
        {
            return \Auth::Guard('api');
        }

        protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'user' => $this->guard()->user(),
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        }
}
