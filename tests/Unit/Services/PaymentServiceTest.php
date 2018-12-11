<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\PaymentService;
use App\Payment;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentServiceTest extends TestCase
{

    use DatabaseMigrations;

    public $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new PaymentService();
    }

    public function testGetAllPayments()
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $data = [
            'payed_by' => 'John',
            'payed_to' => 'Bill',
            'notes' => 'These are some cool notes',
            'amount' => 20,
            'date' => $date,
            'created_at' => null,
            'updated_at' => null,
        ];


        $payment = new Payment([
            'payed_by' => 'John',
            'payed_to' => 'Bill',
            'notes' => 'These are some cool notes',
            'amount' => 20,
            'date' => $date,
            'created_at' => null,
            'updated_at' => null,

        ]);
        $payment->save();

        $res = $this->service->getAllPayments()->getData()->payments[0];

        $serviceResultArray = [
            'payed_by' => $res->payed_by,
            'payed_to' => $res->payed_to,
            'notes' => $res->notes,
            'amount' => $res->amount,
            'date' => $res->date,
            'created_at' => null,
            'updated_at' => null,
        ];


        $this->assertEquals($serviceResultArray, $data);
    }

    public function testGetPayment()
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $data = [
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
        $res = $this->service->getPayment(1)->getData()->payment;
        $resArray = [
            'id' => $res->id,
            'payed_by' => $res->payed_by,
            'payed_to' => $res->payed_to,
            'notes' => $res->notes,
            'amount' => $res->amount,
            'date' => $res->date,
            'created_at' => null,
            'updated_at' => null,
        ];
        $this->assertEquals($resArray, $data);
    }

    public function testCreatePayment()
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $data = [
            'payed_by' => 'John',
            'payed_to' => 'Bill',
            'notes' => 'These are some cool notes',
            'amount' => 20,
            'date' => $date,
        ];

        $this->service->createPayment($data);

        $this->assertDatabaseHas('payments', $data);

    }

    public function testDeletePayment()
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $data = [
            'id' => 1,
            'payed_by' => 'John',
            'payed_to' => 'Bill',
            'notes' => 'These are some cool notes',
            'amount' => 20,
            'date' => $date,
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

        $this->assertDatabaseHas('payments', $data);

        $this->service->deletePayment(1);

        $this->assertDatabaseMissing('payments', $data);
    }

}
