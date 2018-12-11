<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\AuthController;
use App\Interfaces\JWTAuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;

class AuthControllerTest extends TestCase
{

    public $retriever;
    public $controller;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(JWTAuthInterface::class);
        $this->controller = new AuthController($this->retriever);
    }

    public function testSignUp()
    {
        $data = json_encode([
            "access_token" => "mockToken",
            "token_type" => "bearer",
            "expires_in" => 3600,
            "username" => "raffthedog@gmail.com",
            "user_id" => 1
        ]);
        $input = [
            "email" => "raffthedog@gmail.com",
            "name" => "raff the dog",
            "password" => "passwordladabsolutelyamazing",
        ];
        $request = new Request($input);
        $this->retriever
            ->shouldReceive('signUp')
            ->once()
            ->with($request)
            ->andReturn($data);
        $response = $this->controller->signUp($request);
        $this->assertEquals($response, $data);
    }

    public function testLogin()
    {
        $data = json_encode(
           [
               "access_token" => "mockToken",
               "token_type" => "bearer",
               "expires_in" => 3600,
               "username" => "raffthedog@gmail.com",
               "user_id" => 1
           ]
       );

       $input = [
            "email" => "raffthedog@gmail.com",
            "password" => "passwordladabsolutelyamazing",
        ];

        $request = new Request($input);
        $this->retriever
            ->shouldReceive('login')
            ->once()
            ->andReturn($data);
        $response = $this->controller->login($request);
        $this->assertEquals($response, $data);
    }

    public function testLogout()
    {
        $data = json_encode([
            "message" => "Successfully logged out"
        ]);

        $input = [
            "token" => "mockToken"
        ];
        $request = new Request($input);
        $this->retriever
            ->shouldReceive('logout')
            ->once()
            ->andReturn($data);
        $response = $this->controller->logout($request);
        $this->assertEquals($response, $data);
    }
}
