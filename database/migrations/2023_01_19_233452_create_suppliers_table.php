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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->longText('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('id_number')->nullable();
            $table->string('laisence')->nullable();
            $table->decimal('initial_payable', 12, 2)->default(0);
            $table->decimal('initial_receivable', 12, 2)->default(0);
            $table->tinyInteger('status')->default(1)->comment('1 => Active, 2 => Inactive');
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
        Schema::dropIfExists('suppliers');
    }
};