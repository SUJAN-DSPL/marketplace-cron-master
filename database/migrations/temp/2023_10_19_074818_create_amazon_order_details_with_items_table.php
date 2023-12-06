<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOrderDetailsWithItemsTable extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('mp_amazon_order_details_with_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->json('order_details');
            $table->json('order_items');
            $table->string('order_status');
            $table->string('order_market_place_id');
            $table->timestamps();
        });
    }

    /**p
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::dropIfExists('amazon_order_details_with_items');
    }
}
