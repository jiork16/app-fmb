<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
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
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('unit_cost');
            $table->string('total_cost');
            $table->unsignedBigInteger('laboratory_id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('date_purchase');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
}
