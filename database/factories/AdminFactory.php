<?php

use Faker\Generator as Faker;

$factory->define(App\User_address::class, function (Faker $faker) {
    return [
        'user_profile_id' => function () {
            return factory(App\User_profile::class)->create()->id;
        }
    ];
});

$factory->define(App\User_profile::class, function (Faker $faker) {
    return [
        'name' => "Admin Sudut Negeri",
        'profile_picture' => "storage/profile_pictures/avatar.jpg",
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => 'admin@sudutnegeri.com',
        'password' => bcrypt('ZAQ!XSW@zaq1sw2'), // ZAQ!XSW@zaq1sw2
        'role' => 'admin',
        'remember_token' => str_random(100),
        'active' => true
    ];
});