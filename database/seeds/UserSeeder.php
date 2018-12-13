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
            'name' => 'Professor',
            'email' => 'professor@example.com',
            'password' => bcrypt('password'),
        ]);
        factory(User::class, 30)->create();
    }
}
