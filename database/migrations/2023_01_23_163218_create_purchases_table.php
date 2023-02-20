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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_number');
            $table->foreignId('supplier_id')->constrained("suppliers")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total_price',12,2);
            $table->decimal('total_paid',12,2);
            $table->string('chalan_number');
            $table->longText('delivery_point')->nullable();
            $table->integer('total_weight')->comment('Weight in killogram');
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
        Schema::dropIfExists('purchases');
    }
};