<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Contact::class, function (Faker\Generator $faker) {


    return [
        'company_id' => factory('App\Company')->create()->id,
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'birthday' => $faker->date(),
        'email' => $faker->unique()->safeEmail,
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Company::class, function (Faker\Generator $faker) {


    return [
        'name' => $faker->company,
    ];
});