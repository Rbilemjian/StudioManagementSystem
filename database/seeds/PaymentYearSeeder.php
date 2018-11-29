<?php

use Illuminate\Database\Seeder;

class PaymentYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_years')->insert([
           'year' => 2018,
           'January' => 70,
           'February' => 70,
           'student' => 'studiostudent',
           'teacher' => 'studioteacher',
        ]);
    }
}
