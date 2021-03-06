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
        // $this->call(UsersTableSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(UserSeeder::class);
    }
}
