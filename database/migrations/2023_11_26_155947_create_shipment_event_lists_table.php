<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipment_event_lists', function (Blueprint $table) {
            $table->id();
            $table->string("amazon_order_id")->unique();
            $table->string("seller_order_id");
            $table->string("marketplace_name");
            $table->timestamp("posted_date");
            $table->json("shipment_item_list");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_event_lists');
    }
};
