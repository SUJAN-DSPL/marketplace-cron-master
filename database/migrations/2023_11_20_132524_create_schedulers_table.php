<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('schedulers', function (Blueprint $table) {
            $table->id();
            $table->integer('frequency_id');
            $table->boolean('is_active')->default(false);
            $table->integer('cron_type_id');
            $table->foreign('cron_type_id')->references('id')->on('cron_types');
            $table->integer('allocation_id');
            $table->foreign('allocation_id')->references('id')->on('allocations');
            $table->integer('cron_job_id');
            $table->foreign('cron_job_id')->references('id')->on('cron_jobs');
            $table->softDeletes();
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
        Schema::dropIfExists('schedulers');
    }
}
