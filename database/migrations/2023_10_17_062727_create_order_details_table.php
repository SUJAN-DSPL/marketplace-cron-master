<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->unsignedTinyInteger('status')->default(1);
            $table->integer('product_id');
            $table->integer('product_master_id');
            $table->unsignedInteger('pattr_id');
            $table->integer('primary_cat_id');
            $table->integer('ls_dom_cat_id');
            $table->string('ebay_lineitem_id');
            $table->unsignedSmallInteger('supplier_id');
            $table->json('order_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mp_order_details');
    }
}
