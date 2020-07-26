<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\CrUser::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'comment' => $faker->text(100)
    ];
});
