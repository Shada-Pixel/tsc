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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->foreignId('client_id')->nullable()->constrained("clients")->onUpdate('cascade')->onDelete('cascade');
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone')->nullable();
            $table->foreignId('user_id')->constrained("users")->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total_price',12,2);
            $table->decimal('total_paid',12,2);
            $table->integer('total_weight')->comment('Weight in killogram');
            $table->tinyInteger('payment_method')->default(1)->comment('1 => Cash, 2 => Bank');
            $table->string('bank_receipt')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1 => Store, 2 => Instant');
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
        Schema::dropIfExists('sales');
    }
};