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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->nullable();
            
            $table->string('name_customer');
            $table->string('phone', length: 11);
            $table->string('email');
            $table->string('address');
            $table->longText('note')->nullable();
            $table->integer('total_amount');
            $table->date('date_order');
            $table->time('time_order', precision: 0);
            $table->string('name_payment');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
