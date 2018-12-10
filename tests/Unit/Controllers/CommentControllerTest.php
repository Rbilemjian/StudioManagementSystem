<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\CommentController;
use App\Interfaces\CommentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;

class CommentControllerTest extends TestCase
{

    public $retriever;
    public $controller;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(CommentInterface::class);
        $this->controller = new CommentController($this->retriever);
    }

    public function testGetPostCommentsJSON()
    {
        $data = json_encode([
            'comments' => [
                'text' => "Comment Text",
                'user' => "Johnny",
                'payment_id' => 1
            ]
        ]);

        $input = [
            'id' => 1,
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('getPostCommentsJSON')
            ->once()
            ->with(1)
            ->andReturn($data);

        $response = $this->controller->getPostCommentsJSON($request);
    }

    public function testCreateComment()
    {
        $data = json_encode([
            'comment' => [
                'text' => "Comment Text",
                'user' => "Johnny",
                'payment_id' => 1
            ]
        ]);

        $input = [
            'text' => "Comment Text",
            'user' => "Johnny",
            'payment_id' => 1
        ];

        $request = new Request($input);

        $dataArray['text'] = $request->text;
        $dataArray['user'] = $request->user;
        $dataArray['payment_id'] = $request->payment_id;


        $this->retriever
            ->shouldReceive('createComment')
            ->once()
            ->with($dataArray)
            ->andReturn($data);

        $response = $this->controller->createComment($request);

        $this->assertEquals($response, $data);
    }

}
