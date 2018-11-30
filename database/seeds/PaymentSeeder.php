<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon\Carbon::now()->toDateTimeString();
        $date = Carbon\Carbon::now()->toDateString();
        DB::table('payments')->insert([
           'amount' => 70,
           'date' => $date,
           'student' => 'studiostudent',
           'teacher' => 'studioteacher',
           'created_at' => $timestamp,
           'updated_at' => $timestamp,
        ]);
    }
}
