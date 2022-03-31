<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
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
            $table->integer('client_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('form_payment_id');
            $table->decimal('sub_total', 5, 2);
            $table->decimal('discount', 5, 2);
            $table->decimal('base_iva_0', 5, 2);
            $table->decimal('base_iva_12', 5, 2);
            $table->decimal('total', 5, 2);
            $table->date('date_sale');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('form_payment_id')->references('id')->on('form_payments');
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
}
