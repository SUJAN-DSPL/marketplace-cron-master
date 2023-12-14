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
        Schema::create('unmapped_amazon_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('amazon_order_id');
            $table->string('ASIN');
            $table->string('seller_SKU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unmapped_amazon_order_items');
    }
};
