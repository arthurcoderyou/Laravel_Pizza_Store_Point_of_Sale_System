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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->longText('photo')->nullable();
            $table->double('price');
            $table->double('stocks');
            $table->boolean('available')->default(false);
            $table->double('total_items_sold')->nullable();
            $table->double('total_sales')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
