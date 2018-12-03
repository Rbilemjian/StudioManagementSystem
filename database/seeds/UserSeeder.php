<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'raffi',
            'email' => 'rbilemjian@gmail.com',
            'password' => bcrypt('pokemon'),
        ]);
        factory(User::class, 100)->create();
    }
}
