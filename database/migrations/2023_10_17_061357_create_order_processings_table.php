<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProcessingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_order_processing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->default(0);
            $table->unsignedSmallInteger('paid_by')->default(0);
            $table->dateTime('paid_date')->nullable()->default(null);
            $table->dateTime('pre_auth_date');
            $table->unsignedSmallInteger('dispatch_by')->default(0);
            $table->unsignedSmallInteger('courier_id');
            $table->dateTime('dispatched_date')->nullable()->default(null);
            $table->dateTime('archive_date')->nullable()->default(null);
            $table->dateTime('decline_date')->nullable()->default(null);
            $table->dateTime('chargeback_date')->nullable()->default(null);
            $table->dateTime('lost_chargeback_date')->nullable()->default(null);
            $table->dateTime('won_chargeback_date')->nullable()->default(null);
            $table->dateTime('approve_refund_date');
            $table->dateTime('unresolved_historic_date')->nullable()->default(null);
            $table->dateTime('modified_date')->useCurrent()->useCurrentOnUpdate();
            $table->json('op_archive_decline_details');
            $table->json('op_charge_back_details');
            $table->json('op_other_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mp_order_processing');
    }
}
