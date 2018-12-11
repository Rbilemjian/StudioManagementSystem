<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CommentService;
use App\Comment;
use App\Payment;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentServiceTest extends TestCase
{

    use DatabaseMigrations;

    public $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new CommentService();
    }

    public function testGetPostCommentsJSON()
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $paymentData = [
            'id' => 1,
            'payed_by' => 'John',
            'payed_to' => 'Bill',
            'notes' => 'These are some cool notes',
            'amount' => 20,
            'date' => $date,
            'created_at' => null,
            'updated_at' => null,
        ];
        $payment = new Payment([
            'id' => 1,
            'payed_by' => 'John',
            'payed_to' => 'Bill',
            'notes' => 'These are some cool notes',
            'amount' => 20,
            'date' => $date,
            'created_at' => null,
            'updated_at' => null,
        ]);
        $payment->save();
        $commentData = [
            'text' => 'Test comment text',
            'user' => 'Test User',
            'payment_id' => 1,
        ];
        $comment = new Comment([
            'text' => 'Test comment text',
            'user' => 'Test User',
            'payment_id' => 1,
        ]);
        $comment->save();

        $res = $this->service->getPostCommentsJSON(1)->getData()->comments[0];

        $resArr = [
            'text' => $res->text,
            'user' => $res->user,
            'payment_id' => $res->payment_id
        ];

        $this->assertEquals($resArr, $commentData);
    }

    public function testCreateComment()
    {
        $commentData = [
            'text' => 'Test comment text',
            'user' => 'Test User',
            'payment_id' => 1,
        ];

        $this->service->createComment($commentData);

        $this->assertDatabaseHas('comments', $commentData);
    }

    public function testDeleteComment()
    {
        $commentData = [
            'id' => 1,
            'text' => 'Test comment text',
            'user' => 'Test User',
            'payment_id' => 1,
        ];

        $comment = new Comment([
            'id' => 1,
            'text' => 'Test comment text',
            'user' => 'Test User',
            'payment_id' => 1,
        ]);

        $comment->save();

        $this->assertDatabaseHas('comments', $commentData);

        $this->service->deleteComment(1);

        $this->assertDatabaseMissing('comments', $commentData);
    }
}
