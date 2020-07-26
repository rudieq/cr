<?php

use Illuminate\Database\Seeder;

class CrUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CrUser::class, 100)->create();
    }
}
