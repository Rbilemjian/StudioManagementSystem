<?php

use Faker\Generator as Faker;
use App\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    $payments = App\Payment::pluck('id')->toArray();
    return [
        'user' => $faker->name,
        'text' => $faker->realText(1000),
        'payment_id' => $faker->randomElement($payments),
    ];
});
