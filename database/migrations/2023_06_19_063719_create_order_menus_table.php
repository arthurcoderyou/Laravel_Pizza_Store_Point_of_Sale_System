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
        Schema::create('order_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('menu_name')->nullable();
            $table->double('menu_price')->nullable();
            $table->double('menu_quantity')->nullable();
            $table->double('menu_total_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_menus');
    }
};
