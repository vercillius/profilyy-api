<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Applicant;
use Faker\Generator as Faker;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'account_id' => $faker->randomDigit,
        'resume_id' => $faker->randomDigit,
        'role_id' => $faker->randomElement($array = array (1,2,3))
    ];
});
