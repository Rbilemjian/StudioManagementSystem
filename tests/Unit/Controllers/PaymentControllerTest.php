<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\PaymentController;
use App\Interfaces\PaymentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;


class PaymentControllerTest extends TestCase
{
    public $retriever;
    public $controller;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(PaymentInterface::class);
        $this->controller = new PaymentController($this->retriever);
    }

    public function testGetAllPayments()
    {
        $data = json_encode([
            [
                'id' => 1,
                'payed_by' => "The Raff",
                'payed_to' => "Mikey Chan",
                'amount' => 1000,
                'date' => "2018-12-25",
            ],
            [
                'id' => 2,
                'payed_by' => "A G",
                'payed_to' => "The other G",
                'amount' => 2000,
                'date' => "2018-12-24",
            ],
        ]);

        $this->retriever
            ->shouldReceive('getAllPayments')
            ->once()
            ->andReturn($data);

        $response = $this->controller->getAllPayments();

        $this->assertEquals($data, $response);
    }

    public function testGetPayment()
    {
        $data = json_encode([
            [
                'id' => 1,
                'payed_by' => "The Raff",
                'payed_to' => "Mikey Chan",
                'amount' => 1000,
                'date' => "2018-12-25",
            ]
        ]);

        $input = [
            'id' => 1,
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('getPayment')
            ->once()
            ->with(1)
            ->andReturn($data);

        $response = $this->controller->getPayment($request);

        $this->assertEquals($response, $data);
    }

    public function testCreatePayment()
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $data = json_encode([
            [
                'payment' => [
                    'amount' => 200,
                    'notes' => "These are some notes.",
                    'payed_to' => "Raff Boy",
                    'payed_by' => "Liad the Man",
                    'date' => $date,
                ]
            ]
        ]);

        $input =
            [
                'amount' => 200,
                'notes' => "These are some notes.",
                'payed_to' => "Raff Boy",
                'payed_by' => "Liad the Man",
            ];

        $request = new Request($input);

        $dataArray['amount'] = $request->amount;
        $dataArray['notes'] = $request->notes;
        $dataArray['payed_to'] = $request->payed_to;
        $dataArray['payed_by'] = $request->payed_by;

        $this->retriever
            ->shouldReceive('createPayment')
            ->once()
            ->with($dataArray)
            ->andReturn($data);

        $response = $this->controller->createPayment($request);

        $this->assertEquals($response, $data);

    }

    public function testPaymentsDirectsUserCorrectly()
    {
        $response = $this->call('GET', '/payments');
        $response->assertStatus(200);
    }
}
