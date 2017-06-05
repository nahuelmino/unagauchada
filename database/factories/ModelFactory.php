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
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('unagauchada'),
        'date_of_birth' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'photo' => $faker->imageUrl(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Categoria::class, function (Faker\Generator $faker) {
    $categorias = ['Otros', 'Limpieza', 'Transporte'];

    return [
        'name' => $faker->unique()->randomElement($categorias)
    ];
});

$factory->define(App\Gauchada::class, function (Faker\Generator $faker) {

    $users = \App\User::all()->pluck('id')->all();
    $categorias = \App\Categoria::all()->pluck('id')->all();

    return [
        'creado_por' => $faker->unique(true)->randomElement($users),
        'categoria_id' => $faker->unique(true)->randomElement($categorias),
        'title' => $faker->title,
        'description' => $faker->realText(180),
        'location' => $faker->city,
        'photo' => $faker->image(null, 400, 400),
        'ends_at' => \Carbon\Carbon::tomorrow(),
    ];
});



