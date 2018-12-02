<?php

namespace App\Interfaces;

Interface JWTAuthInterface
{
    public function signUp(array $arr);
    public function guard();
}
