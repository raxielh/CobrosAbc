<?php

use Faker\Generator as Faker;

$factory->define(App\Cobro::class, function (Faker\Generator $faker) {

    return [
	 	'nombre'=>$faker->name,
	 	'localidad'=>$faker->name,
	 	'estado'=>$faker->rand(1,2),
	 	'color'=>$faker->color,
	 	'user_id'=>$faker->rand(1,20),
    ];

});
