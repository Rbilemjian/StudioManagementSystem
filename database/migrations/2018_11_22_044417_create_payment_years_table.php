<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_years', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user');
            $table->smallInteger('year');
            $table->integer('January')->nullable();
            $table->integer('February')->nullable();
            $table->integer('March')->nullable();
            $table->integer('April')->nullable();
            $table->integer('May')->nullable();
            $table->integer('June')->nullable();
            $table->integer('July')->nullable();
            $table->integer('August')->nullable();
            $table->integer('September')->nullable();
            $table->integer('October')->nullable();
            $table->integer('November')->nullable();
            $table->integer('December')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_years');
    }
}
