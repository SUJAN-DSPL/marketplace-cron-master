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
            $table->string('amazon_order_id')->unique();
            $table->string('order_status');
            $table->string("marketplace_id");
            $table->timestamp('purchase_date');
            $table->timestamp('last_update_date');
            $table->json('order_meta_data');
            $table->json('order_items')->nullable();
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
