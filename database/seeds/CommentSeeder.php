<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon\Carbon::now()->toDateTimeString();
        DB::table('comments')->insert([
            'text' => 'This is a test comment',
            'user' => 'raffi',
            'payment_id' => 1,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
    }
}
