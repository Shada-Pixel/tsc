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
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->constrained("banks")->onUpdate('cascade')->onDelete('cascade');
            $table->string('receipt_number')->nullable();
            $table->decimal('transaction_amount', 12, 2);
            $table->string('transaction_number')->nullable();
            $table->date('transaction_date');
            $table->string('receiver_name')->nullable();
            $table->string('receiver_account_number')->nullable();
            $table->longText('purpose')->nullable();
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
        Schema::dropIfExists('bank_transactions');
    }
};
