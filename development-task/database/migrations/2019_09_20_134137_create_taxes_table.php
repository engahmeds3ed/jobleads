<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('taxrate_id')->nullable()->unsigned();
            $table->foreign('taxrate_id')
                ->references('id')->on('taxrates')
                ->onDelete('cascade');

            $table->bigInteger('county_id')->nullable()->unsigned();
            $table->foreign('county_id')
                ->references('id')->on('counties')
                ->onDelete('cascade');

            $table->double("amount")->unsigned();

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
        Schema::dropIfExists('taxes');
    }
}
