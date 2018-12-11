<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

Interface JWTAuthInterface
{
    public function signUp(Request $request);
    public function login();
    public function logout();
    public function guard();
}
