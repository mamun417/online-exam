<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Option;
use Faker\Generator as Faker;

$factory->define(Option::class, function (Faker $faker) {

    $name = $faker->unique()->firstNameMale;

    return [
        'option' => ucfirst($name)
    ];
});
