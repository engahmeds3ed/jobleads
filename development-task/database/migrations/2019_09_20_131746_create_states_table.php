<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('country_id')->nullable()->unsigned();
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
            $table->string("name");
            $table->string("code")->unique();
            $table->double("taxes_amount")->nullable();
            $table->double("taxes_amount_avg")->nullable();
            $table->double("taxrates_avg")->nullable();

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
        Schema::dropIfExists('states');
    }
}
