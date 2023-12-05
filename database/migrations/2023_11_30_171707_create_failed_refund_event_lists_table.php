<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('failed_refund_event_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('refund_event_list_id');
            $table->foreign('refund_event_list_id')->references('id')->on('refund_event_lists');
            $table->json("exception");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_refund_event_lists');
    }
};
