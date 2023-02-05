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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained("purchases")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained("products")->onUpdate('cascade')->onDelete('cascade');
            $table->integer('total_weight')->comment('Weight in killogram');
            $table->decimal('unit_price',12,2);
            $table->decimal('total_paid',12,2);
            $table->longText('delivery_point')->nullable();
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
        Schema::dropIfExists('purchase_items');
    }
};