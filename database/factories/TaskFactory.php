<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 200),
        'status_id' =>  function () {
            return factory(App\TaskStatus::class);
        },
        'created_by_id' => function () {
            return factory(App\User::class);
        },
        'assigned_to_id' => function () {
            return factory(App\User::class);
        },
    ];
});
