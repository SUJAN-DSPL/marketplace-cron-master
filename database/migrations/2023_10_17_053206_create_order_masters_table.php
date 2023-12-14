<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_order_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id')->default(0);
            $table->dateTime('order_date')->nullable()->default(null);
            $table->unsignedInteger('master_order_id')->default(0);
            $table->unsignedInteger('parent_order_id');
            $table->unsignedInteger('void_order_id');
            $table->unsignedTinyInteger('current_status')->default(1);
            $table->unsignedInteger('domain_id')->default(0);
            $table->tinyInteger('payment_gateway_master_id');
            $table->string('tracking_number')->default('');
            $table->unsignedMediumInteger('courier_id');
            $table->string('transaction_id')->default('');
            $table->tinyInteger('currency_id_customer');
            $table->unsignedInteger('csr_id')->default(0);
            $table->unsignedInteger('cust_id');
            $table->unsignedInteger('del_country_id');
            $table->unsignedInteger('bill_country_id');
            $table->string('source');
            $table->unsignedInteger('shipping_site_id');
            $table->unsignedInteger('shipping_master_id');
            $table->unsignedInteger('source_site_id');
            $table->mediumInteger('paneu_vat_cm_id')->comment('For PANEU vat country  Master ID');
            $table->unsignedInteger('del_master_country_id')->default(0);
            $table->string('ebay_order_id');
            $table->json('order_master_details');
            $table->json('vat_details');
            $table->json('refunds_details');
            $table->json('address_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mp_order_masters');
    }
}
