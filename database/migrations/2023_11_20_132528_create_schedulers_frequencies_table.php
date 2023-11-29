<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulersFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('schedulers_frequencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frequency_id');
            $table->foreign('frequency_id')->references('id')->on('frequencies');
            $table->integer('scheduler_id');
            $table->foreign('scheduler_id')->references('id')->on('schedulers');
            $table->json('frequency_params');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulers_frequencies');
    }
}
