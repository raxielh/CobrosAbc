<?php

use Illuminate\Database\Seeder;

class CobrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cobro::class,20)->create();
    }
}
