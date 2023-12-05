<?php

use App\Models\CronStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cron_logs', function (Blueprint $table) {
            $table->id();
            $table->tinyText('ref_id');
            $table->foreignUuid('scheduler_id')->references('uuid')->on('schedulers');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();
            $table->integer('cron_status_id')->default(CronStatus::DRAFT);
            $table->foreign('cron_status_id')->references('id')->on('cron_statuses')->onDelete('cascade');
            $table->json('exception')->nullable();
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
        Schema::dropIfExists('cron_logs');
    }
}
