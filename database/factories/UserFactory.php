<?php

use Faker\Generator as Faker;


$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\UsersInfo::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'username' => $faker->name,
        'job_title' => $faker->jobTitle,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'status' => 'online',
    ];
});

