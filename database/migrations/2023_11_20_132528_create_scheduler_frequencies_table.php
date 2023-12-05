<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulerFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('scheduler_frequencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frequency_id')->references('id')->on('frequencies')->onDelete('cascade');
            $table->foreignUuid('scheduler_id')->references('uuid')->on('schedulers')->onDelete('cascade');
            $table->json('frequency_params')->nullable();
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
        Schema::dropIfExists('scheduler_frequencies');
    }
}
