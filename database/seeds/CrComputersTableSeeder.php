<?php

use Illuminate\Database\Seeder;

class CrComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CrComputer::class, 100)->create();
    }
}
