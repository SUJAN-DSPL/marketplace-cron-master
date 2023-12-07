<?php

use App\Models\CronStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid();
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
