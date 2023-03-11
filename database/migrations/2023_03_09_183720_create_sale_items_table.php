<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained("sales")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained("products")->onUpdate('cascade')->onDelete('cascade');
            $table->integer('total_weight')->comment('Weight in killogram');
            $table->decimal('sale_unit_price',12,2);
            $table->decimal('sale_price',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
};
