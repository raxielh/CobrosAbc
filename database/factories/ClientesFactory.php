<?php

use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker\Generator $faker) {

    return [
	 	'nombre'=>$faker->name,
	 	'identificacion'=>$faker->number,
	 	'telefono'=>$faker->number,
	 	'direccion'=>$faker->name,
	 	'referencia'=>$faker->name,
	 	'barrio_id'=>$faker->number,
	 	'cobro_id'=>$faker->number,
    ];
});
