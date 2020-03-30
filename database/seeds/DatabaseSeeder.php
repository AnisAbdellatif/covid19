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
         $this->call(PermissionSeeder::class);
         $this->call(GroupSeeder::class);
         $this->call(UsersSeeder::class);
//         $this->call(DemandsTableSeeder::class);
//         $this->call(RequestsTableSeeder::class);
    }
}
