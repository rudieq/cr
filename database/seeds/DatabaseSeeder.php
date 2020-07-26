<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CrUsersTableSeeder::class);
        $this->call(CrComputersTableSeeder::class);
        $this->call(CrEstatesTableSeeder::class);
    }
}
