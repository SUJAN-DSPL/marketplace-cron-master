<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cron_jobs', function (Blueprint $table) {
            $table->uuid()->autoIncrement();
            $table->string('name');
            $table->string('path');
            $table->string('description');
            $table->integer('cron_type_id');
            $table->foreign('cron_type_id')->references('id')->on('cron_types');
            $table->integer('allocation_id');
            $table->foreign('allocation_id')->references('id')->on('allocations');
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
        Schema::dropIfExists('cron_jobs');
    }
}
