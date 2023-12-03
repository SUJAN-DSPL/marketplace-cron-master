<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid()->primary();
            $table->string("name");
            $table->text("description");
            $table->boolean('is_active')->default(false);
            $table->string('cron_job_class');
            $table->string('timezone')->default("Asia/Kolkata");
            $table->json("notifiable_emails")->nullable();
            $table->boolean("notify_on_slack")->default(false);
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
