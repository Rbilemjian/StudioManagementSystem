<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Interfaces\JWTAuthInterface;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    protected $ai = null;
    public function __construct(JWTAuthInterface $ai)
    {
        $this->middleware('JWT', ['except' => ['login', 'signUp']]);
        $this->ai = $ai;
    }

    public function signUp(Request $request)
    {

        return $this->ai->signUp($request);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        return $this->ai->login();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->ai->logout();
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function guard()
    {
        return $this->ai->guard();
    }


}
