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
        Schema::create('amazon_orders', function (Blueprint $table) {
            $table->id();
            $table->json("buyer_info");
            $table->string('amazon_order_id')->unique();
            $table->timestamp("earliest_ship_date");
            $table->string("sales_channel");
            $table->string('order_status');
            $table->integer("number_of_items_shipped");
            $table->string("order_type");
            $table->boolean("is_premium_order");
            $table->boolean("is_prime");
            $table->string("fulfillment_channel");
            $table->integer("number_of_items_unshipped");
            $table->boolean('has_regulated_items');
            $table->boolean("is_replacement_order");
            $table->boolean("is_sold_by_AB");
            $table->timestamp("latest_ship_date");
            $table->string('ship_service_level');
            $table->boolean("is_ISPU");
            $table->string("marketplace_id");
            $table->timestamp('purchase_date');
            $table->json("shipping_address")->nullable();
            $table->boolean("is_access_point_order");
            $table->string("seller_order_id");
            $table->string('payment_method');
            $table->boolean("is_business_order");
            $table->json("order_total")->nullable();
            $table->json("payment_method_details");
            $table->boolean("is_global_express_enabled");
            $table->timestamp('last_update_date');
            $table->string("shipment_service_level_category");
            $table->boolean("is_IBA")->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amazon_orders');
    }
};
