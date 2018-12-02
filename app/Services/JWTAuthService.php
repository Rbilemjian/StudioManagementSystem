<?php

namespace App\Services;
use App\Interfaces\JWTAuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class JWTAuthService implements JWTAuthInterface
{

        public function signUp(array $request)
        {
             $user = new User([
                 'name' => $request['name'],
                 'email' => $request['email'],
                 'password' => $request['password']
             ]);
             $user->save();
        }

        public function guard()
        {
            return \Auth::Guard('api');
        }
}
