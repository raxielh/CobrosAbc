<?php

use Faker\Generator as Faker;

$factory->define(App\Barrio::class, function (Faker\Generator $faker) {

    return [
	 	'nombre'=>$faker->name,
	 	'referencia'=>$faker->name,
	 	'cobro_id'=>$faker->rand(1,20),
    ];

});
