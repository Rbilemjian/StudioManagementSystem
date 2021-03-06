<?php

use Faker\Generator as Faker;
use App\Payment;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'payed_to' => $faker->name,
        'payed_by' => $faker->name,
        'amount' => $faker-> randomNumber(3, false),
        'date' => $faker->date('Y-m-d', 'now'),
        'notes' => $faker->realText(200)
    ];
});
