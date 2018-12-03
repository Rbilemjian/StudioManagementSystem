<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'teacher' => $faker->name,
        'student' => $faker->name,
        'amount' => $faker-> randomNumber(3, false),
        'date' => $faker->date('Y-m-d', 'now'),
        'notes' => $faker->realText(2000)
    ];
});
